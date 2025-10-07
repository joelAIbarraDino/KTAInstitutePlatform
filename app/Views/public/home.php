<?php

    use App\Classes\Helpers;

    $css2Version = filemtime('assets/css/style.css');
    $css3Version = filemtime('assets/css2/style.css');

    $topScripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

        <link rel="preload" href="https://cdn.plyr.io/3.7.8/plyr.css" as="style"> 
        <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
        
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
        <script src="https://player.vimeo.com/api/player.js"></script>

        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/fontawesome.min.css">
        <link rel="stylesheet" href="/assets/css/magnific-popup.min.css">
        <link rel="stylesheet" href="/assets/css/slick.min.css">
        <link rel="stylesheet" href="/assets/css/style.css?v='.$css2Version.'">

        <link rel="stylesheet" href="/assets/css2/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css2/animate.css">
        <link rel="stylesheet" href="/assets/css2/swiper.min.css">
        <link rel="stylesheet" href="/assets/css2/jquery-ui.css"> 
        <link rel="stylesheet" href="/assets/css2/magnific-popup.css">
        <link rel="stylesheet" href="/assets/css2/nice-select.css">
        <link rel="stylesheet" href="/assets/css2/style.css?v='.$css3Version.'">
    ';

?>

<?php include_once __DIR__.'/../components/header.php'; ?>
<?php include_once __DIR__.'/../components/sliderFinal.php'; ?>


<!--==============================
    Features
==============================-->

<section class="features">
    <div class="features__container">
        <div class="feature__card ed-price-item">
            <div class="feature__icon">
                <img class="feature__image" src="/assets/images/reunion.png" alt="Feature Icon">
            </div>
            <h4 class="feature__title"><a href="/lives">CURSOS EN VIVO</a></h4>
            <p class="feature__text">La mayoría de nuestros cursos ofrecen la posibilidad de ser realizados en vivo, permiten la interacción con el instructor y aseguran que los contenidos estén siempre actualizados.</p>
            <div class="item-btn btn-spin text-center">
                <a href="/lives">¡Ver lives!</a>
            </div>
        </div>

        <div class="feature__card ed-price-item">
            <div class="feature__icon">
                <img class="feature__image" src="/assets/images/conferencia.png" alt="Feature Icon">
                <div class="feature__circle"></div>
            </div>
            <h4 class="feature__title"><a href="#">Seminarios presenciales</a></h4>
            <p class="feature__text">Organizamos distintos seminarios presenciales para que pueda continuar con tu formación tributaria en distintas ciudades del país como Los Ángeles, Orlando, Houston, Phoenix, San Diego, New York, Miami, etc...</p>
            <div class="item-btn btn-spin text-center">
                <a href="#">¡Ver seminarios!</a>
            </div>
        </div>

        <div class="feature__card ed-price-item">
            <div class="feature__icon">
                <img class="feature__image" src="/assets/images/online.png" alt="Feature Icon">
                <div class="feature__circle"></div>
            </div>
            <h4 class="feature__title"><a href="/cursos">Cursos self study</a></h4>
            <p class="feature__text">Ofrecemos todos nuestros cursos en formato self study para que estudie cuándo, dónde y cómo desee. Todos los cursos son actualizados permanentemente.</p>
            <div class="item-btn btn-spin text-center">
                <a href="/cursos">¡Ver cursos!</a>
            </div>
        </div>

    </div>    

