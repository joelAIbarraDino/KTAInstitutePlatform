(function(){

document.addEventListener('DOMContentLoaded', function() {
  const slider = document.querySelector('.header-slider');
  if (!slider) return;

  const slidesContainer = slider.querySelector('.header-slider__slides');
  const slides = Array.from(slider.querySelectorAll('.header-slider__slide'));
  const prevBtn = slider.querySelector('.header-slider__control--prev');
  const nextBtn = slider.querySelector('.header-slider__control--next');
  const indicatorsContainer = slider.querySelector('.header-slider__indicators');
  
  let currentSlide = 0;
  let slideInterval;
  let players = []; // Almacenar instancias de Plyr

  // Inicializar indicadores
  function initIndicators() {
    slides.forEach((slide, index) => {
      const indicator = document.createElement('button');
      indicator.classList.add('header-slider__indicator');
      if (index === currentSlide) {
        indicator.classList.add('header-slider__indicator--active');
      }
      
      indicator.addEventListener('click', () => {
        goToSlide(index);
      });
      
      indicatorsContainer.appendChild(indicator);
    });
  }

  // Cargar video de YouTube con Plyr
  function loadVideo(slide) {
    const videoContainer = slide.querySelector('.header-slider__video-container');
    const videoId = slide.getAttribute('data-video-id');
    
    if (!videoId || !videoContainer) return;
    
    // Crear iframe
    const iframe = document.createElement('div');
    iframe.classList.add('plyr__video-embed');
    iframe.innerHTML = `
      <iframe 
        src="https://www.youtube.com/embed/${videoId}?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" 
        allowfullscreen
        allowtransparency
        allow="autoplay"
      ></iframe>
    `;
    
    videoContainer.innerHTML = '';
    videoContainer.appendChild(iframe);
    
    // Inicializar Plyr
    const player = new Plyr(iframe, {
      autoplay: true,
      muted: true,
      controls: false,
      loop: { active: true },
      fullscreen: { enabled: false },
      hideControls: true,
      clickToPlay: false
    });
    
    players.push(player);
    
    // Forzar el tamaño del video para cubrir todo el slide
    const iframeElement = iframe.querySelector('iframe');
    iframeElement.style.width = '100%';
    iframeElement.style.height = '100%';
    iframeElement.style.objectFit = 'cover';
  }

  // Inicializar videos
  function initVideos() {
    const videoSlides = slides.filter(slide => slide.getAttribute('data-type') === 'video');
    videoSlides.forEach(loadVideo);
  }

  // Ir a slide específico
  function goToSlide(index) {
    // Pausar video actual si es un video
    if (slides[currentSlide].getAttribute('data-type') === 'video' && players[currentSlide]) {
      players[currentSlide].pause();
    }
    
    // Actualizar slide actual
    slides[currentSlide].classList.remove('header-slider__slide--active');
    currentSlide = (index + slides.length) % slides.length;
    slides[currentSlide].classList.add('header-slider__slide--active');
    
    // Reproducir video si es un video
    if (slides[currentSlide].getAttribute('data-type') === 'video' && players[currentSlide]) {
      players[currentSlide].play();
    }
    
    // Actualizar indicadores
    updateIndicators();
    
    // Reiniciar intervalo
    resetInterval();
  }

  // Actualizar indicadores
  function updateIndicators() {
    const indicators = Array.from(indicatorsContainer.querySelectorAll('.header-slider__indicator'));
    indicators.forEach((indicator, index) => {
      if (index === currentSlide) {
        indicator.classList.add('header-slider__indicator--active');
      } else {
        indicator.classList.remove('header-slider__indicator--active');
      }
    });
  }

  // Siguiente slide
  function nextSlide() {
    goToSlide(currentSlide + 1);
  }

  // Slide anterior
  function prevSlide() {
    goToSlide(currentSlide - 1);
  }

  // Iniciar intervalo de auto-avance
  function startInterval() {
    slideInterval = setInterval(nextSlide, 5000);
  }

  // Reiniciar intervalo
  function resetInterval() {
    clearInterval(slideInterval);
    startInterval();
  }

  // Event listeners
  prevBtn.addEventListener('click', prevSlide);
  nextBtn.addEventListener('click', nextSlide);
  
  // Pausar al hacer hover
  slider.addEventListener('mouseenter', () => {
    clearInterval(slideInterval);
  });
  
  slider.addEventListener('mouseleave', () => {
    startInterval();
  });
  
  // Inicialización
  initIndicators();
  initVideos();
  slides[currentSlide].classList.add('header-slider__slide--active');
  startInterval();
  
  // Manejar cambios de tamaño para videos
  window.addEventListener('resize', () => {
    if (slides[currentSlide].getAttribute('data-type') === 'video' && players[currentSlide]) {
      const iframe = players[currentSlide].elements.container.querySelector('iframe');
      if (iframe) {
        iframe.style.width = '100%';
        iframe.style.height = '100%';
        iframe.style.objectFit = 'cover';
      }
    }
  });
});

// Cargar Plyr desde CDN si no está cargado
function loadPlyr() {
  if (typeof Plyr === 'undefined') {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = 'https://cdn.plyr.io/3.7.8/plyr.css';
    document.head.appendChild(link);
    
    const script = document.createElement('script');
    script.src = 'https://cdn.plyr.io/3.7.8/plyr.polyfilled.js';
    script.onload = function() {
      document.dispatchEvent(new Event('DOMContentLoaded'));
    };
    document.body.appendChild(script);
  } else {
    document.dispatchEvent(new Event('DOMContentLoaded'));
  }
}

// Iniciar carga de Plyr
loadPlyr();

})();