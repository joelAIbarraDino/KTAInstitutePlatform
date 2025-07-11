<?php 
    if(!isset($_SESSION))
        session_start();

?>

<header class="header">
    <a href="/">
        <img class="header__logo" src="/assets/images/logoKTA.jpg" alt="logo de KTA">
    </a>

    <nav id="menu" class="header__nav">
        <div class="header__close" id="btn-close">
            <i class='bx bx-x'></i>
        </div>

        <ul class="header__nav-list">
            <li><a class="header__link" href="/cursos">Cursos grabados</a></li>
            <li><a class="header__link" href="/lives">Cursos en vivo</a></li>
            <li><a class="header__link" href="/nosotros">¿Quienes somos?</a></li>
            <li><a class="header__link" href="/membresias">Membresías</a></li>

            <?php if(isset($_SESSION['student'])): ?>
                <li><a class="header__button-login header__button-login--menu" href="/mis-cursos">Mi espacio</a></li>
            <?php else:?>
                <li><a class="header__button-login header__button-login--menu" href="/login">Iniciar sesión</a></li>
            <?php endif;?>
        </ul>
    </nav>
    


    <div class="header__login">

        <?php if(isset($_SESSION['student'])): ?>
            <a class="header__button-login header__button-login--login" href="/mis-cursos">Mi espacio</a>
        <?php else:?>
            <a class="header__button-login header__button-login--login" href="/login">Iniciar sesión</a>
        <?php endif;?>
        
        <div class="header__hamburger" id="btn-menu">
            <i class='bx bx-menu'></i>
        </div>
    </div>

</header>