</section>
<!--==============================
CTA Area
==============================-->
<section style="padding-top:5rem; padding-bottom:5rem;" data-bg-src="assets/img/bg/blog-single-divider-bg-1-1.jpg">
    <div class="container">
        <div class="row justify-content-between text-center text-lg-start">
            <div class="col-lg-6 mb-40 mb-lg-0">
                <h2 class="mt-n2 h2 mb-3" style="font-size:3rem; font-weight:700;">Cursos Certificados y Avalados</h2>
                <p class=" mb-4 pb-2 fs-md col-xl-11">Somos IRS Approved Provider y CTEC Certified, lo que asegura que tu capacitación esté reconocida y validada oficialmente en EE. UU.</p>
                <a href="/nosotros" class="vs-btn style2"><i class="far fa-angle-right"></i>¿Quienes somos?</a>
            </div>
            <div class="col-auto d-none d-lg-block">
                <div class="sec-line2"></div>
            </div>
            <div class="col-lg-auto">
                <div class="mini-avater">
                    <a href="https://www.ceprovider.us/public/default/listing"><img src="/assets/images/certificado1.jpg" alt="avater"></a>
                    <a href="https://ctec.org/taxpreparers/find-education-provider/?nav=tax-professionals"><img src="/assets/images/certificado2.jpg" alt="avater"></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!--==============================
    About Area
==============================-->
<section class="space-top space-bottom">
    <div class="container">
        <div class="row align-items-center justify-content-center justify-content-xl-between flex-row-reverse">
            <div class="col-xl-5 col-xxl-auto wow fadeInUp" data-wow-delay="0.3s">
                <div class="img-box1">
                    <div class="vs-circle">
                        <div class="mega-hover">
                            <img src="/assets/images/index-live3.jpg" alt="banner">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 text-start">

                <h2 class="form-title">Lo que Hemos Logrado Juntos</h2>
                <div class="row gx-40 justify-content-center justify-content-xl-start">
                    <div class="col-6">
                        <div class="media-style3">
                            <div class="media-icon"><i class='bx bxs-award' ></i></div>
                            <div class="media-body">
                                <span class="media-title">2500+</span>
                                <p class="media-text">Estudiantes exitosos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="media-style3">
                            <div class="media-icon"><i class='bx bx-chalkboard' ></i></div>
                            <div class="media-body">
                                <span class="media-title">215+</span>
                                <p class="media-text">Video tutoriales</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="media-style3">
                            <div class="media-icon"><i class='bx bx-user'></i></div>
                            <div class="media-body">
                                <span class="media-title">4</span>
                                <p class="media-text">Maestros especializados</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="media-style3">
                            <div class="media-icon"><i class='bx bx-glasses-alt'></i></div>
                            <div class="media-body">
                                <span class="media-title">18+</span>
                                <p class="media-text">Cursos unicos</p>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section> 

<!--==============================
    price Area
==============================-->
<section id="ed-price" class="ed-price-section space-top">
    <div class="container">
        <div class="title-area text-center wow fadeInUp" data-wow-delay="0.3s">
            <div class="sec-icon">
                <div class="vs-circle"></div>
            </div>
            <span class="sec-subtitle">Membresías KTA</span>
            <h2 class="sec-title">Nuestras Membresías KTA</h2>
        </div>
        <div class="ed-price-content mt-45">
            <div class="row justify-content-center">
                
                <?php foreach($membresias as $membresia):?>
                    <div class="col-lg-4 col-md-6 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1000ms">
                        <div class="ed-price-item">
                            <div class="item-top">
                                <div class="item-icon">
                                    <img src="/assets/membresias/<?=$membresia->photo?>" alt="">
                                </div>
                                <div class="item-text headline pera-content">
                                    <h3><?=$membresia->type?></h3>
                                    <span>$<?=$membresia->price?> USD/<?=$membresia->max_time_membership?> meses</span>
                                </div>
                            </div>
                            <div class="item-btn btn-spin text-center">
                                <a href="/checkout/membership/<?=$membresia->id_membership?>">¡Comprar ahora!</a>
                            </div>
                            <div class="item-list ul-li-block">
                                <?=$membresia->caract?>
                            </div>
                            <div class="price-slug text-center"><span>Realiza tu pago con tarjeta o afterPay</span></div>
                        </div>
                    </div>    
                <?php endforeach;?>
            </div>
        </div>
    </div>
</section>

<!--==============================
    Team Area
