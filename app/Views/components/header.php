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
            <p class="admin-header__name">Hola<?=$nameUser?></p>
            <a class="admin-header__logout"href="/logout"> <i class="bx bx-log-out"></i></a>
        </div>
    </div>
<?php endif;?>

<header class="header">
    <a href="/">
        <img class="header__logo" src="/assets/images/logoKTA.jpg" alt="logo de KTA">
    </a>

    <nav id="menu" class="header__nav">
        <div class="header__close" id="btn-close">
            <i class='bx bx-x'></i>
        </div>

        <ul class="header__nav-list">
            <li><a class="header__link" href="/">Inicio</a></li>
            <li><a class="header__link" href="/cursos">Cursos grabados</a></li>
            <!-- <li><a class="header__link" href="/lives">Cursos en vivo</a></li> -->
            <!-- <li><a class="header__link" href="/calendario">Calendario</a></li> -->
            <!-- <li><a class="header__link" href="/reviews">Reviews</a></li> -->
            <li><a class="header__link" href="/nosotros">¿Quienes somos?</a></li>
            <li><a class="header__link" href="/membresias">Membresías</a></li>

            <?php if(isset($_SESSION['student'])): ?>
                <li><a class="header__button-login" href="/mis-cursos">Mi espacio</a></li>
            <?php elseif(isset($_SESSION['admin'])):?>
        
            <?php else:?>
                <li><a class="header__button-login" href="/login">Iniciar sesión</a></li>
            <?php endif;?>
        </ul>
    </nav>
    


    <div class="header__login">
        <div class="header__hamburger" id="btn-menu">
            <i class='bx bx-menu'></i>
        </div>
    </div>

</header>
