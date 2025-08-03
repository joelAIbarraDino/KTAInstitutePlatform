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

    <div class="toolbar-right"></div>

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
                        <p class="nav__saludo">¡Bienvenido de vuelta!</p>
                        <p class="nav__title-text"><?=$nameUser?></p>
                    </div>

                    <div class="nav">                    
                        <a class="nav__link nav__link--regular-link" href="/kta-admin/dashboard"> <i class='bx bxs-dashboard'></i> Dashboard</a>
                    </div>

                    <div class="nav">
                        <p class="nav__title">Pedidos</p>
                        <a class="nav__link nav__link--regular-link" href="/kta-admin/pago-cursos"> <i class='bx bx-credit-card'></i> Pagos de Cursos</a>
                        <a class="nav__link nav__link--regular-link" href="/kta-admin/pago-lives"> <i class='bx bx-credit-card'></i> Pagos de Lives</a>
                        <a class="nav__link nav__link--regular-link" href="/kta-admin/pago-membresias"> <i class='bx bx-credit-card'></i> Pagos deMembresías</a>
                    </div>

                    <div class="nav">
                        <p class="nav__title">Pagina principal</p>
                        <a class="nav__link nav__link--regular-link" href="/kta-admin/slidebar"> <i class='bx bxs-message-dots'></i> Slidebar</a>
                        <!-- <a class="nav__link nav__link--regular-link" href="#"> <i class='bx bxs-message-dots'></i>Anuncio Gif</a> -->
                    </div>

                    <div class="nav">
                        <p class="nav__title">Cursos</p>
                        <a class="nav__link nav__link--regular-link" href="/kta-admin/cursos"> <i class='bx bx-chalkboard'></i> Ver Cursos</a>
                        <a class="nav__link nav__link--regular-link" href="/kta-admin/categorias"> <i class='bx bxs-category'></i> Ver Categorías</a>
                    </div>

                    <div class="nav">
                        <p class="nav__title">Lives</p>
                        <a class="nav__link nav__link--regular-link" href="/kta-admin/lives"> <i class='bx bx-chalkboard'></i> Ver Cursos en vivo</a>
                    </div>

                    <div class="nav">
                        <p class="nav__title">Membresías</p>
                        <a class="nav__link nav__link--regular-link" href="/kta-admin/membresias"> <i class='bx bxs-certification'></i> Ver Membresías</a>
                        <!-- <a class="nav__link nav__link--regular-link" href="/kta-admin/estudiante-membresia"> <i class='bx bxs-user-badge' ></i> Estudiantes con membresías</a> -->
                    </div>

                    <div class="nav">
                        <p class="nav__title">Usuarios</p>
                        <a class="nav__link nav__link--regular-link" href="/kta-admin/maestros"> <i class='bx bxs-user-detail'></i> Maestros</a>
                        <a class="nav__link nav__link--regular-link" href="/kta-admin/estudiantes"> <i class='bx bxs-graduation'></i> Estudiantes</a>
                        <a class="nav__link nav__link--regular-link" href="/kta-admin/administradores"> <i class='bx bxs-user'></i> Administradores</a>
                    </div>

                    <div class="nav">
                        <a class="nav__link nav__link--exit-session" href="/logout"> <i class='bx bx-log-out'></i> Cerrar sesión</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</section>
