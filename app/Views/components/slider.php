<div class="slider-container">
  <div class="slider">
    <!-- Ejemplo de slide - esto se generará dinámicamente con PHP -->  
    <?php foreach($sliders as $slide):?>
      <div class="slide">
        <!-- Slide con imagen de fondo -->
        <div class="slide-bg slide-bg--image" style="background-image: url('/assets/slidebar/<?=$slide->background?>')"></div>
        
        <div class="slide-content">
          <h2 class="slide-title"><?=$slide->title?></h2>
          <p class="slide-subtitle"><?=$slide->subtitule?></p>
          <a href="#" class="slide-button">Ver más</a>
        </div>
      </div>
    <?php endforeach;?>

  </div>
  
  <!-- Controles del slider -->
  <button class="slider-control slider-control--prev"><i class='bx bx-chevrons-left'></i></button>
  <button class="slider-control slider-control--next"><i class='bx bx-chevrons-right' ></i></button>
  
  <!-- Indicadores/paginación -->
  <div class="slider-indicators"></div>
</div>