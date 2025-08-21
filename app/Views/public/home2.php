<?php

    use App\Classes\Helpers;

    $css3Version = filemtime('assets/css2/style.css');
    $topScripts = '
      	<link rel="stylesheet" href="/assets/css2/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css2/fontawesome.css">
        <link rel="stylesheet" href="/assets/css2/animate.css">
        <link rel="stylesheet" href="/assets/css2/swiper.min.css">
        <link rel="stylesheet" href="/assets/css2/jquery-ui.css"> 
        <link rel="stylesheet" href="/assets/css2/magnific-popup.css">
        <link rel="stylesheet" href="/assets/css2/nice-select.css">
        <link rel="stylesheet" href="/assets/css2/style.css?v='.$css3Version.'">
    ';
?>

<div class="ed-up">
    <a href="#" class="ed-scrollup text-center"><i class="fas fa-chevron-up"></i></a>
</div>


<!-- Start of Header section
============================================= -->
<header id="ed-header" class="ed-header-section header_style_one txa_sticky_header">
    <div class="ed-header-content d-flex align-items-center justify-content-between">
        <div class="logo-action d-flex align-items-center">
            <div class="brand-logo">
                <a href="/"><img src="/assets/images/logoKTA.jpg" alt="Logo"></a>
            </div>
            <div class="action-select ed-option">
                <select>
                    <option value="/cursos">Nuestros cursos</option>
                    <?php if(!is_null($categories)):?>
                        <?php foreach($categories as $category):?>
                            <option value="/cursos/categoria/<?=$category->id_category?>"><?=$category->name?></option>
                        <?php endforeach;?>
                    <?php endif;?>
                </select>
            </div>
        </div>
        <div class="header-navigation-cta d-flex align-items-center">
            <nav class="main-navigation clearfix ul-li">
                <ul id="main-nav" class="nav navbar-nav clearfix">
                    <li><a href="/">Inicio</a></li>
                    <li class="dropdown active">
                        <a href="/cursos">Cursos</a>
                        <ul class="dropdown-menu clearfix">
                            <li><a class="/cursos" href="index.html">Self study</a></li>
                            <li><a href="/lives">Cursos en vivo</a></li>
                        </ul>
                    </li>
                    <li><a href="/nosotros">Nososotros</a></li>
                    <li><a href="/membresias">Membresías</a></li>
                    <li><a href="/testimonios">Testimonios</a></li>
                </ul>
            </nav>
            <div class="cart-btn d-flex align-items-center">
                <div class="header-cta-btn btn-spin">
                    <a href="/login">Iniciar sesión</a>
                </div>
            </div>
            <button class="agt-mobile-menu-btn mobile_menu_button open_mobile_menu">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
</header>
<!-- Mobile-start -->
<div class="mobile_menu lenis lenis-smooth ofcanvas_sidebar position-relative">
    <div class="mobile_menu_wrap">
        <div class="mobile_menu_overlay open_mobile_menu"></div>
        <div class="mobile_menu_content">
            <div class="mobile_menu_close open_mobile_menu">
                <i class="fas fa-times"></i>
            </div>
            <div class="m-brand-logo">
                <a href="#"><img src="/assets/images/logoKTA.jpg" alt=""></a> 
            </div>
            <nav class="mobile-main-navigation  clearfix ul-li">
                <ul id="m-main-nav" class="nav navbar-nav clearfix">
                    <li><a href="/">Inicio</a></li>
                    <li class="dropdown active">
                        <a href="/cursos">Cursos</a>
                        <ul class="dropdown-menu clearfix">
                            <li><a class="/cursos" href="index.html">Self study</a></li>
                            <li><a href="/lives">Cursos en vivo</a></li>
                        </ul>
                    </li>
                    <li><a href="/nosotros">Nososotros</a></li>
                    <li><a href="/membresias">Membresías</a></li>
                    <li><a href="/testimonios">Testimonios</a></li>
                </ul>
            </nav>
            <div class="ptx-mobile-header-social text-center">
                <a target="_blank" href="https://www.instagram.com/ktainstitute/"> <i class="fab fa-instagram"></i></a>
                <a target="_blank" href="https://www.facebook.com/ktainstitute"> <i class="fab fa-facebook"></i></a>
                <a target="_blank" href="https://www.youtube.com/@ktainstitute"> <i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    <!-- /Mobile-Menu -->
