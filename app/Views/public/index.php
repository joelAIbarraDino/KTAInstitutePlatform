<?php include_once __DIR__.'/../components/header.php'; ?>


<main class="">
    <?php include_once __DIR__.'/../components/slider.php'; ?>

    <?php include __DIR__.'/../components/kioskoCurso.php'; ?>

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

    <?php include_once __DIR__.'/../components/categories.php'; ?>
    
    <section class="about">
        <div class="about__grid">

            <div class="foto-fundador-1"></div>

            <div class="info-1">
                <i class='bx bx-chalkboard bx-tada' ></i>
                <p>5 años de experiencia</p>
            </div>

            <div class="info-2">
                <i class='bx bxs-graduation bx-tada' ></i>
                <p>+70 cursos</p>
            </div>

            <div class="foto-fundador-2"></div>
        </div>

        <div class="about__cont">

            <h2 class="about__cont-title">Sobre nosotros</h2>
            <p class="about__cont-sub">Para nosotros, enseñar es mas importante que asistir</p>
            <a class="about__cont-btn" href="/nosotros">Mas sobre nosotros</a>

        </div>
    </section>

</main>

<?php include_once __DIR__.'/../components/footer.php'; ?>

<?php 
    $scripts ='
        <script src="/assets/js/slider.js"></script>
        <script src="/assets/js/kiskoCurso.js"></script>
        <script src="/assets/js/header.js"></script>
    ';
?>