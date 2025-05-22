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
        <a href="/search"><i class='bx bx-search-alt-2'></i></a>
        <a href="/login"><i class='bx bxs-user' ></i></a>
    </div>

</header>