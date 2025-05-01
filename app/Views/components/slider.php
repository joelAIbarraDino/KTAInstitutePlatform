

<div class="slider-container">
  <div class="slider">
    <!-- Ejemplo de slide - esto se generará dinámicamente con PHP -->  
    <?php if(count($sliders) > 0):?>
      <?php foreach($sliders as $slide):?>
        <div class="slide">
          <!-- Slide con imagen de fondo -->
          <div class="slide-bg slide-bg--image" style="background-image: url('/assets/slidebar/<?=$slide->background?>')"></div>
          
          <div class="slide-content">
            <h2 class="slide-title" style="color:<?=$slide->color_title?>"><?=$slide->title?></h2>
            <p class="slide-subtitle" style="color:<?=$slide->color_subtitule?>"><?=$slide->subtitule?></p>
            <?php if(!empty($slide->link)):?>
              <a href="<?=$slide->link?>" class="slide-button"><?=$slide->CTA?></a>
            <?php endif;?>
          </div>
        </div>
      <?php endforeach;?>
    <?php else:?>
        <div class="slide">
          <!-- Slide con imagen de fondo -->
          <div class="slide-bg slide-bg--image" style="background-image: url('/assets/slidebar/banner alterno.png')"></div>
          
          <div class="slide-content">
            <h2 class="slide-title">Cursos de Impuestos (Nuestros cursos están aprobados por el IRS), Contabilidad, QB, Inmigración y más…</h2>
            <p class="slide-subtitle">Aprende de profesionales con +de 30 años de experiencia, se parte de los +de 2500 estudiantes exitosos e inicia tu propio Negocio.</p>
          </div>
        </div>
      <?php endif;?>
  </div>
  
  <!-- Controles del slider -->
  <button class="slider-control slider-control--prev"><i class='bx bx-chevrons-left'></i></button>
  <button class="slider-control slider-control--next"><i class='bx bx-chevrons-right' ></i></button>
  
  <!-- Indicadores/paginación -->
  <div class="slider-indicators"></div>
</div>