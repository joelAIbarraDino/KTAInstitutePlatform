<?php if($courses):?>

    <section class="last-courses">

        <h3 data-aos="fade-up" class="last-courses__title" data-section="index"  data-label="next-courses" >Próximos Cursos</h3>
        
        <div class="last-courses__container swiper swiper-courses">
            <div class="swiper-wrapper">
                <?php foreach($courses as $course):?>
                    <div class="swiper-slide">
                        <?php include __DIR__.'/courseCard.php';?>
                    </div>
                <?php endforeach;?>
            </div>

            <div class="swiper-pagination"></div>
        </div>
    </section>

<?php else:?>
    <div class="empty-main-course">
        <p class="empty-main-course__empty">Proximamente, mas cursos para tí</p>
    </div>
<?php endif;?>