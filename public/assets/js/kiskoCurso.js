(function(){

    document.addEventListener('DOMContentLoaded', function() {
        const contenedor = document.querySelector('.kiosko__contenedor');
        const botonAnterior = document.querySelector('.kiosko__boton--anterior');
        const botonSiguiente = document.querySelector('.kiosko__boton--siguiente');
        const puntosContenedor = document.querySelector('.kiosko__puntos');
        

        if(!contenedor)
            return;
        // Configuración del kiosko
        const config = {
            velocidad: 300, // ms para el desplazamiento
            intervalo: 5000, // ms para el auto-desplazamiento
            autoPlay: true,
        };
        
        let intervalo;
        let cursoWidth = document.querySelector('.curso').offsetWidth + 32; // Ancho del curso + gap
        let cursoIndex = 0;
        let cursos = document.querySelectorAll('.curso');
        let puntos = [];
        
        // Crear puntos de navegación
        function crearPuntos() {
            cursos.forEach((_, index) => {
                const punto = document.createElement('span');
                punto.classList.add('punto');
                if (index === 0) punto.classList.add('punto--activo');
                punto.addEventListener('click', () => moverAcurso(index));
                puntosContenedor.appendChild(punto);
                puntos.push(punto);
            });
        }
        
        // Mover a un curso específico
        function moverAcurso(index) {
            cursoIndex = index;
            contenedor.scrollTo({
                left: cursoWidth * index,
                behavior: 'smooth'
            });
            
            // Actualizar puntos activos
            puntos.forEach((punto, i) => {
                punto.classList.toggle('punto--activo', i === index);
            });
            
            // Reiniciar autoplay
            if (config.autoPlay) {
                clearInterval(intervalo);
                iniciarAutoPlay();
            }
        }
        
        // Navegación siguiente
        function siguiente() {
            if (cursoIndex < cursos.length - 1) {
                cursoIndex++;
            } else {
                cursoIndex = 0;
            }
            moverAcurso(cursoIndex);
        }
        
        // Navegación anterior
        function anterior() {
            if (cursoIndex > 0) {
                cursoIndex--;
            } else {
                cursoIndex = cursos.length - 1;
            }
            moverAcurso(cursoIndex);
        }
        
        // Iniciar autoplay
        function iniciarAutoPlay() {
            if (config.autoPlay) {
                intervalo = setInterval(siguiente, config.intervalo);
            }
        }
        
        // Event listeners
        botonSiguiente.addEventListener('click', siguiente);
        botonAnterior.addEventListener('click', anterior);
        
        // Pausar autoplay al interactuar
        contenedor.addEventListener('mouseenter', () => clearInterval(intervalo));
        contenedor.addEventListener('mouseleave', iniciarAutoPlay);
        
        // Inicializar
        crearPuntos();
        iniciarAutoPlay();
        
        // Manejar redimensionamiento
        window.addEventListener('resize', () => {
            cursoWidth = document.querySelector('.curso').offsetWidth + 32;
            moverAcurso(cursoIndex); // Reajustar posición
        });
    });

})();