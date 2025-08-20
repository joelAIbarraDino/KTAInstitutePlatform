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
                <a href="index-1.html"><img src="/assets/img2/logo/logo-1.png" alt=""></a>
            </div>
            <div class="action-select ed-option">
                <select>
                    <option value="#">Our All Courses</option>
                    <option value="#">Education</option>
                    <option value="#">Skill Development</option>
                    <option value="#">Language Course</option>
                    <option value="#">Free Resources</option>
                </select>
            </div>
        </div>
        <div class="header-navigation-cta d-flex align-items-center">
            <nav class="main-navigation clearfix ul-li">
                <ul id="main-nav" class="nav navbar-nav clearfix">
                    <li class="dropdown active">
                        <a href="!#">Home</a>
                        <ul class="dropdown-menu clearfix">
                            <li><a class="active" href="index.html">Online Course</a></li>
                            <li><a href="index-2.html">University</a></li>
                            <li><a href="index-3.html">Kindergarden</a></li>
                            <li><a href="index-4.html">Marketplace</a></li>
                            <li><a href="index-5.html">Modern Education</a></li>
                            <li><a href="index-6.html">University Classic</a></li>
                        </ul>
                    </li>
                    <li><a href="about.html">About</a></li>
                    <li class="dropdown">
                        <a href="!#">Course</a>
                        <ul class="dropdown-menu clearfix"> 
                            <li><a href="course.html">Course Page 1 </a></li>
                            <li><a href="course-2.html">Course Page 2</a></li>
                            <li><a href="course-3.html">Course Page 3</a></li>
                            <li><a href="course-4.html">Course Page 4</a></li>
                            <li><a href="course-5.html">Course Page 5</a></li>
                            <li><a href="course-6.html">Course Page 6</a></li>
                            <li><a href="course-single.html">Course Details</a></li>
                            <li><a href="course-category.html">Course Category</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="!#">Pages</a>
                        <ul class="dropdown-menu clearfix">
                            <li class="dropdown">
                                <a href="team.html">Team Page</a>
                                <ul class="dropdown-menu clearfix">
                                    <li><a href="team-1.html">Team Page 1 </a></li>
                                    <li><a href="team-2.html">Team Page 2</a></li>
                                    <li><a href="team-3.html">Team Page 3</a></li>
                                    <li><a href="instructor-single.html">Team Page Details</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact</a></li>
                            <li class="dropdown">
                                <a href="team.html">Event Page</a>
                                <ul class="dropdown-menu clearfix">
                                    <li><a href="event-single.html">Event Details</a></li>
                                </ul>
                            </li>
                            <li><a href="faq.html">Faq Page</a></li>
                            <li><a href="pricing.html">Pricing Page</a></li>
                            <li><a href="zoom-meeting.html">Zoom Meeting</a></li>
                            <li><a href="404.html">404 Error</a></li>
                            <li><a href="gallery.html">Gallery Page</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="!#">Blog</a>
                        <ul class="dropdown-menu clearfix"> 
                            <li><a href="blog-1.html">Blog Page 1</a></li>
                            <li><a href="blog-2.html">Blog Page 2</a></li>
                            <li><a href="blog-3.html">Blog Page 3</a></li>
                            <li><a href="blog-list.html">Blog Page List</a></li>
                            <li><a href="blog-single.html">Blog Details Page</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="cart-btn d-flex align-items-center">
                <button class="hd-cart header-cart-btn"><i class="fa-solid fa-cart-shopping"></i></button>
                <div class="header-cta-btn btn-spin">
                    <a href="contact.html">Get Quote Now</a>
                </div>
            </div>
            <button class="agt-mobile-menu-btn mobile_menu_button open_mobile_menu">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </div>
