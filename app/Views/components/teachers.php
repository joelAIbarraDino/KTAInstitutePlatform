<?php if(!empty($teachers)): ?>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php foreach($teachers as $teacher): ?>
                <div class="swiper-slide">
                    <div class="profesor-card">
                        <a href="/profesor/view/<?=$teacher->id_teacher?>">
                            <img src="/assets/teachers/<?=$teacher->photo?>" alt="Profesor" class="profesor-foto" />
                        </a>
                        <a href="/profesor/view/<?=$teacher->id_teacher?>" class="nombre"><?=$teacher->name?></a>
                        <p class="experiencia"><?=$teacher->speciality?></p>
                        <p class="experiencia"><?=$teacher->experience?> <span data-section="teacher-details" data-label="years-experience">años de experiencia </span></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        
        <div class="swiper-pagination"></div>
    </div>
<?php endif;?>