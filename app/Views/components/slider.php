<div class="header-slider">
  <!-- Slides serán generados dinámicamente desde PHP -->
  <div class="header-slider__slides">
    <!-- Ejemplo de slide con imagen -->
    <div class="header-slider__slide" data-type="image">
      <div class="header-slider__media">
        <img src="/assets/images/img-2.jpg" alt="" class="header-slider__image">
      </div>
      <div class="header-slider__content container">
        <h2 class="header-slider__title">Título del Slide</h2>
        <h3 class="header-slider__subtitle">Subtítulo del Slide</h3>
        <p class="header-slider__text">Texto descriptivo del slide</p>
      </div>
    </div>
    
    <!-- Ejemplo de slide con video -->
    <div class="header-slider__slide" data-type="video" data-video-id="R7mohZTxacg">
      <div class="header-slider__media">
        <div class="header-slider__video-container"></div>
      </div>
      <div class="header-slider__content container">
        <h2 class="header-slider__title">Título del Video</h2>
        <h3 class="header-slider__subtitle">Subtítulo del Video</h3>
        <p class="header-slider__text">Texto descriptivo del video</p>
      </div>
    </div>
  </div>
  
  <!-- Controles del slider -->
  <div class="header-slider__controls">
    <button class="header-slider__control header-slider__control--prev">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"/>
      </svg>
    </button>
    <button class="header-slider__control header-slider__control--next">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
        <path d="M8.59 16.59L13.17 12 8.59 7.41 10 6l6 6-6 6-1.41-1.41z"/>
      </svg>
    </button>
  </div>
  
  <!-- Indicadores/paginación -->
  <div class="header-slider__indicators"></div>
</div>