</header>
<!-- sidebar cart start -->
<div class="cart_sidebar">
    <div class="cart_sidebar_top">
        <h2 class="heading_title">Cart</h2>
        <button type="button" class="cart_close_btn tx-close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="cart_items_list">
        <div class="cart_item">
            <div class="item_image">
                <img src="/assets/img2/shop/pr1.jpg" alt="image_not_found">
            </div>
            <div class="item_content headline">
                <h4 class="item_title">
                    Rorem ipsum dolor sit amet.
                </h4>
                <span class="item_price">$19.00</span>
                <button type="button" class="remove_btn"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
        <div class="cart_item">
            <div class="item_image">
                <img src="/assets/img2/shop/pr2.jpg" alt="image_not_found">
            </div>
            <div class="item_content headline">
                <h4 class="item_title">
                    Rorem ipsum dolor sit amet.
                </h4>
                <span class="item_price">$22.00</span>
                <button type="button" class="remove_btn"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
        <div class="cart_item">
            <div class="item_image">
                <img src="/assets/img2/shop/pr3.jpg" alt="image_not_found">
            </div>
            <div class="item_content headline">
                <h4 class="item_title">
                    Rorem ipsum dolor sit amet.
                </h4>
                <span class="item_price">$43.00</span>
                <button type="button" class="remove_btn"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
        <div class="cart_item">
            <div class="item_image">
                <img src="/assets/img2/shop/pr4.jpg" alt="image_not_found">
            </div>
            <div class="item_content headline">
                <h4 class="item_title">
                    Rorem ipsum dolor sit amet.
                </h4>
                <span class="item_price">$14.00</span>
                <button type="button" class="remove_btn"><i class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
    </div>
    <div class="cart_sidebar_bottom">
        <div class="total_price">
            <span>Sub Total:</span>
            <span>$87.00</span>
        </div>
        <div class="cart_sidebar_button">
            <a  href="#">View Cart</a>
            <a  href="#">Checkout</a>
        </div>
    </div>
</div>
<!-- Mobile-start -->
<div class="mobile_menu lenis lenis-smooth ofcanvas_sidebar position-relative">
    <div class="mobile_menu_wrap">
        <div class="mobile_menu_overlay open_mobile_menu"></div>
        <div class="mobile_menu_content">
            <div class="mobile_menu_close open_mobile_menu">
                <i class="fas fa-times"></i>
            </div>
            <div class="m-brand-logo">
                <a href="#"><img src="/assets/img2/logo/logo-4.png" alt=""></a> 
            </div>
            <div class="mobile-search-bar position-relative">
                <form action="#">
                    <input type="text" name="search" placeholder="Keywords">
                    <button><i class="fas fa-search"></i></button>
                </form>
            </div>
            <nav class="mobile-main-navigation  clearfix ul-li">
                <ul id="m-main-nav" class="nav navbar-nav clearfix">
                    <li class="dropdown active">
                        <a href="!#">Home</a>
                        <ul class="dropdown-menu clearfix">
                            <li><a class="active" href="index.html">Online Course</a></li>
                            <li><a href="index-2.html">University</a></li>
                            <li><a href="index-3.html">Kindergarden</a></li>
                            <li><a href="index-4.html">Marketplace</a></li>
                            <li><a href="index-5.html">Modern Education</a></li>
                            <li><a href="index-6.html">University Classic</a></li>
                        </ul>
                    </li>
                    <li><a href="about.html">About</a></li>
                    <li class="dropdown">
                        <a href="!#">Course</a>
                        <ul class="dropdown-menu clearfix"> 
                            <li><a href="course.html">Course Page 1 </a></li>
                            <li><a href="course-2.html">Course Page 2</a></li>
                            <li><a href="course-3.html">Course Page 3</a></li>
                            <li><a href="course-4.html">Course Page 4</a></li>
                            <li><a href="course-5.html">Course Page 5</a></li>
                            <li><a href="course-6.html">Course Page 6</a></li>
                            <li><a href="course-single.html">Course Details</a></li>
                            <li><a href="course-category.html">Course Category</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="!#">Pages</a>
                        <ul class="dropdown-menu clearfix">
                            <li class="dropdown">
                                <a href="team.html">Team Page</a>
                                <ul class="dropdown-menu clearfix">
                                    <li><a href="team-1.html">Team Page 1 </a></li>
                                    <li><a href="team-2.html">Team Page 2</a></li>
                                    <li><a href="team-3.html">Team Page 3</a></li>
                                    <li><a href="instructor-single.html">Team Page Details</a></li>
                                </ul>
                            </li>
                            <li><a href="contact.html">Contact</a></li>
                            <li class="dropdown">
                                <a href="team.html">Event Page</a>
                                <ul class="dropdown-menu clearfix">
                                    <li><a href="event-single.html">Event Details</a></li>
                                </ul>
                            </li>
                            <li><a href="faq.html">Faq Page</a></li>
                            <li><a href="pricing.html">Pricing Page</a></li>
                            <li><a href="zoom-meeting.html">Zoom Meeting</a></li>
                            <li><a href="404.html">404 Error</a></li>
                            <li><a href="gallery.html">Gallery Page</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="!#">Blog</a>
                        <ul class="dropdown-menu clearfix"> 
                            <li><a href="blog-1.html">Blog Page 1</a></li>
                            <li><a href="blog-2.html">Blog Page 2</a></li>
                            <li><a href="blog-3.html">Blog Page 3</a></li>
                            <li><a href="blog-list.html">Blog Page List</a></li>
                            <li><a href="blog-single.html">Blog Details Page</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <div class="ptx-mobile-header-social text-center">
                <a href="#"> <i class="fab fa-instagram"></i></a>
                <a href="#"> <i class="fab fa-linkedin-in"></i></a>
                <a href="#"> <i class="fab fa-facebook"></i></a>
                <a href="#"> <i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
    <!-- /Mobile-Menu -->
