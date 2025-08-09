<?php 

    use App\Classes\Helpers;

    if(!isset($_SESSION))
        session_start();
    
    if(isset($_SESSION['admin']))
        $nameUser = Helpers::getFirstName($_SESSION['admin']['nombre']);
?>

<?php if(isset($_SESSION['admin'])): ?>
    <div class="admin-header">
        <div class="admin-header__left">
            <p class="admin-header__title">Modo administrador</p>
            <a class="admin-header__admin" href="/kta-admin/dashboard">Panel administrador</a>
        </div>

        <div class="admin-header__right">
            <p class="admin-header__name">Hola, <?=$nameUser?></p>
            <a class="admin-header__logout"href="/logout"> <i class="bx bx-log-out"></i></a>
        </div>
    </div>
<?php endif;?>

<header class="header">
    <div class="header__left" data-aos="fade-right" data-aos-delay="">
        <a href="/"><img class="header__logo" src="/assets/images/logoKTA.jpg" alt="logo de KTA"></a>
        <h1 class="header__title">KTA Institute</h1>
    </div>

    <nav id="menu" class="header__nav">
        <div class="header__close" id="btn-close">
            <i class='bx bx-x'></i>
        </div>

        <ul class="header__nav-list" data-aos="fade-up" data-aos-delay="50">
            <li><a class="header__link" href="/" data-section="header" data-label="home">Inicio</a></li>
            <li><a class="header__link" href="/cursos" data-section="header" data-label="self-study">Cursos grabados</a></li>
            <li><a class="header__link" href="/lives" data-section="header" data-label="lives">Cursos en vivo</a></li>
            <li><a class="header__link" href="/calendario" data-section="header" data-label="calendar">Calendario</a></li>
            <li><a class="header__link" href="/nosotros" data-section="header" data-label="about-us">¿Quiénes somos?</a></li>
            <li><a class="header__link" href="/membresias" data-section="header" data-label="membership">Membresías</a></li>
            <li><a class="header__link" href="/testimonios" >Testimonios</a></li>

            <?php if(isset($_SESSION['student'])): ?>
                <li><a class="header__button-login header__button-login--nav" href="/mis-cursos" data-section="header" data-label="my-space">Mi espacio</a></li>
            <?php elseif(isset($_SESSION['admin'])):?>    
            <?php else:?>    
                <li><a class="header__button-signin header__button-signin--nav" href="/sign-up" data-section="header" data-label="sign-up">Registrate</a></li>
                <li><a class="header__button-login header__button-signin--nav" href="/login" data-section="header" data-label="login">Iniciar sesión</a></li>
            <?php endif;?>
        </ul>
    </nav>
    


    <div class="header__login" data-aos="fade-left" data-aos-delay="100">

        <?php if(isset($_SESSION['student'])): ?>
            <a class="header__button-login header__button-login--login" href="/mis-cursos" data-section="header" data-label="my-space">Mi espacio</a>
        <?php elseif(isset($_SESSION['admin'])):?>
        <?php else:?>
            <a class="header__button-signin header__button-signin--login" href="/sign-up" data-section="header" data-label="sign-up">Registrate</a>
            <a class="header__button-login header__button-signin--login" href="/login" data-section="header" data-label="login">Iniciar sesión</a>
        <?php endif;?>

        <div class="header__hamburger" id="btn-menu">
            <i class='bx bx-menu'></i>
        </div>
    </div>

</header>