==============================-->
<section class="space-top space-extra-bottom">
    <div class="container">
        <div class="title-area text-center wow fadeInUp" data-wow-delay="0.3s">
            <div class="sec-icon">
                <div class="vs-circle"></div>
            </div>
            <span class="sec-subtitle">Conoce al equipo KTA</span>
            <h2 class="sec-title">Tenemos a los mejores maestros que te ayudaran a pasar al siguiente nivel</h2>
        </div>
        
        <div class="row vs-carousel wow fadeInUp gx-40" data-wow-delay="0.4s" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="2" data-center-mode="true">
            <!-- <?php foreach($teachers as $teacher):?>
                <div class="col-sm-6 col-lg-4">
                    <div class="team-style1">
                        <div class="team-img">
                            <img class="w-100" src="/assets/teachers/<?=$teacher->photo?>" alt="teacher">
                        </div>
                        <div class="team-content">
                            <div class="team-review"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                            <h4 class="team-name"><a href="/profesor/view/<?=$teacher->id_teacher?>"><?=$teacher->name?></a></h4>
                            <p class="team-degi"><?=$teacher->speciality?></p>
                            <p class="team-degi"><?=$teacher->experience?> <span data-section="teacher-details" data-label="years-experience">años de experiencia </span></p>
                        </div>
                    </div>
                </div>    
            <?php endforeach;?> -->    
        </div>
        <?php include_once __DIR__.'/../components/teachers.php'; ?>
    </div>
</section> 

<!--==============================
    Upcoming Events Area
==============================-->

<?php if(!is_null($lives)):?>
    <section class="overflow-hidden space-top space-extra-bottom pt-30">
        <div class="event-shape1"></div>
        <div class="shape-mockup jump d-none d-xxl-block" data-bottom="26%" data-right="-270px">
            <div class="vs-border-circle"></div>
        </div>
        <div class="container">
            <div class="row gx-80">
                <div class="col-lg-6 col-xxl-5 pb-3 pb-lg-0 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="picture-box1">
                        <div class="picture-1 mega-hover"><img src="/assets/images/fundadores1.jpg" alt="picture"></div>
                    </div>
                </div>
                <div class="col-lg-6 col-xxl-7 align-self-center wow fadeInUp" data-wow-delay="0.2s">
                    <div class="title-area mb-40 text-center text-md-start">
                        <span class="sec-subtitle text-white">Cursos en vivo</span>
                        <h2 class="sec-title h1 text-white">Proximas clases</h2>
                    </div>

                    <?php foreach($lives as $live):?>
                        <?php $fechas =  Helpers::formatearFechasHoras($live->dates_times);?>
                        <a href="/live/view/<?=$live->url?>" style="width:100%">
                            <div class="event-style1">
                                <div class="event-date">
                                    <?php $fechaIndividual = explode(',', $fechas['fechas']) ?>
                                    <?php $dataFecha = explode(' ', $fechaIndividual[0])?>
                                    <span class="day"><?=$dataFecha['0']?></span><span class="month"><?=$dataFecha['1']?></span>
                                </div>
                                <div class="event-body">
                                    <h4 class="event-title"><?=$live->name?></h4>
                                    <div class="event-meta">
                                        <span><i class="fas fa-clock"></i><?= $fechas['horas'] ?> <span class="curso__detail-timezone">Hora del este</span></span>
                                        <span><i class="far fa-map"></i>Online</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </section>
<?php endif;?>