</div>
<!-- End of Header section
============================================= -->

<!-- Start of Hero section
============================================= -->
<section id="ed-hero-1" class="ed-hero-section-1 position-relative" data-background="/assets/img2/hero/hero-bg.jpg">
    <span class="ed-h-shape1 position-absolute"><img src="/assets/img2/hero/shape1.png" alt=""></span>
    <span class="ed-h-shape2 position-absolute"><img src="/assets/img2/hero/shape1.png" alt=""></span>
    <span class="ed-h-shape3 position-absolute"><img src="/assets/img2/hero/shape2.png" alt=""></span>
    <div class="container">
        <div class="ed-h1-content position-relative">
            <div class="h1-img-wrap">
                <div class="ed-img-shape1 position-absolute"><span><img src="/assets/img2/hero/shp1.png" alt=""></span></div>
                <div class="ed-img-shape2 position-absolute"><span><img src="/assets/img2/hero/shp2.png" alt=""></span></div>
                <div class="ed-img-shape3 position-absolute"><span><img src="/assets/img2/hero/shp3.png" alt=""></span></div>
                <div class="ed-img-shape4 position-absolute"><span><img src="/assets/img2/hero/shp4.png" alt=""></span></div>
                <div class="ed-img-shape5 position-absolute"><span><img src="/assets/img2/hero/shp5.png" alt=""></span></div>
                <div class="item-img">
                    <img src="/assets/img2/hero/hm1.jpg" alt="">
                </div>
            </div>
            <div class="h1-text-wrap headline pera-content">
                <div class="h1-text-area edh-text">
                    <span class="h1_slug">100% Satusfaction Gurantee</span>
                    <h1 class="hero_title_1 banner_title agt_hero_title">Find Your 
                    Perfect Course</h1>
                    <p>Choose from over 210,000 online video courses with new additions 
                    Published every month ourses and learn how to code.</p>
                </div>
                <div class="h1-search-box position-relative">
                    <form action="#" method="get">
                        <div class="h1-input-field">
                            <input type="text" placeholder="Search your Course">
                        </div>
                        <div class="ed-select-option d-flex align-items-center">
                            <div class="action-select ed-option">
                                <select>
                                    <option value="#">Our All Courses</option>
                                    <option value="#">Education</option>
                                    <option value="#">Skill Development</option>
                                    <option value="#">Language Course</option>
                                    <option value="#">Free Resources</option>
                                </select>
                            </div>
                            <button>Get Quote Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End of Hero section
============================================= -->

