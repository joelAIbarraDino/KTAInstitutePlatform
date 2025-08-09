<?php

use App\Classes\Helpers;

    $topScripts ='
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
        <link rel="preload" href="https://cdn.plyr.io/3.7.8/plyr.css" as="style"> 
        <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
        <script src="https://player.vimeo.com/api/player.js"></script>
    ';
?>

<?php include_once __DIR__.'/../components/header.php'; ?>

<?php include_once __DIR__.'/../components/slider.php'; ?>

<div class="gif">
    <img src="/assets/images/gif.gif" alt="gif" class="gif__image">
</div>

<?php include_once __DIR__.'/../components/lastCourses.php'; ?>

<section class="bienvenida-index">
    
    <div class="bienvenida-container">
        <div class="bienvenida-container__top">
            <div class="bienvenida-container__top-left">
                <h2 class="bienvenida-container__title" data-aos="fade-right">Bienvenidos a <span>KTA Institute</span></h2>
                <p class="bienvenida-container__parrafo" data-aos="fade-right">
                    Somos una institución constituida por profesionales experimentados en actividades económicas necesarias al desarrollo de empresas y al ser humano. Todos estamos comprometidos a impartir conocimiento y prácticas de una forma íntegra y legal.
                </p>

                <p class="bienvenida-container__parrafo" data-aos="fade-right">
                    Respectando las normas, reglas y éticas de cada profesión nuestro Instituto lleva a cada participante un certificado de capacitación del curso correspondiente.
                </p>
                
            </div>

            <div class="bienvenida-container__top-right" data-aos="fade-left">
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
        </div>

        <p class="bienvenida-container__parrafo" data-aos="fade-up">
            Para nosotros enseñar es más importante que asistir.  Enseñar es una oportunidad de crecer en libertad y conocimiento. Nuestro objetivo es ayudar al inmigrante a una integración total y exitosa en los Estados Unidos, que ese Inmigrante se vuelva un Ciudadano Americano más,  aplicando métodos de desarrollo personal y profesional.
        </p>
    </div>

    <div class="bienvenida-lives">
        
        <img class="bienvenida-lives__img" src="/assets/images/index-live.jpg" alt="imagen carlos catarino en live" data-aos="fade-right">

        <div class="bienvenida-lives__text-container">
            <h2 class="bienvenida-lives__title" data-aos="fade-down">Live Online courses</h2>
            <p class="bienvenida-lives__text" data-aos="fade-left">
                Cada uno de los encuentros de clases, se realizan mediante la plataforma de conferencias de zoom que nos permite poder interacturar, presentar y resolver en el mismo instante cualquier problema que tengamos.
            </p>

            <div class="bienvenida-lives__caract" data-aos="fade-up">
                <div class="bienvenida-lives__caract-icono">
                    <i class='bx bx-check'></i>
                </div>
                <p class="bienvenida-lives__caract-text">Mas de 25 cursos en 7 categorias.</p>
            </div>

            <div class="bienvenida-lives__caract" data-aos="fade-up">
                <div class="bienvenida-lives__caract-icono">
                    <i class='bx bx-check'></i>
                </div>
                <p class="bienvenida-lives__caract-text">Mentorias Personalizadas Proyectos finales y evaluaciones.</p>
            </div>

            <div class="bienvenida-lives__caract" data-aos="fade-up">
                <div class="bienvenida-lives__caract-icono">
                    <i class='bx bx-check'></i>
                </div>
                <p class="bienvenida-lives__caract-text">Certificaciones completas para crear los profesionales del futuro.</p>
            </div>
        </div>
    </div>

</section>

<section class="membresia-banner" data-aos="fade">
    <div class="membresia-banner__container">
        <img class="membresia-banner__logo" src="/assets/images/membresia-banner.jpg" alt="logo de membresia">

        <p class="membresia-banner__text">
            Se miembro del mejor club de Profesionales donde tendrás cursos, asesorías grupales y personalizadas <span>con EA Carlos Catarino</span> por 12 meses
       </p>

       <a href="/membresias">
        <div class="membresia-banner__cta">¡Suscríbete ahora¡</div>
       </a>
    </div>
</section>

