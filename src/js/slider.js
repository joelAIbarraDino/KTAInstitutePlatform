document.addEventListener('DOMContentLoaded', () => {
    class SimpleSlider {
      constructor(selector) {
        this.slider = document.querySelector(selector);
        this.slides = this.slider.querySelectorAll('.slide');
        this.dotsContainer = this.slider.querySelector('.slider-dots');
        this.prevBtn = this.slider.querySelector('.slider-control.prev');
        this.nextBtn = this.slider.querySelector('.slider-control.next');
        this.currentIndex = 0;
        this.autoPlayInterval = null;
        this.autoPlayDelay = 7000; // 5 segundos
  
        this.init();
      }
  
      init() {
        // Crear dots/indicadores
        this.slides.forEach((_, index) => {
          const dot = document.createElement('div');
          dot.classList.add('dot');
          if (index === this.currentIndex) dot.classList.add('active');
          dot.addEventListener('click', () => this.goToSlide(index));
          this.dotsContainer.appendChild(dot);
        });
  
        // Event listeners
        this.prevBtn.addEventListener('click', () => this.prevSlide());
        this.nextBtn.addEventListener('click', () => this.nextSlide());
  
        // Autoplay (opcional)
        this.startAutoPlay();
  
        // Pausar autoplay al interactuar
        this.slider.addEventListener('mouseenter', () => this.stopAutoPlay());
        this.slider.addEventListener('mouseleave', () => this.startAutoPlay());
  
        // Mostrar primer slide
        this.updateSlides();
      }
  
      updateSlides() {
        this.slides.forEach((slide, index) => {
          slide.classList.toggle('active', index === this.currentIndex);
        });
  
        // Actualizar dots
        const dots = this.dotsContainer.querySelectorAll('.dot');
        dots.forEach((dot, index) => {
          dot.classList.toggle('active', index === this.currentIndex);
        });
      }
  
      goToSlide(index) {
        this.currentIndex = (index + this.slides.length) % this.slides.length;
        this.updateSlides();
        this.resetAutoPlay();
      }
  
      nextSlide() {
        this.goToSlide(this.currentIndex + 1);
      }
  
      prevSlide() {
        this.goToSlide(this.currentIndex - 1);
      }
  
      startAutoPlay() {
        this.autoPlayInterval = setInterval(() => this.nextSlide(), this.autoPlayDelay);
      }
  
      stopAutoPlay() {
        if (this.autoPlayInterval) {
          clearInterval(this.autoPlayInterval);
          this.autoPlayInterval = null;
        }
      }
  
      resetAutoPlay() {
        this.stopAutoPlay();
        this.startAutoPlay();
      }
    }
  
    // Inicializar slider
    new SimpleSlider('.slider');
  });