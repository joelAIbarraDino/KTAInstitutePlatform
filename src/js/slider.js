(function(){

  document.addEventListener('DOMContentLoaded', function() {
    // Inicializar Plyr para los videos
    const players = Array.from(document.querySelectorAll('.plyr__video-embed')).map(
      el => new Plyr(el, {
        controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen'],
        hideControls: false,
        ratio: '16:9'
      })
    );
    
    // Configuración del slider
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.slider-control--prev');
    const nextBtn = document.querySelector('.slider-control--next');
    const indicatorsContainer = document.querySelector('.slider-indicators');
    let currentSlide = 0;
    const slideCount = slides.length;
    
    // Crear indicadores
    slides.forEach((_, index) => {
      const indicator = document.createElement('div');
      indicator.classList.add('indicator');
      if (index === 0) indicator.classList.add('active');
      indicator.addEventListener('click', () => goToSlide(index));
      indicatorsContainer.appendChild(indicator);
    });
    
    // Función para ir a un slide específico
    function goToSlide(slideIndex) {
      // Detener cualquier video que esté reproduciéndose
      players.forEach(player => player.pause());
      
      // Actualizar slide actual
      currentSlide = slideIndex;
      slider.style.transform = `translateX(-${currentSlide * 100}%)`;
      
      // Actualizar indicadores
      document.querySelectorAll('.indicator').forEach((indicator, index) => {
        if (index === currentSlide) {
          indicator.classList.add('active');
        } else {
          indicator.classList.remove('active');
        }
      });
      
      // Si el slide actual tiene video, reproducirlo
      const currentVideoContainer = slides[currentSlide].querySelector('.slide-bg--video');
      if (currentVideoContainer && !currentVideoContainer.hidden) {
        const player = players[currentSlide];
        player.play();
      }
    }
    
    // Event listeners para los controles
    prevBtn.addEventListener('click', () => {
      const prevSlide = currentSlide === 0 ? slideCount - 1 : currentSlide - 1;
      goToSlide(prevSlide);
    });
    
    nextBtn.addEventListener('click', () => {
      const nextSlide = currentSlide === slideCount - 1 ? 0 : currentSlide + 1;
      goToSlide(nextSlide);
    });
    
    // Autoplay opcional (descomentar si lo deseas)
    /*
    let slideInterval = setInterval(() => {
      const nextSlide = currentSlide === slideCount - 1 ? 0 : currentSlide + 1;
      goToSlide(nextSlide);
    }, 5000);
    
    slider.addEventListener('mouseenter', () => clearInterval(slideInterval));
    slider.addEventListener('mouseleave', () => {
      slideInterval = setInterval(() => {
        const nextSlide = currentSlide === slideCount - 1 ? 0 : currentSlide + 1;
        goToSlide(nextSlide);
      }, 5000);
    });
    */
  });

})();