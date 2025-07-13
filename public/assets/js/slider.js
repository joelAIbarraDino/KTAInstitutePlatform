(function(){

  const container = document.querySelector('.slider-container');
  const slides = container.querySelectorAll('.slider');
  let currentIndex = 0;
  const delay = 5000; // 5 segundos, cambia a 10000 para 10s

  setInterval(() => {
    // Quitar clase al actual
    slides[currentIndex].classList.remove('active');

    // Calcular el siguiente índice
    currentIndex = (currentIndex + 1) % slides.length;

    // Agregar clase al nuevo slide
    slides[currentIndex].classList.add('active');
  }, delay);
})();