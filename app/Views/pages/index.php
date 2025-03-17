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

<?php include_once __DIR__.'/../components/footer.php'; ?>


<?php 
    $scripts ='
        <script src="/assets/js/rotateImage.js"></script>
    ';
?>