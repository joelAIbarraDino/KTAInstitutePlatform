(function(){
    document.addEventListener('DOMContentLoaded', function() {
        // Menú hamburguesa
        const hamburguesa = document.getElementById('hamburguesa');
        const menu = document.getElementById('menu');
        const navegacion = document.querySelector('.navegacion');
        
        hamburguesa.addEventListener('click', function() {
            navegacion.classList.toggle('activo');
        });
        
        // Slider básico
        const slides = document.querySelectorAll('.hero__slide');
        const prevBtn = document.querySelector('.hero__control--previo');
        const nextBtn = document.querySelector('.hero__control--siguiente');
        let currentSlide = 0;
        
        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('hero__slide--activo'));
            slides[index].classList.add('hero__slide--activo');
            currentSlide = index;
        }
        
        prevBtn.addEventListener('click', function() {
            let newIndex = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(newIndex);
        });
        
        nextBtn.addEventListener('click', function() {
            let newIndex = (currentSlide + 1) % slides.length;
            showSlide(newIndex);
        });
        
        // Mostrar el primer slide al cargar
        showSlide(0);
    });
})();