<!-- Start of Course Category section
============================================= -->
<section id="ed-course-cate" class="ed-course-cate-sec">
    <div class="container">
        <div class="ed-course-cate-content">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1000ms">
                    <div class="ed-coc-item text-center">
                        <div class="item-img">
                            <img src="/assets/img2/icon/ic1.png" alt="">
                        </div>
                        <div class="item-text headline pera-content">
                            <h3><a href="course-single.html">Materials Science</a></h3>
                            <p>curated collection</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="150ms" data-wow-duration="1000ms">
                    <div class="ed-coc-item text-center">
                        <div class="item-img">
                            <img src="/assets/img2/icon/ic2.png" alt="">
                        </div>
                        <div class="item-text headline pera-content">
                            <h3><a href="course-single.html">Computer Science</a></h3>
                            <p>curated collection</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1000ms">
                    <div class="ed-coc-item text-center">
                        <div class="item-img">
                            <img src="/assets/img2/icon/ic3.png" alt="">
                        </div>
                        <div class="item-text headline pera-content">
                            <h3><a href="course-single.html">Youtube Automation</a></h3>
                            <p>curated collection</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="250ms" data-wow-duration="1000ms">
                    <div class="ed-coc-item text-center">
                        <div class="item-img">
                            <img src="/assets/img2/icon/ic4.png" alt="">
                        </div>
                        <div class="item-text headline pera-content">
                            <h3><a href="course-single.html">Cybersecurity</a></h3>
                            <p>curated collection</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1000ms">
                    <div class="ed-coc-item text-center">
                        <div class="item-img">
                            <img src="/assets/img2/icon/ic5.png" alt="">
                        </div>
                        <div class="item-text headline pera-content">
                            <h3><a href="course-single.html">Materials Science</a></h3>
                            <p>curated collection</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="350ms" data-wow-duration="1000ms">
                    <div class="ed-coc-item text-center">
                        <div class="item-img">
                            <img src="/assets/img2/icon/ic6.png" alt="">
                        </div>
                        <div class="item-text headline pera-content">
                            <h3><a href="course-single.html">Financial markets</a></h3>
                            <p>curated collection</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1000ms">
                    <div class="ed-coc-item text-center">
                        <div class="item-img">
                            <img src="/assets/img2/icon/ic7.png" alt="">
                        </div>
                        <div class="item-text headline pera-content">
                            <h3><a href="course-single.html">Software builder</a></h3>
                            <p>curated collection</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="450ms" data-wow-duration="1000ms">
                    <div class="ed-coc-item text-center">
                        <div class="item-img">
                            <img src="/assets/img2/icon/ic8.png" alt="">
                        </div>
                        <div class="item-text headline pera-content">
                            <h3><a href="course-single.html">Data Analytics</a></h3>
                            <p>curated collection</p>
                        </div>
                    </div>
                </div>
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
                <img src="/assets/img2/about/ab1.png" alt="">
            </div>
            <div class="ed-ab-text1">
                <div class="ed-sec-title ed-text headline pera-content">
                    <div class="rate-slug wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms"><i class="fa-solid fa-star"></i> Top Rated Company</div>
                    <h2 class="sec_title ed-sec-tt-anim ed-has-anim">We Develop & Create 
                    Digital Future</h2>
                    <p>Every pleasure is to be welcomed and every pain avoided. But in certain 
                        circumstances and owing to the <a href="#">claims of duty obligations of business</a> it will 
                        frequently occur Contact us today and get a free trial plan to give.
                    </p>
                </div>
                <div class="ed-ab-review-wrap mt-25 mb-40 d-flex align-items-center justify-content-between">
                    <div class="ed-ab-review headline ul-li">
                        <h3>4.7+</h3>
                        <ul>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                        <span>Review customer</span>
                    </div>
                    <div class="ed-ab-review-list ul-li-block">
                        <ul>
                            <li class="top_view"><i class="fa-solid fa-circle-check"></i> Data Storage and Analysis</li>
                            <li class="top_view"><i class="fa-solid fa-circle-check"></i> International Online Support</li>
                            <li class="top_view"><i class="fa-solid fa-circle-check"></i> Branding Project Development</li>
                        </ul>
                    </div>
                </div>
                <div class="ed-btn-1 btn-spin">
                    <a href="about.html">More About Us</a>
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
                <div class="subtitle wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">Top Rated Company</div>
                <h2 class="sec_title ed-sec-tt-anim ed-has-anim">Featured Classes</h2>
            </div>
            <div class="ed-ft-class-top-btn tx-tab-btn ul-li">
                <ul class="nav nav-tabs" id="mt-about-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <div class="nav-link active" id="ft_tab_1" data-bs-toggle="tab" data-bs-target="#ft_1_1" role="tab">
                            Business
                        </div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <div class="nav-link" id="ft_tab_2" data-bs-toggle="tab" data-bs-target="#ft_1_2" role="tab">
                            Development
                        </div>
                    </li>
                    <li class="nav-item" role="presentation">
                        <div class="nav-link" id="ft_tab_3" data-bs-toggle="tab" data-bs-target="#ft_1_3" role="tab">
                            Data Science
                        </div>
                    </li>
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
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs1.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">An Introduction to Data Analysis & Visualisation</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs2.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">Exploring Biostatistics And Data Analysis</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs4.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">Exploring Biostatistics And Data Analysis</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs3.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">Making Sense of Data in the Media</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs4.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">An Introduction to Data Analysis & Visualisation</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane  animated fadeInUp" id="ft_1_2" role="tabpanel">
                    <div class="ed-ft-class-slider swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs1.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">An Introduction to Data Analysis & Visualisation</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs2.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">Exploring Biostatistics And Data Analysis</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs4.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">Exploring Biostatistics And Data Analysis</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs3.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">Making Sense of Data in the Media</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs4.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">An Introduction to Data Analysis & Visualisation</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane  animated fadeInUp" id="ft_1_3" role="tabpanel">
                    <div class="ed-ft-class-slider swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs1.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">An Introduction to Data Analysis & Visualisation</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs2.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">Exploring Biostatistics And Data Analysis</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs4.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">Exploring Biostatistics And Data Analysis</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs3.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">Making Sense of Data in the Media</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ed-ft-class-item">
                                    <div class="item-img position-relative">
                                        <div class="inner-img">
                                            <img src="/assets/img2/course/crs4.jpg" alt="">
                                        </div>
                                        <span class="item-tag"><i class="fa-solid fa-layer-group"></i>3 Lessons</span>
                                        <span class="item-price d-flex justify-content-center align-items-center">$15.00</span>
                                    </div>
                                    <div class="item-text headline pera-content">
                                        <h3 class="href-underline"><a href="course-single.html">An Introduction to Data Analysis & Visualisation</a></h3>
                                        <span class="crs-author">By David Millar</span>
                                        <div class="crs-bottom d-flex justify-content-between align-items-center">
                                            <div class="bottom-btn  btn-spin">
                                                <a href="contact.html">Enroll Now</a>
                                            </div>
                                            <span class="num-stu"><i class="fa-solid fa-user"></i> (66 Students)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        <a href="course.html">Check More</a>
    </div>
