<?php

    use App\Classes\Helpers;

    if(!isset($_SESSION)) session_start();
    $nameUser = Helpers::getFirstName($_SESSION['admin']['nombre']);
    
?>

<section class="toolbar">

    <div class="toolbar-left">
        
        <div class="toolbar-left__btn">
            <i class='bx bx-menu'></i>
        </div>

        <a href="/kta-admin/dashboard">
            <img src="/assets/images/logoKTA.jpg" alt="logo de KTA" class="toolbar-left__logo">
        </a>

        <p class="toolbar-left__title">
            KTA Institute Platform Administrator
        </p>
    </div>

    <div class="toolbar-right">

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

                <a class="main-logo" href="/kta-admin/dashboard">
                    <img src="/assets/images/logoKTA.jpg" alt="logo de KTA">
                </a>
                
            </div>

            <div class="menu-cont">
                <div class="nav-cont">

                    <div class="nav">                    
                        <a class="nav__link" href="/kta-admin/dashboard"> <i class='bx bxs-dashboard'></i> Dashboard</a>
                    </div>

                    <div class="nav">
                        <p class="nav__title">Pagina principal</p>
                        <a class="nav__link" href="/kta-admin/slidebar"> <i class='bx bxs-message-dots'></i> Slidebar</a>
                        <!-- <a class="nav__link" href="#"> <i class='bx bxs-message-dots'></i>Anuncio Gif</a> -->
                    </div>

                    <div class="nav">
                        <p class="nav__title">Cursos</p>
                        <a class="nav__link" href="/kta-admin/cursos"> <i class='bx bx-chalkboard'></i> Cursos</a>
                        <a class="nav__link" href="/kta-admin/pago-cursos"> <i class='bx bx-credit-card'></i> Pagos de cursos</a>
                        <a class="nav__link" href="/kta-admin/categorias"> <i class='bx bxs-category'></i> Categorias</a>
                    </div>

                    <div class="nav">
                        <p class="nav__title">Membresias</p>
                        <a class="nav__link" href="/kta-admin/membresias"> <i class='bx bxs-certification'></i> Membresias</a>
                        <a class="nav__link" href="/kta-admin/pago-membresias"> <i class='bx bx-credit-card'></i> Pagos de membresías</a>
                        <a class="nav__link" href="/kta-admin/estudiante-membresia"> <i class='bx bxs-user-badge' ></i> Estudiantes con membresías</a>
                    </div>

                    <div class="nav">
                        <p class="nav__title">Usuarios</p>
                        <a class="nav__link" href="/kta-admin/maestros"> <i class='bx bxs-user-detail'></i> Maestros</a>
                        <a class="nav__link" href="/kta-admin/estudiantes"> <i class='bx bxs-graduation'></i> Estudiantes</a>
                        <a class="nav__link" href="/kta-admin/administradores"> <i class='bx bxs-user'></i> Administradores</a>
                    </div>

                </div>
            
                <a target="_blank" class="text-version" href="https://dinozign.com/">
                    Powered by Dinozign
                </a>
            </div>
        </div>
    </div>

</section>
