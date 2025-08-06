<?php

    $topScripts ='
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    ';
    include_once __DIR__.'/../../components/estudentToolbar.php'; 


?>

<main class="background-profile">
    <section class="courses-container">
        <h3 class="last-courses__title"data-aos="fade-down">Mis cursos</h3>
        <hr class="linea-personalizada" data-aos="fade">

        <div class="my-courses" data-aos="fade-up">
            <?php if(count($myCourses) === 0): ?>
                <p class="my-courses__empty">No hay cursos activos</p>
            <?php else: ?>
                <div class="my-courses__courses">
                    <?php foreach($myCourses as $courseData):?>
                            <?php 
                                $course = $courseData[0];
                                $percentage = $courseData[1];
                            ?>

                            <?php include __DIR__.'/../../components/estudentCourseCard.php'; ?>
                    <?php endforeach;?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    
    <?php include_once __DIR__.'/../../components/lastCourses.php'; ?>

</main>

<script>
    const swiper = new Swiper(".swiper-courses", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        480:{
            slidesPerView: 1
        },
        768: {
            slidesPerView: 3
        },
        1024: {
            slidesPerView: 5
        }
    }
    });
</script>

<?php include_once __DIR__.'/../../components/footer.php'; ?>

<?php 
    $scripts ='
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>