</section>	
<!-- End of Featured section
============================================= -->

<!-- Start of Top Rate section
============================================= -->
<section id="ed-top-rate" class="ed-top-rate-sec position-relative" data-background="/assets/img2/bg/rate-bg.jpg">
    <span class="ed-tr-shape1"><img src="/assets/img2/shape/sq1.png" alt=""></span>
    <span class="ed-tr-shape2"><img src="/assets/img2/shape/sq1.png" alt=""></span>
    <div class="container">
        <div class="ed-top-rate-content position-relative">
            <div class="ed-top-rate-img position-absolute">
                <div class="item-img1 ed_top_img_2 position-absolute">
                    <img src="/assets/img2/shape/circle.png" alt="">
                </div>
                <div class="item-img2 ed_top_img">
                    <img src="/assets/img2/about/rate-men.png" alt="">
                </div>
            </div>
            <div class="ed-top-rate-text position-relative">
                <div class="ed-top-rate-shape">
                    <div class="item-shape1">
                        <img src="/assets/img2/shape/arrow-1.png" alt="">
                    </div>
                    <div class="item-shape2">
                        <img src="/assets/img2/shape/draw1.png" alt="">
                    </div>
                    <div class="item-percent">
                        <span>Enroll and Get</span>
                        <h3>50% Off</h3>
                    </div>
                </div>
                <div class="ed-sec-title headline pera-content">
                    <div class="subtitle wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">Top Rated Company</div>
                    <h2 class="sec_title ed-sec-tt-anim ed-has-anim">A Perfect start 
                        of your Distance 
                    Learning</h2>
                </div>
                <div class="ed-top-rate-ft d-flex align-items-center flex-wrap">
                    <div class="top-rate-ft-item d-flex align-items-center">
                        <div class="item-icon d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="item-text headline pera-content">
                            <h3>Machine Learning</h3>
                            <span>Support and Evolution</span>
                        </div>
                    </div>
                    <div class="top-rate-ft-item d-flex align-items-center">
                        <div class="item-icon d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="item-text headline pera-content">
                            <h3>Artificial Intelligence</h3>
                            <span>Support and Evolution</span>
                        </div>
                    </div>
                </div>
                <div class="ed-btn-1 btn-spin">
                    <a href="contact.html">Enroll Now</a>
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
            <div class="subtitle wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">Top Rated Company</div>
            <h2 class="sec_title ed-sec-tt-anim ed-has-anim">Creative Profiles Make Your
            Profile & Get Eyeballs</h2>
        </div>
        <div class="ed-team-content mt-45">
            <div class="ed-team-slide swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="ed-team-item-1">
                            <div class="item-img">
                                <img src="/assets/img2/team/team1.jpg" alt="">
                            </div>
                            <div class="item-text text-center headline pera-content">
                                <h3><a href="instructor-single.html">Grace J.Park</a></h3>
                                <span>Digital Marketer</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="ed-team-item-1">
                            <div class="item-img">
                                <img src="/assets/img2/team/team2.jpg" alt="">
                            </div>
                            <div class="item-text text-center headline pera-content">
                                <h3><a href="instructor-single.html">Grace J.Park</a></h3>
                                <span>Digital Marketer</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="ed-team-item-1">
                            <div class="item-img">
                                <img src="/assets/img2/team/team3.jpg" alt="">
                            </div>
                            <div class="item-text text-center headline pera-content">
                                <h3><a href="instructor-single.html">Grace J.Park</a></h3>
                                <span>Digital Marketer</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="ed-team-item-1">
                            <div class="item-img">
                                <img src="/assets/img2/team/team4.jpg" alt="">
                            </div>
                            <div class="item-text text-center headline pera-content">
                                <h3><a href="instructor-single.html">Grace J.Park</a></h3>
                                <span>Digital Marketer</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="ed-team-item-1">
                            <div class="item-img">
                                <img src="/assets/img2/team/team1.jpg" alt="">
                            </div>
                            <div class="item-text text-center headline pera-content">
                                <h3><a href="instructor-single.html">Grace J.Park</a></h3>
                                <span>Digital Marketer</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="ed-team-item-1">
                            <div class="item-img">
                                <img src="/assets/img2/team/team5.jpg" alt="">
                            </div>
                            <div class="item-text text-center headline pera-content">
                                <h3><a href="instructor-single.html">Grace J.Park</a></h3>
                                <span>Digital Marketer</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="ed-team-item-1">
                            <div class="item-img">
                                <img src="/assets/img2/team/team1.jpg" alt="">
                            </div>
                            <div class="item-text text-center headline pera-content">
                                <h3><a href="instructor-single.html">Grace J.Park</a></h3>
                                <span>Digital Marketer</span>
                            </div>
                        </div>
                    </div>
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
            <div class="subtitle wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">Top Rated Company</div>
            <h2 class="sec_title ed-sec-tt-anim ed-has-anim">Choice The Right Pricing Plan 
            That Suits your Need</h2>
        </div>
        <div class="ed-price-content mt-45">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1000ms">
                    <div class="ed-price-item">
                        <div class="item-top">
                            <div class="item-icon">
                                <img src="/assets/img2/icon/ic1.png" alt="">
                            </div>
                            <div class="item-text headline pera-content">
                                <h3>Basic Plan</h3>
                                <span>$29/monthly</span>
                            </div>
                        </div>
                        <div class="item-desc pera-content">
                            <p>Every pleasure is to be welcomed and every pain avoided. is to be 
                            welcomed and every</p>
                        </div>
                        <div class="item-btn btn-spin text-center">
                            <a href="contact.html">Get Started</a>
                        </div>
                        <div class="item-list ul-li-block">
                            <ul>
                                <li><i class="fa-solid fa-circle-check"></i> Get high conversion rates</li>
                                <li><i class="fa-solid fa-circle-check"></i> Virtual Private Server (VPS)</li>
                                <li><i class="fa-solid fa-circle-check"></i> Get high conversion rates</li>
                                <li><i class="fa-solid fa-circle-check"></i> Virtual Private Server (VPS)</li>
                            </ul>
                        </div>
                        <div class="price-slug text-center"><span>14-day free trial - No credit card Required</span></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="200ms" data-wow-duration="1000ms">
                    <div class="ed-price-item highlight-item">
                        <div class="item-top">
                            <div class="item-icon">
                                <img src="/assets/img2/icon/ic1.png" alt="">
                            </div>
                            <div class="item-text headline pera-content">
                                <h3>Basic Plan</h3>
                                <span>$29/monthly</span>
                            </div>
                        </div>
                        <div class="item-desc pera-content">
                            <p>Every pleasure is to be welcomed and every pain avoided. is to be 
                            welcomed and every</p>
                        </div>
                        <div class="item-list ul-li-block">
                            <ul>
                                <li><i class="fa-solid fa-circle-check"></i> Get high conversion rates</li>
                                <li><i class="fa-solid fa-circle-check"></i> Virtual Private Server (VPS)</li>
                                <li><i class="fa-solid fa-circle-check"></i> Get high conversion rates</li>
                                <li><i class="fa-solid fa-circle-check"></i> Virtual Private Server (VPS)</li>
                            </ul>
                        </div>
                        <div class="item-btn btn-spin mt-45 text-center">
                            <a href="contact.html">Get Started</a>
                        </div>
                        <div class="price-slug text-center"><span>14-day free trial - No credit card Required</span></div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">
                    <div class="ed-price-item">
                        <div class="item-top">
                            <div class="item-icon">
                                <img src="/assets/img2/icon/ic1.png" alt="">
                            </div>
                            <div class="item-text headline pera-content">
                                <h3>Basic Plan</h3>
                                <span>$29/monthly</span>
                            </div>
                        </div>
                        <div class="item-desc pera-content">
                            <p>Every pleasure is to be welcomed and every pain avoided. is to be 
                            welcomed and every</p>
                        </div>
                        <div class="item-btn btn-spin text-center">
                            <a href="contact.html">Get Started</a>
                        </div>
                        <div class="item-list ul-li-block">
                            <ul>
                                <li><i class="fa-solid fa-circle-check"></i> Get high conversion rates</li>
                                <li><i class="fa-solid fa-circle-check"></i> Virtual Private Server (VPS)</li>
                                <li><i class="fa-solid fa-circle-check"></i> Get high conversion rates</li>
                                <li><i class="fa-solid fa-circle-check"></i> Virtual Private Server (VPS)</li>
                            </ul>
                        </div>
                        <div class="price-slug text-center"><span>14-day free trial - No credit card Required</span></div>
                    </div>
                </div>
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
            <div class="subtitle wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">Top Rated Company</div>
            <h2 class="sec_title ed-sec-tt-anim ed-has-anim">Why People Quiety’s
            Hiring Software</h2>
        </div>
        <div class="ed-testimonial-content mt-75">
            <div class="ed-testimonial-slide swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="ed-testimonial-item d-flex">
                            <div class="item-img">
                                <img src="/assets/img2/about/test1.jpg" alt="">
                            </div>
                            <div class="item-text pera-content">
                                <span>what people  say</span>
                                <p>When an unknown printer took 
                                    A galley of type and scrambled 
                                    it to make a type specimen 
                                    Book. It has survived not only 
                                Five centuries.</p>
                                <div class="item-bottom mt-20 d-flex justify-content-between align-items-center">
                                    <div class="inner-text headline">
                                        <h3>Charli Hapan</h3>
                                        <span>ThemeHunt</span>
                                    </div>
                                    <div class="inner-img">
                                        <img src="/assets/img2/about/t-logo.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="ed-testimonial-item d-flex">
                            <div class="item-img">
                                <img src="/assets/img2/about/test1.jpg" alt="">
                            </div>
                            <div class="item-text pera-content">
                                <span>what people  say</span>
                                <p>When an unknown printer took 
                                    A galley of type and scrambled 
                                    it to make a type specimen 
                                    Book. It has survived not only 
                                Five centuries.</p>
                                <div class="item-bottom mt-20 d-flex justify-content-between align-items-center">
                                    <div class="inner-text headline">
                                        <h3>Charli Hapan</h3>
                                        <span>ThemeHunt</span>
                                    </div>
                                    <div class="inner-img">
                                        <img src="/assets/img2/about/t-logo.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="ed-testimonial-item d-flex">
                            <div class="item-img">
                                <img src="/assets/img2/about/test1.jpg" alt="">
                            </div>
                            <div class="item-text pera-content">
                                <span>what people  say</span>
                                <p>When an unknown printer took 
                                    A galley of type and scrambled 
                                    it to make a type specimen 
                                    Book. It has survived not only 
                                Five centuries.</p>
                                <div class="item-bottom mt-20 d-flex justify-content-between align-items-center">
                                    <div class="inner-text headline">
                                        <h3>Charli Hapan</h3>
                                        <span>ThemeHunt</span>
                                    </div>
                                    <div class="inner-img">
                                        <img src="/assets/img2/about/t-logo.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
            <div class="subtitle wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1000ms">Top Rated Company</div>
            <h2 class="sec_title ed-sec-tt-anim ed-has-anim">Why People Quiety’s</h2>
        </div>
        <div class="ed-faq-content mt-15">
            <div class="ed-faq-accordion">
                <div class="accordion" id="accordionExample_31">
                    <div class="accordion-item faq_active wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
                        <h2 class="accordion-header" id="heading10">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                <span><img src="/assets/img2/icon/ic9.png" alt="">	Selling Through Customer Insight</span>
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse show" aria-labelledby="heading10" data-bs-parent="#accordionExample_31">
                            <div class="accordion-body ">
                                <div class="bi-faq-text pera-content">
                                    <p>Every pleasure is to be welcomed and every pain avoided</p>
                                    <a href="#">Go to Builder</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item wow fadeInUp"  data-wow-delay="400ms" data-wow-duration="1000ms">
                        <h2 class="accordion-header" id="heading13">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                                <span><img src="/assets/img2/icon/ic9.png" alt="">	Introduction to Process Mining with ProM</span>
                            </button>
                        </h2>
                        <div id="collapse13" class="accordion-collapse collapse" aria-labelledby="heading13" data-bs-parent="#accordionExample_31">
                            <div class="accordion-body ">
                                <div class="bi-faq-text pera-content">
                                    <p>Every pleasure is to be welcomed and every pain avoided</p>
                                    <a href="#">Go to Builder</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item wow fadeInUp"  data-wow-delay="500ms" data-wow-duration="1000ms">
                        <h2 class="accordion-header" id="heading14">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                                <span><img src="/assets/img2/icon/ic9.png" alt="">	Statistical Inference and Machine Learning</span>
                            </button>
                        </h2>
                        <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="heading14" data-bs-parent="#accordionExample_31">
                            <div class="accordion-body ">
                                <div class="bi-faq-text pera-content">
                                    <p>Every pleasure is to be welcomed and every pain avoided</p>
                                    <a href="#">Go to Builder</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item  wow fadeInUp"  data-wow-delay="300ms" data-wow-duration="1000ms">
                        <h2 class="accordion-header" id="heading88">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse88" aria-expanded="true" aria-controls="collapse88">
                                <span><img src="/assets/img2/icon/ic9.png" alt="">Using Data to Understand Public Conversations</span>
                            </button>
                        </h2>
                        <div id="collapse88" class="accordion-collapse collapse" aria-labelledby="heading88" data-bs-parent="#accordionExample_31">
                            <div class="accordion-body">
                                <div class="bi-faq-text pera-content">
                                    <p>Every pleasure is to be welcomed and every pain avoided</p>
                                    <a href="#">Go to Builder</a>
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
                        <div class="brand-logo">
                            <a href="#"><img src="/assets/img2/logo/logo-2.png" alt=""></a>
                        </div>
                        <p>Made using clean, non-toxic ingredients, our products are signed for everyone. Made using clean, non-toxic
                        ngredients, our products are signed</p>
                        <div class="logo-cta-info">
                            <div class="info-item d-flex align-items-center">
                                <div class="item-icon d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-phone"></i>
                                </div>
                                <div class="item-text">
                                    ( 021 ) 666 888 0000
                                </div>
                            </div>
                            <div class="info-item d-flex align-items-center">
                                <div class="item-icon d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div class="item-text">
                                    needhelp@company.com
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ed-ftr-widget">
                    <div class="menu-widget ul-li-block">
                        <ul>
                            <li><a href="course-single.html">Recent Work</a></li>
                            <li><a href="course-single.html">Product Gallery</a></li>
                            <li><a href="course-single.html">About us</a></li>
                            <li><a href="course-single.html">Help & support</a></li>
                        </ul>
                        <ul>
                            <li><a href="course-single.html">Product Gallery</a></li>
                            <li><a href="course-single.html">Branding</a></li>
                            <li><a href="course-single.html">Web & Interactive</a></li>
                            <li><a href="course-single.html">Help & support</a></li>
                        </ul>
                        <ul>
                            <li><a href="course-single.html">Web & Interactive</a></li>
                            <li><a href="course-single.html">Branded Marchandise</a></li>
                            <li><a href="course-single.html">Our Awards</a></li>
                            <li><a href="course-single.html">Help & support</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="ed-footer-bottom d-flex justify-content-between align-items-end">
            <div class="ed-ftr-widget">
                <div class="newsletter-widget">
                    <h3 class="widget-title">Newsletter</h3>
                    <form action="#" method="post">
                        <input type="email" placeholder="Email address">
                        <button>Subsrcribe</button>
                    </form>
                </div>
            </div>
            <div class="ed-ft-gallery-social d-flex align-items-center">
                <div class="ed-ft-gallery ul-li">
                    <ul>
                        <li><img src="/assets/img2/gallery/gl1.jpg" alt=""></li>
                        <li><img src="/assets/img2/gallery/gl2.jpg" alt=""></li>
                        <li><img src="/assets/img2/gallery/gl3.jpg" alt=""></li>
                        <li><img src="/assets/img2/gallery/gl4.jpg" alt=""></li>
                        <li><img src="/assets/img2/gallery/gl5.jpg" alt=""></li>
                    </ul>
                </div>
                <div class="ed-ft-social text-uppercase ul-li-block">
                    <ul>
                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i> Facebook</a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="ed-footer-copyright text-center">
            <span>© Copyright  2024.<a href="#"> Themexriver</a> All Rights Reserved. </span>
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