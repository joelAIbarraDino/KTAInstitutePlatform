(function(){
    document.addEventListener('DOMContentLoaded', function() {
        
        app();
    });

    function app(){
        //menu();
        headerTraslucido();
    }

    function menu(){
        const hamburguesa = document.getElementById('hamburguesa');
        const navegacion = document.querySelector('.navegacion');
        
        hamburguesa.addEventListener('click', function() {
            navegacion.classList.toggle('activo');
        });
    }

    function headerTraslucido(){
        const header = document.querySelector('#header-main');
        const contenidoPagina = document.querySelector('#main-content');
        let claseHeader;
        document.addEventListener('scroll', function(){

            if(contenidoPagina.getBoundingClientRect().top < 100){
                
                if(header.classList.contains("transparente")){
                    header.classList.remove("transparente");
                    claseHeader = "transparente";
                }
                
                if(header.classList.contains("solido")){
                    header.classList.remove("solido");
                    claseHeader = "solido";
                }

                header.classList.add("traslucido");
            }else{
                
                if(claseHeader == "transparente")
                    header.classList.add("transparente");
                
                if(claseHeader == "solido")
                    header.classList.add("solido");
                
                header.classList.remove("traslucido");
            }
        });
        
    }

})();