<!--==============================
Reviews
==============================-->
<section class="reviews mt-40">
    <div class="row justify-content-center text-center">
        <div class="col-xl-9 wow fadeInUp" data-wow-delay="0.3s">
            <div class="title-area">
                <div class="sec-icon"><span class="vs-circle"></span></div>
                <span class="sec-subtitle">Reviews</span>
                <h2 class="sec-title">Triunfadores Que Confiaron En KTA Institute</h2>
            </div>
        </div>
    </div>

    <div class="reviews__container">
        <img class="reviews__img-google" src="/assets/images/EXCELENTE.png" alt="reviews en google">

        <div class="swiper swiper-reviews">
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
            
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<!--==============================
Podcast
==============================-->
<section class="podcast">
    <div class="title-area text-center wow fadeInUp" data-wow-delay="0.3s">
        <div class="sec-icon">
            <div class="vs-circle"></div>
        </div>
        <span class="sec-subtitle">Nuestro podcast</span>
        <h2 class="sec-title">Disfruta con nuestro Podcast Nadie es Importante</h2>
    </div>

    <div class="podcast__container">
        <iframe class="podcast__video" src="https://www.youtube.com/embed/r8HnB7-qszQ?si=S8vWoNHHLcBSg9s0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <iframe class="podcast__video" src="https://www.youtube.com/embed/ArGNjAur_ow?si=ftHMCxq2gjV71WCI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <iframe class="podcast__video" src="https://www.youtube.com/embed/uFptyMLZEFE?si=r1gsNYkNHZsQX8hd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
</section>

<?php include_once __DIR__.'/../components/popups.php'; ?>
<?php include_once __DIR__.'/../components/footerFinal.php'; ?>

<script>
    
    const swiper1 = new Swiper(".mySwiper", {
            slidesPerView: 2,  
            spaceBetween: 10,
            loop: false,
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
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 3
            }
        }
    });
</script>

<script>
    
    const swiper2 = new Swiper(".swiper-reviews", {
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
                slidesPerView: 2
            },
            1024: {
                slidesPerView: 3
            }
        },
        autoplay: {
            delay: 5000,
        }
    });
</script>

<!-- Jquery -->
<script src="/assets/js/vendor/jquery-3.6.0.min.js"></script>
<!-- Slick Slider -->
<script src="/assets/js/slick.min.js"></script>
<!-- <script src="/assets/js/app.min.js"></script> -->
<!-- Bootstrap -->
<script src="/assets/js/bootstrap.min.js"></script>
<!-- Wow.js Animation -->
<script src="/assets/js/wow.min.js"></script>
<!-- Magnific Popup -->
<script src="/assets/js/jquery.magnific-popup.min.js"></script>
<!-- Main Js File -->
<script src="/assets/js/main.js"></script>

<!-- For Js Library -->
<script src="assets/js2/jquery-3.7.0.min.js"></script>
<script src="assets/js2/bootstrap.bundle.min.js"></script>
<script src="assets/js2/swiper-bundle.min.js"></script>
<script src="assets/js2/wow.min.js"></script>
<script src="assets/js2/appear.js"></script>
<script src="assets/js2/gsap.min.js"></script>
<script src="assets/js2/knob.js"></script>
<script src="assets/js2/jquery.counterup.min.js"></script>
<script src="assets/js2/isotope.pkgd.min.js"></script>
<script src="assets/js2/imagesloaded.pkgd.min.js"></script>
<script src="assets/js2/waypoints.min.js"></script>
<script src="assets/js2/jqueryui.js"></script>
<script src="assets/js2/jquery.magnific-popup.min.js"></script>
<script src="assets/js2/jquery.marquee.min.js"></script>
<script src="assets/js2/lenis.min.js"></script>
<script src="assets/js2/split-type.min.js"></script>
<script src="assets/js2/ScrollTrigger.min.js"></script>
<script src="assets/js2/SplitText.min.js"></script>
<script src="assets/js2/jquery.nice-select.min.js"></script>
<script src="assets/js2/script.js"></script>

<?php 
    $menuVersion = filemtime('assets/js/menu.js');
    $saleVersion = filemtime('assets/js/saleAlerts.js');
    $swiperVersion = filemtime('assets/js/swiper.js');

    $scripts ='
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
        <script src="/assets/js/saleAlerts.js?v='.$saleVersion.'"></script>
        <script src="/assets/js/swiper.js?v='.$swiperVersion.'"></script>
    ';
?>