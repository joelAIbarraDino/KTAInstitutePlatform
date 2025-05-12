(function(){
    document.addEventListener('DOMContentLoaded', function() {
        
        const hamburguesa = document.getElementById('hamburguesa');
        const navegacion = document.querySelector('.navegacion');
        
        hamburguesa.addEventListener('click', function() {
            navegacion.classList.toggle('activo');
        });
    });
})();
