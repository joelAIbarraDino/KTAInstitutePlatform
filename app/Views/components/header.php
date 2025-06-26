<?php 
    if(!isset($_SESSION))
        session_start();

?>

<header id="header-main" class="header <?=$transparente?'transparente':'solido'?>">
    
    <div class="header__actions">
        
    </div>
    
    
    <nav class="header__nav">
        <a class="btn-nav <?=$title == "Inicio"?'btn-nav--active':''?>" href="/">Inicio</a>
        <a class="btn-nav <?=$title == "Cursos"?'btn-nav--active':''?>" href="/cursos">Cursos</a>
        <a href="/"><img class="header__logo" src="/assets/images/logoKTA.jpg" alt="logo de KTA" ></a>
        <a class="btn-nav <?=$title == "Nosotros"?'btn-nav--active':''?>" href="/nosotros">Nosotros</a>
        <a class="btn-nav <?=$title == "Membresias"?'btn-nav--active':''?>" href="/mebresias">Membresias</a>
    </nav>

    <div class="header__actions">
        <?php if(isset($_SESSION['student'])): ?>

            <?php if(isset($_SESSION['student']['photo'])): ?>
                <a href="/mis-cursos" class="header__actions-profile">
                    <img class="header__actions-photo" src="<?=$_SESSION['student']['photo']?>" alt="profile picture">    
                </a>
            <?php else:?>
                <a  class="header__actions-link" href="/mis-cursos"><i class='bx bx-user-circle' ></i></a>
            <?php endif;?>

        <?php else:?>
            <a  class="header__actions-link" href="/login"><i class='bx bx-log-in'></i></a>
        <?php endif;?>
    </div>

</header>