</div>
<!-- End of Header section
============================================= -->

<!-- Start of Hero section
============================================= -->
<?php if(!is_null($sliders)):?>
    <?php foreach($sliders as $key=>$slider):?>
        <?php if($key < 1):?>
            <section id="ed-hero-1" class="ed-hero-section-1 position-relative" data-background="/assets/img2/hero/hero-bg.png">
                <span class="ed-h-shape1 position-absolute"><img src="/assets/img2/hero/shape1.png" alt=""></span>
                <span class="ed-h-shape2 position-absolute"><img src="/assets/img2/hero/shape1.png" alt=""></span>
                <div class="container">
                    <div class="ed-h1-content position-relative">
                        <div class="h1-img-wrap">
                            <div class="ed-img-shape1 position-absolute"><span><img src="/assets/img2/hero/shp1.png" alt=""></span></div>
                            <div class="ed-img-shape2 position-absolute"><span><img src="/assets/img2/hero/shp2.png" alt=""></span></div>
                            <div class="ed-img-shape3 position-absolute"><span><img src="/assets/img2/hero/shp3.png" alt=""></span></div>
                            <div class="ed-img-shape4 position-absolute"><span><img src="/assets/img2/hero/shp4.png" alt=""></span></div>
                            <div class="ed-img-shape5 position-absolute"><span><img src="/assets/img2/hero/shp5.png" alt=""></span></div>
                            
                            
                            <div class="item-img">
                                <img src="/assets/images/fundadores-about.jpg" alt="">
                            </div>
                        </div>
                        <div class="h1-text-wrap headline pera-content">
                            <div class="h1-text-area edh-text">
                                <span class="h1_slug">Bienvenido a KTA Institute</span>
                                <h1 class="hero_title_1 banner_title agt_hero_title"><?=$slider->title?></h1>
                                <p><?=$slider->subtitle?></p>
                            </div>
                            
                            <?php if($slider->link && $slider->CTA):?>
                            <a href="<?=$slider->link?>" class="home2-cta-index"><?=$slider->CTA?></a>
                        <?php endif;?>
                        </div>
                    </div>
                </div>
            </section>
        <?php else:?>
            <?php break;?>
        <?php endif;?>
        
    <?php endforeach;?>
<?php endif;?>


<!-- End of Hero section
============================================= -->

<!-- Start of Course Category section
============================================= -->
<section id="ed-course-cate" class="ed-course-cate-sec">
    <div class="container">
        <div class="ed-course-cate-content">
            <div class="row justify-content-center">
                <?php foreach($categories as $category):?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1000ms">
                        <div class="ed-coc-item text-center">
                            <div class="item-img">
                                <i class="categoria__icono-2 bx <?=$category->icon?>"></i>
                            </div>
                            <div class="item-text headline pera-content">
                                <h3><a href="/cursos/categoria/<?=$category->id_category?>"><?=$category->name?></a></h3>
                                <p>cursos self study</p>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</section>
<!-- End of Course Category section
============================================= -->


<!-- Start of About section
============================================= -->			
<section id="ed-about-1" class="ed-about-sec-1 pt-30 pb-85">
    <div class="container">
        <div class="ed-about-content d-flex align-items-center">
            <div class="ed-ab-img1 ed_left_img">
                <img src="/assets/images/index-live.jpg" alt="">
            </div>
            <div class="ed-ab-text1">
                <div class="ed-sec-title ed-text headline pera-content">
                    <div class="rate-slug wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms"><i class="fa-solid fa-star"></i> La voz de quienes ya confiaron en nosotros</div>
                    <h2 class="sec_title ed-sec-tt-anim ed-has-anim">Opiniones que nos respaldan</h2>
                    <p>En KTA Institute nos enorgullece el impacto que generamos en nuestros 
                        estudiantes. La mayoría nos recomienda gracias a la calidad de nuestros cursos, la atención personalizada y el respaldo profesional que ofrecemos.
                        <a href="/testimonios">Puedes conocer de primera mano sus experiencias en nuestras</a>
                    </p>
                </div>
                <div class="ed-ab-review-wrap mt-25 mb-40 d-flex align-items-center justify-content-between">
                    <div class="ed-ab-review headline ul-li">
                        <h3>4.5+</h3>
                        <ul>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                        <span>Reviews de google</span>
                    </div>
                    <div class="ed-ab-review-list ul-li-block">
                        <ul>
                            <li class="top_view"><i class="fa-solid fa-circle-check"></i> Cursos certificados por el ISR</li>
                            <li class="top_view"><i class="fa-solid fa-circle-check"></i> Profesionales con experiencia</li>
                            <li class="top_view"><i class="fa-solid fa-circle-check"></i> Atención personalizada</li>
                        </ul>
                    </div>
                </div>
                <div class="ed-btn-1 btn-spin">
                    <a href="/testimonios">Ver mas reviews</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of About section
