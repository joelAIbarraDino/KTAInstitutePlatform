<?php

use App\Classes\Helpers;

    $topScripts ='
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    ';
?>

<?php include_once __DIR__.'/../components/header.php'; ?>

<?php include_once __DIR__.'/../components/slider.php'; ?>

<div class="gif">
    <img src="/assets/images/gif.gif" alt="gif" class="gif__image">
</div>

<?php include_once __DIR__.'/../components/lastCourses.php'; ?>

<section class="caracts-main">

    <div class="caracts-main__container">
        <div class="caract-main" data-aos="fade-right" data-aos-delay="200">
            <img class="caract-main__icon" loading="lazy" src="/assets/images/conferencia.png">
            <h3 class="caract-main__title" data-section="index" data-label="caract-title-1">Seminarios presenciales</h3>
            <p class="caract-main__text" data-section="index" data-label="caract-text-1">
                Organizamos distintos seminarios presenciales para que pueda continuar con tu formación tributaria en distintas ciudades del país como Los Ángeles, Orlando, Houston, Phoenix, San Diego, New York, Miami, etc...
            </p>
        </div>

        <div class="caract-main" data-aos="fade-right" data-aos-delay="200">
            <img class="caract-main__icon" loading="lazy" src="/assets/images/reunion.png">
            <h3 class="caract-main__title" data-section="index" data-label="caract-title-2">LIVE WEBINARS</h3>
            <p class="caract-main__text" data-section="index" data-label="caract-text-2">
                La mayoría de nuestros cursos ofrecen la posibilidad de ser realizados en vivo, permiten la interacción con el instructor y aseguran que los contenidos estén siempre actualizados.
            </p>
        </div>

        <div class="caract-main" data-aos="fade-left" data-aos-delay="200">
            <img class="caract-main__icon" loading="lazy" src="/assets/images/online.png">
            <h3 class="caract-main__title" data-section="index" data-label="caract-title-3">ON DEMAND WEBINARS</h3>
            <p class="caract-main__text" data-section="index" data-label="caract-text-3">
                Ofrecemos todos nuestros cursos en formato On Demand para que  estudie cuándo, dónde y cómo desee. Todos los cursos son actualizados permanentemente.
            </p>
        </div>

        <div class="caract-main" data-aos="fade-left" data-aos-delay="200">
            <img class="caract-main__icon" loading="lazy" src="/assets/images/audiolibro.png">
            <h3 class="caract-main__title" data-section="index" data-label="caract-title-4">LIBROS TRIBUTARIOS</h3>
            <p class="caract-main__text" data-section="index" data-label="caract-text-4">
                Tenemos a tu disposición una completa colección de libros tributarios constantemente actualizados y editados incorporando así todos los cambios y novedades fiscales.
            </p>
        </div>
    </div>

    <div class="caracts-main__irs">
        <a href="https://www.ceprovider.us/public/default/listing" data-aos="fade-up" data-aos-delay="200">
            <img class="caracts-main__irs-logo" src="/assets/images/certificado1.jpg">
        </a> 
        
        <a href="https://ctec.org/taxpreparers/find-education-provider/?nav=tax-professionals" data-aos="fade-up" data-aos-delay="200">
            <img class="caracts-main__irs-logo" src="/assets/images/certificado2.jpg">
        </a>
    </div>


</section>

<section class="estadisticas" data-aos="fade" data-aos-delay="100">

    <div class="estadisticas__container">
        <div class="estadistica" data-aos="fade-right" data-aos-delay="200">
            <i class='bx bxs-award' ></i>
            <div class="estadistica__content">
                <p class="estadistica__title counter" data-target="2500" data-caract="+" data-caract="+">0</p>
                <p class="estadistica__desc" data-section="index" data-label="stadistic-1">Estudiantes exitosos</p>
            </div>
        </div>

        <div class="estadistica" data-aos="fade-right" data-aos-delay="200">
            <i class='bx bx-chalkboard' ></i>
            <div class="estadistica__content">
                <p class="estadistica__title counter" data-target="215" data-caract="">0</p>
                <p class="estadistica__desc" data-section="index" data-label="stadistic-2">Video tutoriales</p>
            </div>
        </div>

        <div class="estadistica" data-aos="fade-left" data-aos-delay="200">
            <i class='bx bx-user'></i>
            <div class="estadistica__content">
                <p class="estadistica__title counter" data-target="4" data-caract="">0</p>
                <p class="estadistica__desc" data-section="index" data-label="stadistic-3">Maestros especializados</p>
            </div>
        </div>

        <div class="estadistica" data-aos="fade-left" data-aos-delay="200">
            <i class='bx bx-glasses-alt'></i>
            <div class="estadistica__content">
                <p class="estadistica__title counter" data-target="18" data-caract="+">0</p>
                <p class="estadistica__desc" data-section="index" data-label="stadistic-4">Cursos unicos</p>
            </div>
        </div>

    </div>
