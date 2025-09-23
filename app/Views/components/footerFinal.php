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
