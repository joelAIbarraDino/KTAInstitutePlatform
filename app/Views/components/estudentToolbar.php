<?php

    use App\Classes\Helpers;

    if(!isset($_SESSION)) session_start();
    $nameUser = Helpers::getFirstName($_SESSION['student']['nombre']);
    $photo = $_SESSION['student']['photo'];
    
?>
<section class="toolbar">

    <div class="toolbar-left">
        
        <div class="toolbar-left__btn">
            <i class='bx bx-menu'></i>
        </div>

        <a href="/">
            <img src="/assets/images/logoKTA.jpg" alt="logo de KTA" class="toolbar-left__logo">
        </a>

        <p class="toolbar-left__title">
            KTA Institute Platform
        </p>
    </div>

    <div class="toolbar-right">

        <?php if(isset($photo)): ?>
            <a href="/mis-cursos" class="toolbar-right__photo-link">
                <img class="toolbar-right__photo" src="<?=$photo?>" alt="profile picture">    
            </a>
        <?php else:?>
            <a href="/mis-cursos" class="toolbar-right__logout">
                <i class='bx bx-user-circle' ></i>
            </a>
        <?php endif;?>
        
        <p class="toolbar-right__user">Hola<?=$nameUser?></p>
        
        <a href="/logout" class="toolbar-right__logout">
            <i class='bx bx-log-out'></i>
        </a>

    </div>

    <div class="toolbar-menu">
                
        <div class="toolbar-menu__content">
            
            <div class="toolbar-menu__content-top">

                <div class="btn-close">
                    <i class='bx bx-menu'></i>
                </div>

                <a class="main-logo" href="/">
                    <img src="/assets/images/logoKTA.jpg" alt="logo de KTA">
                </a>
                
            </div>

            <div class="menu-cont">
                <div class="nav-cont">

                    <div class="nav">
                        <p class="nav__title">Cursos</p>
                        <a class="nav__link" href="/mis-cursos"> <i class='bx bx-chalkboard'></i> Mis cursos</a>
                        <a class="nav__link" href="/cursos-pasados"> <i class='bx bxs-flag-checkered'></i> Cursos pasados</a>
                        <!-- <a class="nav__link" href="/mis-certificados"> <i class='bx bxs-award' ></i> Certificados</a> -->
                    </div>

                    <div class="nav">
                        <p class="nav__title">Perfil</p>
                        <a class="nav__link" href="/mi-perfil"> <i class='bx bx-user-circle' ></i> Mi perfil</a>
                    </div>

                    <div class="nav">
                        <p class="nav__title">Seguridad</p>
                        <a class="nav__link" href="/seguridad-acceso"> <i class='bx bxs-lock' ></i> Acceso</a>
                    </div>

                </div>
            
                <a target="_blank" class="text-version" href="https://dinozign.com/">
                    Powered by Dinozign
                </a>
            </div>
        </div>
    </div>

</section>