============================================= -->

<!-- Start of Featured section
============================================= -->
<section id="ed-ft-class" class="ed-ft-class-section position-relative">
    <div class="container">
        <div class="ed-ft-class-top-content d-flex align-items-end justify-content-between">
            <div class="ed-sec-title headline pera-content">
                <div class="subtitle wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">Cursos self study</div>
                <h2 class="sec_title ed-sec-tt-anim ed-has-anim">Próximos Cursos</h2>
            </div>
            <div class="ed-ft-class-top-btn tx-tab-btn ul-li">
                <ul class="nav nav-tabs" id="mt-about-tab" role="tablist">
                    <?php foreach($categories as $key=>$category):?>
                        <?php if($key < 5):?>
                            <li class="nav-item" role="presentation">
                            <a class="nav-link" href="/cursos/categoria/<?=$category->id_category?>">
                                <?=$category->name?>
                            </a>
                        </li>
                        <?php else:?>
                            <?php break;?>
                        <?php endif;?>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
    <div class="ed-ft-class-content mt-45 position-relative">
        <div class="custom-cursor"></div>
        <div class="ed-ft-class-tab-desc">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane show active animated fadeInUp" id="ft_1_1" role="tabpanel">
                    <div class="ed-ft-class-slider swiper-container">
                        <div class="swiper-wrapper">
                            <?php foreach($courses as $course):?>
                                <div class="swiper-slide">
                                    <div class="ed-ft-class-item">
                                        <div class="item-img position-relative">
                                            <div class="inner-img">
                                                <img src="/assets/thumbnails/courses/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>">
                                            </div>
                                            <span class="item-tag"><?=$course->category?></span>
                                            <span class="item-price d-flex justify-content-center align-items-center">$<?=$course->price?></span>
                                        </div>
                                        <div class="item-text headline pera-content">
                                            <h3 class="href-underline"><a href="/curso/view/<?=$course->url?>"><?=$course->name?></a></h3>
                                            <span class="crs-author"><?=$course->teacher?></span>
                                            <div class="crs-bottom d-flex justify-content-between align-items-center">
                                                <div class="bottom-btn btn-spin">
                                                    <a href="/checkout/course/<?=$course->url?>">Comprar ahora</a>
                                                </div>
                                                <span class="num-stu"><i class="fa-solid fa-user"></i> (<?=$course->enrollment?> Inscritos)</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ed-ft-nav d-flex">
            <div class="ed-ft-button-prev arrow-nav d-flex justify-content-center align-items-center"><i class="fa-solid fa-arrow-left"></i></div>
            <div class="ed-ft-button-next arrow-nav d-flex justify-content-center align-items-center"><i class="fa-solid fa-arrow-right"></i></div>
        </div>
    </div>
    <div class="ed-btn-1 mt-80 btn-spin text-center">
        <a href="/cursos">Ver más</a>
    </div>
</section>	
<!-- End of Featured section
============================================= -->

