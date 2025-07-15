<?php include_once __DIR__.'/../components/header.php'; ?>

<?php include_once __DIR__.'/../components/slider.php'; ?>

<div class="gif">
    <img src="/assets/images/gif.gif" alt="gif" class="gif__image">
</div>

<?php include_once __DIR__.'/../components/lastCourses.php'; ?>

<section class="caracts-main">

    <div class="caracts-main__container">
        <div class="caract-main">
            <img class="caract-main__icon" loading="lazy" src="/assets/images/conferencia.png">
            <h3 class="caract-main__title">Seminarios presenciales</h3>
            <p class="caract-main__text">
                Organizamos distintos seminarios presenciales para que pueda continuar con tu formación tributaria en distintas ciudades del país como Los Ángeles, Orlando, Houston, Phoenix, San Diego, New York, Miami, etc...
            </p>
        </div>

        <div class="caract-main">
            <img class="caract-main__icon" loading="lazy" src="/assets/images/reunion.png">
            <h3 class="caract-main__title">LIVE WEBINARS</h3>
            <p class="caract-main__text">
                La mayoría de nuestros cursos ofrecen la posibilidad de ser realizados en vivo, permiten la interacción con el instructor y aseguran que los contenidos estén siempre actualizados.
            </p>
        </div>

        <div class="caract-main">
            <img class="caract-main__icon" loading="lazy" src="/assets/images/online.png">
            <h3 class="caract-main__title">ON DEMAND WEBINARS</h3>
            <p class="caract-main__text">
                Ofrecemos todos nuestros cursos en formato On Demand para que  estudie cuándo, dónde y cómo desee. Todos los cursos son actualizados permanentemente.
            </p>
        </div>

        <div class="caract-main">
            <img class="caract-main__icon" loading="lazy" src="/assets/images/audiolibro.png">
            <h3 class="caract-main__title">LIBROS TRIBUTARIOS</h3>
            <p class="caract-main__text">
                Tenemos a tu disposición una completa colección de libros tributarios constantemente actualizados y editados   incorporando así todos los cambios y novedades fiscales.
            </p>
        </div>
    </div>

    <div class="caracts-main__irs">
        <img class="caracts-main__irs-logo" src="https://ktainstitute.com/wp-content/uploads/2024/11/CE_Continuing_Education-300x178.jpeg">
    </div>


</section>

<section class="estadisticas">

    <div class="estadisticas__container">
        <div class="estadistica">
            <i class='bx bxs-award' ></i>
            <div class="estadistica__content">
                <p class="estadistica__title counter" data-target="2500" data-caract="+" data-caract="+">0</p>
                <p class="estadistica__desc">Estudiantes exitosos</p>
            </div>
        </div>

        <div class="estadistica">
            <i class='bx bx-chalkboard' ></i>
            <div class="estadistica__content">
                <p class="estadistica__title counter" data-target="215" data-caract="">0</p>
                <p class="estadistica__desc">Video tutoriales</p>
            </div>
        </div>

        <div class="estadistica">
            <i class='bx bx-user'></i>
            <div class="estadistica__content">
                <p class="estadistica__title counter" data-target="4" data-caract="">0</p>
                <p class="estadistica__desc">Maestros especializados</p>
            </div>
        </div>

        <div class="estadistica">
            <i class='bx bx-glasses-alt'></i>
            <div class="estadistica__content">
                <p class="estadistica__title counter" data-target="18" data-caract="+">0</p>
                <p class="estadistica__desc">Cursos unicos</p>
            </div>
        </div>

    </div>
</section>

<!-- Elfsight Google Reviews | Untitled Google Reviews -->
<script src="https://static.elfsight.com/platform/platform.js" async></script>
<div class="elfsight-app-3d89288d-8b7b-48c8-91cd-90483692c0c2" data-elfsight-app-lazy></div>


<section class="membresias-index">
    <p class="membresias-index__subtitulo">Descubre cómo podemos ayudarte</p>
    <h3 class="membresias-index__titulo" >Tenemos la solución adecuada para cada persona</h3>

    <div class="membresias-index__container">
        
        <div class="membresia-index">
            <img class="membresia-index__imagen" src="/assets/images/membresia1.png" alt="imagen">
            <div class="membresia-index__container">
                <p class="membresia-index__titulo">Nuestros cursos</p>
                <p class="membresia-index__texto">
                    Aprende de profesionales con más de 30 años de experiencia. Sé parte de nuestros +2,500 estudiantes exitosos e inicia tu propio negocio.
                </p>

                <div class="membresia-index__container-link">
                    <a class="membresia-index__enlace" href="/cursos">Ver más</a>
                </div>
            </div>
        </div>

        <div class="membresia-index">
            <img class="membresia-index__imagen" src="/assets/images/membresia1.png" alt="imagen">
            <div class="membresia-index__container">
                <p class="membresia-index__titulo">Membresia KTA</p>
                <p class="membresia-index__texto">
                    ¿Ya  tienes experiencia como preparador de impuestos y quieres pasar al siguiente nivel?. 
                    Con nuestra <strong>Membresía Business Lab<strong> tendrás todo lo que necesitas para llegar a lo mas alto.
                </p>

                <div class="membresia-index__container-link">
                    <a class="membresia-index__enlace" href="/membresias">Ver mas info</a>
                </div>
            </div>
        </div>

    </div>    

    

</section>

<div id="purchase-popup" class="popup hidden">
  <span id="popup-text"></span>
</div>

<a class="whatsapp" target="_blank" href="https://api.whatsapp.com/send/?phone=17866124893&text=Hola%20KTA,%20tengo%20una%20duda%20y%20necesito%20ayuda">
    <p class="whatsapp__tooltip">WhatsApp</p>
    <div class="whatsapp__icon">
        <i class='bx bxl-whatsapp'></i>
    </div>
</a>

<?php include_once __DIR__.'/../components/footer.php'; ?>

<?php 

    $sliderVersion = filemtime('assets/js/slider.js');
    $saleVersion = filemtime('assets/js/saleAlerts.js');
    $animationVersion = filemtime('assets/js/counter.js');

    $scripts ='
        <script src="/assets/js/menu.js"></script>
        <script src="/assets/js/counter.js?v='.$animationVersion.'"></script>
        <script src="/assets/js/slider.js?v='.$sliderVersion.'"></script>
        <script src="/assets/js/saleAlerts.js?v='.$saleVersion.'"></script>
    ';
?>

