<?php if($courses):?>

    <section class="last-courses">

        <?php if($title == "Inicio"):?>
            <h3 class="last-courses__title">Nuestros cursos</h3>
        <?php else:?>
                <h3 class="last-courses__title">Próximos Cursos</h3>
        <?php endif;?>
        
        <div class="last-courses__container swiper mySwiper">
            <div class="swiper-wrapper">
                <?php foreach($courses as $course):?>
                    <div class="swiper-slide">
                        <?php include __DIR__.'/courseCard.php';?>
                    </div>
                <?php endforeach;?>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

<?php else:?>
    <div class="empty-main-course">
        <p class="empty-main-course__empty">Proximamente, mas cursos para tí</p>
    </div>
<?php endif;?>