<section class="caracts-main">

    <div class="caracts-main__container">
        <div class="caract-main" data-aos="fade-right" data-aos-delay="200">
            <img class="caract-main__icon" loading="lazy" src="/assets/images/conferencia.png">
            <h3 class="caract-main__title" data-section="index" data-label="caract-title-1">Seminarios presenciales</h3>
            <p class="caract-main__text" data-section="index" data-label="caract-text-1">
                Organizamos distintos seminarios presenciales para que pueda continuar con tu formación tributaria en distintas ciudades del país como Los Ángeles, Orlando, Houston, Phoenix, San Diego, New York, Miami, etc...
            </p>
            <a class="caract-main__enlace" href="#" data-section="index" data-label="membership-button">Más detalles</a>
        </div>

        <div class="caract-main" data-aos="fade-right" data-aos-delay="200">
            <img class="caract-main__icon" loading="lazy" src="/assets/images/reunion.png">
            <h3 class="caract-main__title" data-section="index" data-label="caract-title-2">LIVE WEBINARS</h3>
            <p class="caract-main__text" data-section="index" data-label="caract-text-2">
                La mayoría de nuestros cursos ofrecen la posibilidad de ser realizados en vivo, permiten la interacción con el instructor y aseguran que los contenidos estén siempre actualizados.
            </p>
            <a class="caract-main__enlace" href="#" data-section="index" data-label="membership-button">Más detalles</a>
        </div>

        <div class="caract-main" data-aos="fade-left" data-aos-delay="200">
            <img class="caract-main__icon" loading="lazy" src="/assets/images/online.png">
            <h3 class="caract-main__title" data-section="index" data-label="caract-title-3">ON DEMAND WEBINARS</h3>
            <p class="caract-main__text" data-section="index" data-label="caract-text-3">
                Ofrecemos todos nuestros cursos en formato On Demand para que  estudie cuándo, dónde y cómo desee. Todos los cursos son actualizados permanentemente.
            </p>
            <a class="caract-main__enlace" href="#" data-section="index" data-label="membership-button">Más detalles</a>
        </div>

        <div class="caract-main" data-aos="fade-left" data-aos-delay="200">
            <img class="caract-main__icon" loading="lazy" src="/assets/images/audiolibro.png">
            <h3 class="caract-main__title" data-section="index" data-label="caract-title-4">LIBROS TRIBUTARIOS</h3>
            <p class="caract-main__text" data-section="index" data-label="caract-text-4">
                Tenemos a tu disposición una completa colección de libros tributarios constantemente actualizados y editados incorporando así todos los cambios y novedades fiscales.
            </p>
            <a class="caract-main__enlace" href="#" data-section="index" data-label="membership-button">Más detalles</a>
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
                <p class="estadistica__title counter">2500+</p>
                <p class="estadistica__desc" data-section="index" data-label="stadistic-1">Estudiantes exitosos</p>
            </div>
        </div>

        <div class="estadistica" data-aos="fade-right" data-aos-delay="200">
            <i class='bx bx-chalkboard' ></i>
            <div class="estadistica__content">
                <p class="estadistica__title counter">215</p>
                <p class="estadistica__desc" data-section="index" data-label="stadistic-2">Video tutoriales</p>
            </div>
        </div>

        <div class="estadistica" data-aos="fade-left" data-aos-delay="200">
            <i class='bx bx-user'></i>
            <div class="estadistica__content">
                <p class="estadistica__title counter">4</p>
                <p class="estadistica__desc" data-section="index" data-label="stadistic-3">Maestros especializados</p>
            </div>
        </div>

        <div class="estadistica" data-aos="fade-left" data-aos-delay="200">
            <i class='bx bx-glasses-alt'></i>
            <div class="estadistica__content">
                <p class="estadistica__title counter">18+</p>
                <p class="estadistica__desc" data-section="index" data-label="stadistic-4">Cursos unicos</p>
            </div>
        </div>

    </div>
</section>

<section class="work-flow">
    <div class="bienvenida-lives">
            
        <div class="bienvenida-lives__text-container" data-aos="fade-right">
            <h2 class="bienvenida-lives__title" data-aos="fade-down">Nuestra forma de trabajar es sencilla.</h2>

            <div class="bienvenida-lives__caract">
                <div class="bienvenida-lives__caract-icono">
                    <i class='bx bx-check'></i>
                </div>
                <p class="bienvenida-lives__caract-text">Ofrecemos cursos en Presencial, Online en Vivo, vía zoom y online pasivos.</p>
            </div>

            <div class="bienvenida-lives__caract">
                <div class="bienvenida-lives__caract-icono">
                    <i class='bx bx-check'></i>
                </div>
                <p class="bienvenida-lives__caract-text">Cada participante puede intervenir y participar directamente con los profesores que responderán de inmediato a sus dudas.</p>
            </div>

            <div class="bienvenida-lives__caract">
                <div class="bienvenida-lives__caract-icono">
                    <i class='bx bx-check'></i>
                </div>
                <p class="bienvenida-lives__caract-text">Nos aseguramos de que cada encuentro cumpla con una agenda de temas y tareas.</p>
            </div>

            <div class="bienvenida-lives__caract">
                <div class="bienvenida-lives__caract-icono">
                    <i class='bx bx-check'></i>
                </div>
                <p class="bienvenida-lives__caract-text">Cada encuentro se hace acompañar de ejemplos prácticas, gráficos y casos reales.</p>
            </div>

            <div class="bienvenida-lives__caract">
                <div class="bienvenida-lives__caract-icono">
                    <i class='bx bx-check'></i>
                </div>
                <p class="bienvenida-lives__caract-text">Aseguramos que cada encuentro tenga toda la calidad técnica de audio y video.</p>
            </div>

            <div class="bienvenida-lives__caract">
                <div class="bienvenida-lives__caract-icono">
                    <i class='bx bx-check'></i>
                </div>
                <p class="bienvenida-lives__caract-text">Cuando tú decides participar alguno de nuestros cursos, tienes la garantía que tus datos son completamente privados</p>
            </div>
        </div>

        <img class="work-flow__img" src="/assets/images/easy-work.jpg" alt="imagen carlos catarino en live" data-aos="fade-left">
    </div>