<!-- Start of Top Rate section
============================================= -->
<section id="ed-top-rate" class="ed-top-rate-sec position-relative" data-background="/assets/img2/bg/rate-bg2.jpg">
    <span class="ed-tr-shape1"><img src="/assets/img2/shape/sq1.png" alt=""></span>
    <span class="ed-tr-shape2"><img src="/assets/img2/shape/sq1.png" alt=""></span>
    <div class="container">
        <div class="ed-top-rate-content position-relative">
            <div class="ed-top-rate-img position-absolute">
                <div class="item-img1 ed_top_img_2 position-absolute">
                    <img src="/assets/img2/shape/circle2.png" alt="">
                </div>
                <div class="item-img2 ed_top_img">
                    <img src="/assets/images/membresia-banner.jpg" alt="">
                </div>
            </div>
            <div class="ed-top-rate-text position-relative">
                
                <div class="ed-sec-title headline pera-content">
                    <div class="subtitle wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">Tu Club de Profesionales</div>
                    <h2 class="sec_title ed-sec-tt-anim ed-has-anim">
                        Aprende, crece y conéctate con expertos.
                    </h2>
                </div>
                <div class="ed-top-rate-ft d-flex align-items-center flex-wrap">
                    <div class="top-rate-ft-item d-flex align-items-center">
                        <div class="item-icon d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="item-text headline pera-content">
                            <h3>Cursos incluidos</h3>
                            <span>Capacitación continua</span>
                        </div>
                    </div>
                    <div class="top-rate-ft-item d-flex align-items-center">
                        <div class="item-icon d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="item-text headline pera-content">
                            <h3>Asesoría directa</h3>
                            <span>Sesiones grupales y personalizadas</span>
                        </div>
                    </div>
                </div>
                <div class="ed-btn-1 btn-spin">
                    <a href="/membresias">Quiero inscribirme</a>
                </div>
            </div>
        </div>
    </div>
</section>			
<!-- End of Top Rate section
============================================= -->

<!-- Start of Team section
============================================= -->
<section id="ed-team-1" class="ed-team-sec-1 pt-100 pb-100">
    <div class="container">
        <div class="ed-sec-title headline pera-content">
            <div class="subtitle wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">Conoce al equipo KTA</div>
            <h2 class="sec_title ed-sec-tt-anim ed-has-anim">
                Tenemos a los mejores maestros que te ayudaran a pasar al siguiente nivel
            </h2>
        </div>
        <div class="ed-team-content mt-45">
            <div class="ed-team-slide swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach($teachers as $teacher):?>
                        <div class="swiper-slide">
                            <div class="ed-team-item-1">
                                <div class="item-img">
                                    <img src="/assets/teachers/<?=$teacher->photo?>" alt="">
                                </div>
                                <div class="item-text text-center headline pera-content">
                                    <h3><a href="/profesor/view/<?=$teacher->id_teacher?>"><?=$teacher->name?></a></h3>
                                    <span><?=$teacher->speciality?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach?>
                </div>
            </div>
        </div>
    </div>
</section>		
<!-- End of Team section
============================================= -->	

<!-- Start of price section
============================================= -->
<section id="ed-price" class="ed-price-section pt-120 pb-140">
    <div class="container">
        <div class="ed-sec-title text-center headline pera-content">
            <div class="subtitle wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">Membresías KTA</div>
            <h2 class="sec_title ed-sec-tt-anim ed-has-anim">Nuestras membresías KTA</h2>
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
<!-- End of price section
============================================= -->

<!-- Start of Testimonial section
============================================= -->
<section id="ed-testimonial" class="ed-testimonial-section">
    <div class="container">
        <div class="ed-sec-title text-center headline pera-content">
            <div class="subtitle wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">Reviews</div>
            <h2 class="sec_title ed-sec-tt-anim ed-has-anim">Triunfadores Que Confiaron En KTA Institute</h2>
        </div>
        <div class="ed-testimonial-content mt-75">
            <div class="ed-testimonial-slide swiper-container">
                <div class="swiper-wrapper">
                    <?php foreach($reviews as $review):?>
                        <div class="swiper-slide">
                            <div class="ed-testimonial-item d-flex">
                                <div class="item-img">
                                    <img src="<?=$review->photo?>" alt="<?=$review->photo?>">
                                </div>
                                <div class="item-text pera-content">
                                    <span>Opiniones sobre KTA</span>
                                    <p><?= Helpers::limitarTexto($review->review, 120) ?></p>
                                    <div class="item-bottom mt-20 d-flex justify-content-between align-items-center">
                                        <div class="inner-text headline">
                                            <h3><?=$review->author_name?></h3>
                                            <span><?=$review->relative_time?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>		
