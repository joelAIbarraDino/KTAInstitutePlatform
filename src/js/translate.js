(function(){
    const englishFlag = "https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg";
    const spanishFlag = "https://upload.wikimedia.org/wikipedia/commons/9/9a/Flag_of_Spain.svg";

    const textosPagina = document.querySelectorAll('[data-section]');

    const btn = document.querySelector('#lang-switcher');


    document.addEventListener('DOMContentLoaded', function(){
        app();
    });


    function app (){
        idiomaPagina('es');
        initLocalStorage();
        setBotonIdioma();
    }

    function initLocalStorage(){
        const idioma = localStorage.getItem('idioma');
        if (!idioma){
            localStorage.setItem('idioma', 'es');
            btn.src = usaFlag;
        }else{
            btn.src = idioma === 'en'? spanishFlag : englishFlag;
            idiomaPagina(idioma);
        }
        
    }

    function setBotonIdioma(){

        if(!btn)return;

        btn.onclick = function(){
            cambiarIdioma();
        }
    }

    function cambiarIdioma() {
        const idiomaActual = localStorage.getItem('idioma');
        const nuevoIdioma = idiomaActual === 'en' ? 'es' : 'en';
        btn.src = idiomaActual === 'en'? englishFlag : spanishFlag;
        localStorage.setItem('idioma', nuevoIdioma);
        idiomaPagina(nuevoIdioma); 
    }

    async function idiomaPagina(idioma) {
        try {
            const staticUrl = `/assets/lang/${idioma}.json`;
            const dynamicUrl = `/assets/lang/${idioma}.dynamic.json`;

            const [staticRes, dynamicRes] = await Promise.all([
                fetch(staticUrl),
                fetch(dynamicUrl)
            ]);

            const staticTextos = await staticRes.json();
            const dynamicTextos = await dynamicRes.json();

            const textos = {...staticTextos};
            for (let section in dynamicTextos) {
                if (!textos[section]) textos[section] = {};
                textos[section] = { ...textos[section], ...dynamicTextos[section] };
            }

            textosPagina.forEach(elementoTexto => {
                const section = elementoTexto.dataset.section;
                const label = elementoTexto.dataset.label;

                if (textos[section] && textos[section][label]) {
                    elementoTexto.innerHTML = textos[section][label];
                }
            });

        } catch (error) {
            console.error("Error al cargar traducciones:", error);
        }
    }


})();