</section>

<section class="categorias">
    <p data-aos="fade-up" data-aos-delay="100" class="maestros-index__subtitulo">Categorías</p>
    <hr data-aos="fade-up" class="linea-personalizada">

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

<section class="maestros-index" data-aos="fade" data-aos-delay="">
    <p data-aos="fade-up" data-aos-delay="100" class="maestros-index__subtitulo" data-section="index" data-label="teachers-title">Conoce al equipo KTA</p>
    <hr data-aos="fade-up" class="linea-personalizada">
    <h3 data-aos="fade" data-aos-delay="100" class="maestros-index__titulo" data-section="index" data-label="teachers-subtitle">Tenemos a los mejores maestros que te ayudaran a pasar al siguiente nivel</h3>
    <?php include_once __DIR__.'/../components/teachers.php'; ?>
</section>

<section class="membresias-index" data-aos="fade">
    <p data-aos="fade-up" data-aos-delay="100" class="membresias-index__subtitulo" data-section="index" data-label="memberships-title">Descubre cómo podemos ayudarte</p>
    <hr data-aos="fade-up" class="linea-personalizada">
    <h3 data-aos="fade-up" data-aos-delay="100" class="membresias-index__titulo" data-section="index" data-label="memberships-subtitle">Tenemos la solución adecuada para cada persona</h3>

    <div class="membresias-index__container">
        
        <div class="membresia-index" data-aos="fade-right" data-aos-delay="100">
            <img class="membresia-index__imagen" src="/assets/images/membresia.jpg" alt="imagen">
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
            <img class="membresia-index__imagen" src="/assets/images/membresia.jpg" alt="imagen">
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

<section class="reviews" data-aos="fade-up">
    <p data-aos="fade-up" data-aos-delay="100" class="membresias-index__subtitulo" data-section="index" data-label="review_title">Triunfadores Que Confiaron En KTA Institute</p>
    <hr data-aos="fade-up" class="linea-personalizada">

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

            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<section class="podcast">
    <p data-aos="fade-up" data-aos-delay="100" class="membresias-index__subtitulo">Disfruta con nuestro Podcast Nadie es Importante</p>
    <hr data-aos="fade-up" class="linea-personalizada">
    
    <div class="podcast__container">
        <iframe class="podcast__video" src="https://www.youtube.com/embed/r8HnB7-qszQ?si=S8vWoNHHLcBSg9s0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <iframe class="podcast__video" src="https://www.youtube.com/embed/ArGNjAur_ow?si=ftHMCxq2gjV71WCI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        <iframe class="podcast__video" src="https://www.youtube.com/embed/uFptyMLZEFE?si=r1gsNYkNHZsQX8hd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>

    <a href="https://www.youtube.com/channel/UCfWEZVbcQ2PEm4CqrG5DWew" target="_blank">
        <div class="podcast__chanel">Ver canal de Youtube</div>
    </a>

</section>

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

<?php include_once __DIR__.'/../components/popups.php'; ?>

<?php include_once __DIR__.'/../components/footer.php'; ?>


<?php 

    $menuVersion = filemtime('assets/js/menu.js');
    $sliderVersion = filemtime('assets/js/slider.js');
    $saleVersion = filemtime('assets/js/saleAlerts.js');
    $animationVersion = filemtime('assets/js/counter.js');
    $swiperVersion = filemtime('assets/js/swiper.js');

    $scripts ='
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
        <script src="/assets/js/slider.js?v='.$sliderVersion.'"></script>
        <script src="/assets/js/saleAlerts.js?v='.$saleVersion.'"></script>
        <script src="/assets/js/swiper.js?v='.$swiperVersion.'"></script>
    ';
?>

