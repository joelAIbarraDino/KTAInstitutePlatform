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
                        <p class="experiencia"><?=$teacher->experience?> años de experiencia</p>
                        <a href="/profesor/view/<?=$teacher->id_teacher?>" class="boton-ver-mas">Ver más</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Opcionales: navegación -->
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
<?php endif;?>