<?php include_once __DIR__.'/../components/header.php'; ?>

<section class="banner">
    <div class="banner__content">
        <p>Bienvenidos a <span>KTA Insititute</span></p>
        <h2>Aprende de profesionales con +de 30 años de experiencia</h2>  
        <p>se parte de los +de 2500 estudiantes exitosos e inicia tu propio Negocio.</p>
        <a href="/cursos">Explorar cursos</a>
    </div>

    <div class="banner__image">
        <div class="banner__image-fundador">
            <img src="/assets/images/fundador.jpg" alt="foto de fundador de kta">
        </div>
        
        <div class="banner__image-circle" id="banner__image-circle">
            <img src="/assets/images/bannerCircle.jpg" alt="imagen para animar de fondo">
        </div>

    </div>

</section>

<section class="why-us">

    <h2 class="why-us__title">¿Por qué nosotros?</h2>
    
    <p class="why-us__text">
        Somos una institución constituida por profesionales experimentados 
        en actividades economicas necesarias al desarrollo de empresas y al ser humano
    </p>

    <div class="why-us__grid">
        <div class="razon">
            <img class="razon__img" src="/assets/images/case-img-1.jpg" alt="imagen de razon 1">
            <p class="razon__sub" >Razón-01</p>
            <h3 class="razon__title">Maestros altamente especializados</h3>
        </div>
        <div class="razon">
            <img class="razon__img" src="/assets/images/case-img-2.jpg" alt="imagen de razon 1">
            <p class="razon__sub" >Razón-02</p>
            <h3 class="razon__title">+2500 estudiantes exitosos</h3>
        </div>
        <div class="razon">
            <img class="razon__img" src="/assets/images/case-img-3.jpg" alt="imagen de razon 1">
            <p class="razon__sub" >Razón-03</p>
            <h3 class="razon__title">Multiples modalidades en nuestros cursos</h3>
        </div>

        <div class="razon">
            <img class="razon__img" src="/assets/images/case-img-4.jpg" alt="imagen de razon 1">
            <p class="razon__sub" >Razón-04</p>
            <h3 class="razon__title">Mentorias personalizadas</h3>
        </div>
    </div>

</section>

<?php include_once __DIR__.'/../components/footer.php'; ?>


<?php 
    $scripts ='
        <script src="/assets/js/rotateImage.js"></script>
        <script src="/assets/js/mobileMenu.js"></script>
    ';
?>