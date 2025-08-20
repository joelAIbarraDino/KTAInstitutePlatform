<?php

    use App\Classes\Helpers;

    $css2Version = filemtime('assets/css/style.css');
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
    ';

?>

<!--==============================
    Mobile Menu
    ============================== -->
    <div class="vs-menu-wrapper">
        <div class="vs-menu-area text-center">
            <button class="vs-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="/"><img src="/assets/images/logoKTA.jpg" alt="Educino"></a>
            </div>
            <div class="vs-mobile-menu">
                <ul>
                    <li class="menu-item-has-children">
                        <a href="#">Cursos</a>
                        <ul class="sub-menu">
                            <li><a href="/cursos">Self study</a></li>
                            <li><a href="/lives">Cursos en vivo</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/calendario">Calendario</a>
                    </li>
                    <li>
                        <a href="/nosotros">¿Quiénes somos?</a>
                    </li>
                    <li>
                        <a href="/membresias">Membresías</a>
                    </li>
                    <li>
                        <a href="/testimonios">Testimonios</a>
                    </li>
                    <li>
                        <a href="/login">Iniciar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--==============================
    Popup Search Box
    ============================== -->
    <div class="popup-search-box d-none d-lg-block  ">
        <button class="searchClose"><i class="fal fa-times"></i></button>
        <form action="#">
            <input type="text" class="border-theme" placeholder="What are you looking for">
            <button type="submit"><i class="fal fa-search"></i></button>
        </form>
    </div>
    <!--==============================
    Header Area
    ==============================-->
    <header class="vs-header header-layout1">
        <div class="header-top">
            <div class="container">
                <div class="row justify-content-between align-items-center gx-50">
                    <div class="col d-none d-xl-block">
                        <div class="header-links">
                            <ul>
                                <li><i class="fas fa-phone-alt"></i>Phone: <a href="tel:+18885921822">(888)5921822</a></li>
                                <li><i class="fas fa-envelope"></i>Email: <a href="mailto:soporte@ktainstitute.com">soporte@ktainstitute.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col col-xl-auto px-0 d-none d-md-block">
                        <a class="user-login" href="/login"><i class="fas fa-user-circle"></i> Iniciar sesión</a>
                    </div>
                    <div class="col-md-auto text-center">
                        <div class="header-social">
                            <a href="https://www.facebook.com/ktainstitute"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.instagram.com/ktainstitute/"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/@ktainstitute"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-wrapper">
            <div class="sticky-active">
                <div class="container position-relative z-index-common">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="vs-logo"> 
                                <a href="/"><img src="/assets/images/logoKTA.jpg" alt="logo">KTA Institute</a>
                            </div>
                        </div>
                        <div class="col text-end text-xl-center">
                            <nav class="main-menu menu-style1 d-none d-lg-block">
                                <ul>
                                    <li class="menu-item-has-children"> <a href="#">Cursos</a>
                                        <ul class="sub-menu">
                                            <li><a href="/cursos">Self study</a></li>
                                            <li><a href="/lives">Cursos en vivo</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <a href="/calendario">Calendario</a>
                                    </li>
                                    <li>
                                        <a href="/nosotros">¿Quiénes somos?</a>
                                    </li>
                                    <li>
                                        <a href="/membresias">Membresías</a>
                                    </li>
                                    <li>
                                        <a href="/testimonios">Testimonios</a>
                                    </li>
                                </ul>
                            </nav>
                            <button class="vs-menu-toggle d-inline-block d-lg-none"><i class="fal fa-bars"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>    
    <!--==============================
    Hero Area
    ==============================-->
    <section class="hero-layout1">
        <div class="vs-carousel" data-fade="true" data-arrows="true" data-dots="true">
            
            <?php foreach($sliders as $slider):?>
                <div>
                    <div class="hero-inner">
                        
                        <?php if($slider->type_background=="picture"):?>
                            <div class="hero-bg" data-bg-src="/assets/slidebar/<?=$slider->background?>"></div>
                        <?php else:?>
                            <iframe
                                src="https://player.vimeo.com/video/<?=$slider->id_video?>?background=1&autoplay=1&loop=1&byline=0&title=0&muted=1"
                                frameborder="0"
                                allow="autoplay; fullscreen"
                                allowfullscreen
                                class="slider__video"
                                id="bg-video"
                            ></iframe>
                        <?php endif;?>
                        
                        <div class="container">
                            <div class="hero-content">
                                <h1 class="hero-title animated" data-section="slidebar-<?=$slider->id_slidebar?>" data-label="title"><?=$slider->title?></h1>
                                <p class="hero-text animated" data-section="slidebar-<?=$slider->id_slidebar?>" data-label="subtitle"><?=$slider->subtitle?></p>
                                
                                <?php if($slider->link && $slider->CTA):?>
                                    <div class="hero-btns animated">
                                        <a href="<?=$slider->link?>" class="vs-btn style5"><i class="far fa-angle-right"></i> <span data-section="slidebar-<?=$slider->id_slidebar?>" data-label="CTA"><?=$slider->CTA?></span></a>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </section>

    <div class="gif">
        <img src="/assets/images/gif.gif" alt="gif" class="gif__image">
    </div>

    <!--==============================
      Features
    ==============================-->
    <section class="space-top space-extra-bottom">
        <div class="container">
            <div class="row vs-carousel wow fadeInUp" data-wow-delay="0.4s" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="2" data-center-mode="true" data-xl-center-mode="true" data-ml-center-mode="true">
                <div class="col-sm-6 col-xl-4">
                    <div class="feature-style1">
                        <div class="feature-icon">
                            <img src="/assets/images/reunion.png" alt="Feature Icon">
                            <div class="vs-circle"></div>
                        </div>
                        <h4 class="feature-title"><a href="/lives" class="text-inherit">CURSOS EN VIVO</a></h4>
                        <p class="feature-text">La mayoría de nuestros cursos ofrecen la posibilidad de ser realizados en vivo, permiten la interacción con el instructor y aseguran que los contenidos estén siempre actualizados.</p>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="feature-style1">
                        <div class="feature-icon">
                            <img src="/assets/images/conferencia.png" alt="Feature Icon">
                            <div class="vs-circle"></div>
                        </div>
                        <h4 class="feature-title"><a href="/lives" class="text-inherit">Seminarios presenciales</a></h4>
                        <p class="feature-text">Organizamos distintos seminarios presenciales para que pueda continuar con tu formación tributaria en distintas ciudades del país como Los Ángeles, Orlando, Houston, Phoenix, San Diego, New York, Miami, etc...</p>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="feature-style1">
                        <div class="feature-icon">
                            <img src="/assets/images/online.png" alt="Feature Icon">
                            <div class="vs-circle"></div>
                        </div>
                        <h4 class="feature-title"><a href="/cursos" class="text-inherit">Cursos self study</a></h4>
                        <p class="feature-text">Ofrecemos todos nuestros cursos en formato self study para que estudie cuándo, dónde y cómo desee. Todos los cursos son actualizados permanentemente.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--==============================
      About Area
    ==============================-->
    <section class="overflow-hidden space-extra-bottom">
        <div class="shape-mockup jump-img d-hd-none d-none d-xxxl-block" data-left="-15%" data-top="2%">
            <div class="vs-border-circle"></div>
        </div>
        <div class="shape-mockup jump-reverse d-none d-xxxl-block" data-right="7%" data-top="38%">
            <div class="shape-dotted"></div>
        </div>
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-xl-9 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="title-area">
                        <div class="sec-icon"><span class="vs-circle"></span></div>
                        <span class="sec-subtitle">Bienvenidos a KTA Institute</span>
                        <h2 class="sec-title h1">Para nosotros enseñar es más importante que asistir.</h2>
                    </div>
                </div>
            </div>
            <div class="row gx-70">
                <div class="col-lg-7 col-xxl-7">
                    <div class="img-box3">
                        <div class="img-1 mega-hover">
                            <div id="player">
                                <iframe
                                    id="plyr-video"
                                    src="https://player.vimeo.com/video/727556671"
                                    allowfullscreen
                                    allowtransparency
                                    allow="autoplay"
                                ></iframe>
                            </div>
                        </div>
                        <div class="shape-dotted jump"></div>
                    </div>
                </div>
                <div class="col-lg-5 col-xxl-4 align-self-center">
                    <p class="fs-md">Somos una institución de profesionales con experiencia en el desarrollo de empresas y personas, comprometidos a impartir conocimientos de manera íntegra y legal, respetando siempre normas y ética profesional.</p>
                    <p class="fs-md">Nuestro propósito es apoyar al inmigrante en su integración exitosa en Estados Unidos, ofreciendo capacitación que promueve crecimiento personal, profesional y ciudadanía plena.</p>
                    <div class="media-style1">
                        <div class="media-img media-president"><img src="/assets/images/fundador.jpg" alt="About Author"></div>
                        <div class="media-body">
                            <span class="media-label">Carlos catarino</span>
                            <p class="media-info">Fundador de KTA Institute</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class=" space-bottom">
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

                    <h2 class="form-title h1">Lo que Hemos Logrado Juntos</h2>
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
      Course Area
    ==============================-->
    <section class="space-top space-extra-bottom" data-bg-src="assets/img/bg/course-bg-pattern.jpg">
        <div class="container-lg">
            <div class="title-area text-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="sec-icon">
                    <div class="vs-circle"></div>
                </div>
                <span class="sec-subtitle">Explora los cursos que tenemos para ti</span>
                <h2 class="sec-title">Próximos Cursos</h2>
            </div>
            <div class="row vs-carousel wow fadeInUp" data-wow-delay="0.4s" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="2" data-center-mode="true" data-dots="true">
                <?php foreach($courses as $course):?>
                    <div class="col-sm-6 col-xl-4">
                        <div class="course-style1">
                            <div class="course-img">
                                <a href="course-details.html"><img class="w-100" src="/assets/thumbnails/courses/<?=$course->thumbnail?>" alt="Course Img"></a>
                                <div class="course-category"><?=$course->category?></div>
                            </div>
                            <div class="course-content">
                                <div class="course-top">
                                    <?php if($course->enrollment > 0):?>
                                        <div class="course-review"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                                    <?php else:?>
                                        <div class="course-review"></div>
                                    <?php endif;?>
                                    
                                    <span class="course-price">$<?=$course->price?></span>
                                </div>
                                <h3 class="h5 course-name"><a href="/curso/view/<?=$course->url?>"><?=$course->name?></a></h3>
                                <div class="course-teacher"><a href="/profesor/view/<?=$course->id_teacher?>" class="text-inherit"><?=$course->teacher?></a></div>
                            </div>
                            <div class="course-meta">
                                <span><i class="fal fa-users"></i><?=$course->enrollment?> Students</span>
                                <span><i class="far fa-clock"></i><?=$course->max_months_enroll?> <span data-section="course-details">Meses de acceso</span></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
                    
            </div>
        </div>
    </section>

        <!--==============================
    Categorias
    ==============================-->
    <section class="categorias">
        <div class="row justify-content-center text-center">
            <div class="col-xl-9 wow fadeInUp" data-wow-delay="0.3s">
                <div class="title-area">
                    <div class="sec-icon"><span class="vs-circle"></span></div>
                    <span class="sec-subtitle">Categorías</span>
                    <h2 class="sec-title h1">Busca el curso ideal para ti</h2>
                </div>
            </div>
        </div>

        <div class="categorias__grid" data-aos="fade-up">
            
            <?php foreach($categories as $category ): ?>
                <a href="/cursos/categoria/<?=$category->id_category?>">
                    <div class="categoria">
                        <i class="categoria__icono bx <?=$category->icon?>"></i>

                        <p class="categoria__name"><?=$category->name?></p>
                        
                        <div class="categoria__logo-container">
                            <img class="categoria__logo" src="/assets/images/logoKTA.png" alt="">
                        </div>
                    </div>
                </a>
            <?php endforeach;?>
        </div>

    </section>
    
    <!--==============================
    Reviews
    ==============================-->
    <section class="reviews">
        <div class="row justify-content-center text-center">
            <div class="col-xl-9 wow fadeInUp" data-wow-delay="0.3s">
                <div class="title-area">
                    <div class="sec-icon"><span class="vs-circle"></span></div>
                    <span class="sec-subtitle">Reviews</span>
                    <h2 class="sec-title h1">Triunfadores Que Confiaron En KTA Institute</h2>
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
    Call To Action
    ==============================-->
    <section class="" data-bg-src="assets/img/bg/divider-bg-1-1.jpg">
        <div class="container">
            <div class="row align-items-center text-center text-lg-start">
                <div class="col-lg-5 col-xl-6 space-extra">
                    <h2 class="sec-title text-white mb-3">Cursos en vivo</h2>
                    <p class="fs-md text-white">Cada uno de los encuentros de clases, se realizan mediante la plataforma de conferencias de zoom que nos permite poder interacturar, presentar y resolver en el mismo instante cualquier problema que tengamos.</p>
                    <div class="row gx-60 mb-4 pb-xl-3 text-start justify-content-center justify-content-lg-start">
                        <div class="col-auto col-lg-12 col-xl-auto">
                            <div class="list-style4 vs-list ">
                                <ul class="list-unstyled m-0">
                                    <li>Mas de 25 cursos en 7 categorias.</li>
                                    <li>Mentorias Personalizadas Proyectos finales y evaluaciones.</li>
                                    <li>Certificaciones completas para crear los profesionales del futuro.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <a href="/lives" class="vs-btn style5"><i class="far fa-angle-right"></i>Cursos en vivo</a>
                </div>
                <div class="col-lg-7 col-xl-6 align-self-end">
                    <div class="img-box2">
                        <div class="vs-circle"></div>
                        <img class="img-1" src="/assets/images/logoKTA.jpg" alt="">
                    </div>
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
                <h2 class="sec-title h1">Tenemos a los mejores maestros que te ayudaran a pasar al siguiente nivel</h2>
            </div>
            <div class="row vs-carousel wow fadeInUp gx-40" data-wow-delay="0.4s" data-slide-show="3" data-lg-slide-show="2" data-md-slide-show="2" data-sm-slide-show="2" data-center-mode="true">
            
                <?php foreach($teachers as $teacher):?>
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
                <?php endforeach;?>
            </div>
        </div>
    </section> 
    <!--==============================
      Upcoming Events Area
    ==============================-->

    <?php if(!is_null($lives)):?>
        <section class="overflow-hidden space-top space-extra-bottom">
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
                            <div class="event-style1">
                                <div class="event-date">
                                    <?php $fechaIndividual = explode(',', $fechas['fechas']) ?>
                                    <?php $dataFecha = explode(' ', $fechaIndividual[0])?>
                                    <span class="day"><?=$dataFecha['0']?></span><span class="month"><?=$dataFecha['1']?></span>
                                </div>
                                <div class="event-body">
                                    <h4 class="event-title"><a href="/live/view/<?=$live->url?>" class="text-reset"><?=$live->name?></a></h4>
                                    <div class="event-meta">
                                        <span><i class="fas fa-clock"></i><?= $fechas['horas'] ?> <span class="curso__detail-timezone">Hora del este</span></span>
                                        <span><i class="far fa-map"></i>Online</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>
    <!--==============================
    CTA Area
    ==============================-->
    <section class="space-top space-extra-bottom" data-bg-src="assets/img/bg/blog-single-divider-bg-1-1.jpg">
        <div class="container">
            <div class="row justify-content-between text-center text-lg-start">
                <div class="col-lg-6 mb-40 mb-lg-0">
                    <h2 class="mt-n2 h2 mb-3">Cursos Certificados y Avalados</h2>
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

    <?php include_once __DIR__.'/../components/popups.php'; ?>
    <!--==============================
    Footer Area
    ==============================-->
    <footer class="footer-wrapper footer-layout1">
        <div class="shape-mockup jump d-none d-xxxl-block" data-bottom="0%" data-left="-270px">
            <div class="vs-border-circle"></div>
        </div>
        <div class="widget-area">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-xl-auto">
                        <div class="widget footer-widget">
                            <div class="vs-widget-about">
                                <div class="footer-logo"> <a href="/"><img src="/assets/images/logoKTA.jpg" alt="logo"></a> </div>
                                <p class="footer-text">Ayudando al inmigrante en su integración total y exitosa en los Estados Unidos, ayudamos a las personas a alcanzar sus metas y perseguir sus sueños.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-xl-auto">
                        <div class="widget nav_menu footer-widget">
                            <h3 class="widget_title">Menú</h3>
                            <div class="menu-all-pages-container footer-menu">
                                <ul class="menu">
                                    <li><a href="/calendario">Calendario</a></li>
                                    <li><a href="/nosotros">¿Quiénes somos?</a></li>
                                    <li><a href="/membresias">Membresías</a></li>
                                    <li><a href="/testimonios">Testimonios</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-6 col-xl-auto">
                        <div class="widget nav_menu footer-widget">
                            <h3 class="widget_title">Contáctanos</h3>
                            <div class="menu-all-pages-container footer-menu">
                                <ul class="menu">
                                    <li><a href="tel:+18885921822">(888)5921822</a></li>
                                    <li><a href="mailto:soporte@ktainstitute.com">soporte@ktainstitute.com</a></li>
                                    <li><a href="https://www.google.com/maps/place/308+Ave+G+SW+%23220,+Winter+Haven,+FL+33880,+EE.+UU./@28.0145189,-81.7342479,17z/data=!3m1!4b1!4m5!3m4!1s0x88dd12fcdb026b2d:0xc1191d8014b716cb!8m2!3d28.0145142!4d-81.7316676?entry=tts&g_ep=EgoyMDI1MDcyMy4wIPu8ASoASAFQAw%3D%3D&skid=3a9d957c-b50a-47d2-bf06-5ef80def2337">308 Ave G SW Suite 220, Winter Haven, FL 33880</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-auto">
                        <div class="widget  footer-widget">
                            <h3 class="widget_title">Cursos recientes</h3>
                            <div class="recent-post-wrap">
                                <?php foreach($courses as $index=>$course):?>
                                    <?php if($index < 2):?>
                                        <div class="recent-course">
                                            <div class="media-img"><a href="/curso/view/<?=$course->url?>"><img src="/assets/thumbnails/courses/<?=$course->thumbnail?>" alt="Blog Image"></a></div>
                                            <div class="media-body">
                                                <div class="recent-course-meta"><a href="/profesor/view/<?=$course->id_teacher?>"><?=$course->teacher?></a></div>
                                                <h4 class="post-title"><a class="text-inherit" href="/curso/view/<?=$course->url?>"><?=$course->name?></a></h4>
                                            </div>
                                        </div>
                                    <?php else:?>
                                        <?php break;?>
                                    <?php endif;?>
                                    
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-wrap">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="text-center col-lg-auto">
                        <p class="copyright-text">Copyright <i class="fal fa-copyright"></i> <?=date('Y')?> <a href="/"> K’ta & Associate LLC.</a>Todos los derechos reservados.</p>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <div class="social-style1">
                            <a href="https://www.facebook.com/ktainstitute"><i class="fab fa-facebook-f"></i>Facebook</a>
                            <a href="https://www.instagram.com/ktainstitute/"><i class="fab fa-instagram"></i>Instagram</a>
                            <a href="https://www.youtube.com/@ktainstitute"><i class="fab fa-youtube"></i>Youtube</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> 

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

    <script>
        // Instancias de Vimeo
        const bgPlayer = new Vimeo.Player(document.getElementById('bg-video'));

        // Si usas Plyr.js como UI, puedes también instanciar Plyr (aunque no es estrictamente necesario para este control)
        const plyrUI = new Plyr('#player');

        // Reproducir el de fondo si lo pausa Vimeo al dar play en el de Plyr
        plyrUI.on('play', () => {
            setTimeout(() => {
            bgPlayer.getPaused().then(paused => {
                if (paused) {
                bgPlayer.play();
                }
            });
            }, 400); // tiempo breve para esperar la pausa automática
        });
    </script>
    <!-- Scroll To Top -->
    <a href="#" class="scrollToTop scroll-btn"><i class="far fa-arrow-up"></i></a>

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

    <?php 
        $saleVersion = filemtime('assets/js/saleAlerts.js');
        $swiperVersion = filemtime('assets/js/swiper.js');

        $scripts ='
            <script src="/assets/js/saleAlerts.js?v='.$saleVersion.'"></script>
            <script src="/assets/js/swiper.js?v='.$swiperVersion.'"></script>
        ';
    ?>