<!-- End of Testimonial section
============================================= -->

<!-- Start of Faq section
============================================= -->
<section id="ed-faq" class="ed-faq-section pt-120 pb-120">
    <div class="container">
        <div class="ed-sec-title text-center headline pera-content">
            <div class="subtitle wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">¿Tienes dudas?</div>
            <h2 class="sec_title ed-sec-tt-anim ed-has-anim">Preguntas Frecuentes</h2>
        </div>
        <div class="ed-faq-content mt-15">
            <div class="ed-faq-accordion">
                <div class="accordion" id="accordionExample_31">
                    
                    <div class="accordion-item faq_active wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
                        <h2 class="accordion-header" id="heading10">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                <span>Tengo que estar en los Estados Unidos para poder estudiar en el Instituto?</span>
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse show" aria-labelledby="heading10" data-bs-parent="#accordionExample_31">
                            <div class="accordion-body ">
                                <div class="bi-faq-text pera-content">
                                    <p>En Algunos cursos es Obligatorio vivir en los Estados Unidos.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq_active wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
                        <h2 class="accordion-header" id="heading10">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                <span>Las Clases son Grabadas, en vivo o Presencial:</span>
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse show" aria-labelledby="heading10" data-bs-parent="#accordionExample_31">
                            <div class="accordion-body ">
                                <div class="bi-faq-text pera-content">
                                    <p> 
                                        Tenemos 3 modalidades 
                                        <br>
                                        <br>
                                        <strong>Online en Vivo:</strong>donde usted interactúa con el Profesor en Vivo y aparte de eso puede volver a ver esa misma clase Grabadas por 6 meses .<br>
                                        <br>
                                        <strong>Pregrabadas:</strong> Usted tendrá acceso al curso o taller grabado por 6 meses <br>
                                        <br>
                                        <strong>Presencial:</strong> Cursos en persona<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq_active wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
                        <h2 class="accordion-header" id="heading10">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                <span>Cuales son las Formas de Pago</span>
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse show" aria-labelledby="heading10" data-bs-parent="#accordionExample_31">
                            <div class="accordion-body ">
                                <div class="bi-faq-text pera-content">
                                    <ol>
                                        <li>Puedes realizar el pago a través Zelle, de PayPal o tarjeta de crédito / débito.</li>
                                        <li>Financiamiento por Afterpay</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq_active wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
                        <h2 class="accordion-header" id="heading10">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                <span>Cuando Puedo Acceder al Curso:</span>
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse show" aria-labelledby="heading10" data-bs-parent="#accordionExample_31">
                            <div class="accordion-body ">
                                <div class="bi-faq-text pera-content">
                                    <p> 
                                        <br>
                                        <br>
                                        <strong>Si su clase en Online en VIVO:</strong>usted ingresara a la clase el día señalado<br>
                                        <br>
                                        <strong>Si Curso es Pregrabado:</strong> podrá tener acceso cuando realice el pago por la plataforma. <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq_active wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
                        <h2 class="accordion-header" id="heading10">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                <span>Puedo Descargar los Videos?</span>
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse show" aria-labelledby="heading10" data-bs-parent="#accordionExample_31">
                            <div class="accordion-body ">
                                <div class="bi-faq-text pera-content">
                                    <p> 
                                        No, por cuestiones de derechos de autor no puedes descargarlos, pero podrás verlos desde cualquier ordenador, iPad o móvil con conexión a Internet.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq_active wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
                        <h2 class="accordion-header" id="heading10">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                <span>Entregan Certificado?</span>
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse show" aria-labelledby="heading10" data-bs-parent="#accordionExample_31">
                            <div class="accordion-body ">
                                <div class="bi-faq-text pera-content">
                                    <p> 
                                        Si entregamos Certificado de Culminación en PDF, solo para los cursos, los Talleres de 1 día no tienen Certificado. 
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item faq_active wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
                        <h2 class="accordion-header" id="heading10">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                <span>Si tengo alguna pregunta o duda después del Curso puedo contactarlos?</span>
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse show" aria-labelledby="heading10" data-bs-parent="#accordionExample_31">
                            <div class="accordion-body ">
                                <div class="bi-faq-text pera-content">
                                    <p> 
                                        Si puede contactarnos, solicitar una Cita con el Docente con quien recibió el curso y Gustosamente se atenderá su duda, las citas se piden por el email <a href="mailto:info@ktainstitute.com">info@ktainstitute.com</a> o por el teléfono (786)6124893.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-item faq_active wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
                        <h2 class="accordion-header" id="heading10">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                <span>Si pago mi curso y después no puedo hacer el curso me devuelven el Dinero?</span>
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse show" aria-labelledby="heading10" data-bs-parent="#accordionExample_31">
                            <div class="accordion-body ">
                                <div class="bi-faq-text pera-content">
                                    <p> No realizamos ningún reembolso. </p>

                                    <ol>
                                        <li>Sin embargo, hacemos una excepción para los casos y causas de fuerza mayor. Salud, muerte de un ser querido.</li>
                                        <li>Se retendrá un precio fijo de $ 100,00 del monto reembolsado para los costos de logística.</li>
                                        <li>Cualquier curso iniciado vence en su totalidad.</li>
                                    </ol>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>		
