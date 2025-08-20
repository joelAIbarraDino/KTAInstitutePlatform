<?php if(!empty($teachers)): ?>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php foreach($teachers as $teacher): ?>
                <div class="swiper-slide">
                    <div class="profesor-card">
                        <a href="/profesor/view/<?=$teacher->id_teacher?>">
                            <img src="/assets/teachers/<?=$teacher->photo?>" alt="Profesor" class="profesor-foto" />
                        </a>
                        <p class="nombre"><?=$teacher->name?></p>
                        <p class="experiencia"><?=$teacher->experience?> <span data-section="teacher-details" data-label="years-experience">años de experiencia </span></p>
                        <a href="/profesor/view/<?=$teacher->id_teacher?>" class="boton-ver-mas" data-section="index" data-label="membership-button">Más detalles</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        
        <div class="swiper-pagination"></div>
    </div>
<?php endif;?>