</section>

<section class="maestros-index" data-aos="fade" data-aos-delay="">
    <p data-aos="fade-up" data-aos-delay="100" class="maestros-index__subtitulo" data-section="index" data-label="teachers-title">Conoce al equipo KTA</p>
    <h3 data-aos="fade" data-aos-delay="100" class="maestros-index__titulo" data-section="index" data-label="teachers-subtitle">Tenemos a los mejores maestros que te ayudaran a pasar al siguiente nivel</h3>
    <?php include_once __DIR__.'/../components/teachers.php'; ?>
</section>

<section class="reviews" data-aos="fade-up">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php foreach($reviews as $review):?>
                <div class="swiper-slide">
                    <div class="review">
                        <div class="review__header">
                            <img class="review__photo" src="<?=$review->photo?>" alt="<?=$review->photo?>">
                            
                            <div class="review__name-container">
                                <div class="review__name"><?=$review->author_name?></div>
                                <div class="review__time"><?=$review->relative_time?></div>
                            </div>
                        </div>

                        <div class="review__rating">
                            <?php for($i = 0; $i< $review->rating; $i++):?>
                                <i class='bx bxs-star'></i>
                            <?php endfor;?>
                        </div>

                        <div class="review__text">
                            <?= Helpers::limitarTexto($review->review, 120) ?>
                        </div>
                        
                        <a class="review__link" href="<?=$review->google_url?>" target="_blank" data-section="index" data-label="google_more">Ver review en Google</a>
                    </div>

                </div>                
            <?php endforeach;?>
        </div>

        <div class="swiper-pagination"></div>

    </div>
</section>

<section class="membresias-index" data-aos="fade">
    <p data-aos="fade-up" data-aos-delay="100" class="membresias-index__subtitulo" data-section="index" data-label="memberships-title">Descubre cómo podemos ayudarte</p>
    <h3 data-aos="fade-up" data-aos-delay="100" class="membresias-index__titulo" data-section="index" data-label="memberships-subtitle">Tenemos la solución adecuada para cada persona</h3>

    <div class="membresias-index__container">
        
        <div class="membresia-index" data-aos="fade-right" data-aos-delay="100">
            <img class="membresia-index__imagen" src="/assets/images/membresia2.jpg" alt="imagen">
            <div class="membresia-index__container">
                <p class="membresia-index__titulo" data-section="index" data-label="membership-title-1">Nuestros cursos</p>
                <p class="membresia-index__texto" data-section="index" data-label="membership-text-1">
                    Aprende de profesionales con más de 30 años de experiencia. Sé parte de nuestros +2,500 estudiantes exitosos e inicia tu propio negocio.
                </p>

                <div class="membresia-index__container-link">
                    <a class="membresia-index__enlace" href="/cursos" data-section="index" data-label="membership-button">Más detalles</a>
                </div>
            </div>
        </div>

        <div class="membresia-index" data-aos="fade-left" data-aos-delay="100">
            <img class="membresia-index__imagen" src="/assets/images/membresia2.jpg" alt="imagen">
            <div class="membresia-index__container">
                <p class="membresia-index__titulo" data-section="index" data-label="membership-title-2">Membresía KTA</p>
                <p class="membresia-index__texto" data-section="index" data-label="membership-text-2">
                    ¿Ya  tienes experiencia como preparador de impuestos y quieres pasar al siguiente nivel?. 
                    Con nuestra <strong>Membresía Business Lab<strong> tendrás todo lo que necesitas para llegar a lo mas alto.
                </p>

                <div class="membresia-index__container-link">
                    <a class="membresia-index__enlace" href="/membresias" data-section="index" data-label="membership-button">Más detalles</a>
                </div>
            </div>
        </div>

    </div>    
</section>

<?php include_once __DIR__.'/../components/popups.php'; ?>

<?php include_once __DIR__.'/../components/footer.php'; ?>

<?php 

    $menuVersion = filemtime('assets/js/menu.js');
    $sliderVersion = filemtime('assets/js/slider.js');
    $saleVersion = filemtime('assets/js/saleAlerts.js');
    $animationVersion = filemtime('assets/js/counter.js');
    $swiperVersion = filemtime('assets/js/swiper.js');

    $scripts ='
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
        <script src="/assets/js/counter.js?v='.$animationVersion.'"></script>
        <script src="/assets/js/slider.js?v='.$sliderVersion.'"></script>
        <script src="/assets/js/saleAlerts.js?v='.$saleVersion.'"></script>
        <script src="/assets/js/swiper.js?v='.$swiperVersion.'"></script>
        <script src="/assets/js/animation.js"></script>
    ';
?>