<!-- End of Faq  section
============================================= -->

<!-- Start of Footer section
============================================= -->
<footer id="ed-footer-1" class="ed-footer-section-1" data-background="/assets/img2/bg/ftr-bg.jpg">
    <div class="container">
        <div class="ed-footer-content">
            <div class="ed-footer-widget-area d-flex justify-content-between">
                <div class="ed-ftr-widget">
                    <div class="logo-widget pera-content">
                        <div class="brand-logo home2-footer-logo">
                            <a href="/"><img src="/assets/images/logoKTA.jpg" alt=""></a>
                        </div>
                        <p>Ayudando al inmigrante en su integración total y exitosa en los Estados Unidos, ayudamos a las personas a alcanzar sus metas y perseguir sus sueños.</p>
                        <div class="logo-cta-info">
                            <div class="info-item d-flex align-items-center">
                                <div class="item-icon d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div class="item-text">
                                    (888)5921822
                                </div>
                            </div>
                            <div class="info-item d-flex align-items-center">
                                <div class="item-icon d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div class="item-text">
                                    soporte@ktainstitute.com
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ed-ftr-widget">
                    <div class="menu-widget ul-li-block">
                        <ul>
                            <li><a class="/cursos" href="index.html">Self study</a></li>
                            <li><a href="/lives">Cursos en vivo</a></li>
                            <li><a href="/nosotros">Nososotros</a></li>
                        </ul>

                        <ul>
                            <li><a href="/membresias">Membresías</a></li>
                            <li><a href="/testimonios">Testimonios</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="ed-footer-bottom d-flex justify-content-between align-items-end">
            <div class="ed-ftr-widget">
                <div class="newsletter-widget">
                    <h3 class="widget-title">Bienvenido a KTA Institute</h3>
                </div>
            </div>
            <div class="ed-ft-gallery-social d-flex align-items-center justify-content-center">
                <div class="ed-ft-gallery ul-li">
                    <ul>
                        <li><img src="/assets/images/certificadoTransparente1.png" alt=""></li>
                        <li><img src="/assets/images/certificadoTransparente2.png" alt=""></li>
                    </ul>
                </div>
                <div class="ed-ft-social text-uppercase ul-li-block">
                    <ul>
                        <li><a target="_blank" href="https://www.instagram.com/ktainstitute/"> <i class="fab fa-instagram"></i></a></li>
                        <li><a target="_blank" href="https://www.facebook.com/ktainstitute"> <i class="fab fa-facebook"></i></a></li>
                        <li><a target="_blank" href="https://www.youtube.com/@ktainstitute"> <i class="fab fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="ed-footer-copyright text-center">
            <span>© Copyright  <?=date('Y')?>. <a href="/">  K’ta & Associate LLC</a> Todos los derechos reservados.. </span>
        </div>
    </div>
</footer>		

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