<header class="header <?=$isTransparent??false?"transparente":"" ?>">
    <div class="header__contenedor container">
        <div class="header__logo">
            <a href="/">
                <img src="/assets/images/logoKTA.jpg" alt="Logo">
            </a>
        </div>
        
        <div class="header__menu">
            <nav class="navegacion">
                <ul class="navegacion__lista" id="menu">
                    <li class="navegacion__item">
                        <a href="/curses" class="navegacion__enlace">Cursos</a>
                    </li>
                    <li class="navegacion__item">
                        <a href="/about" class="navegacion__enlace">Sobre nosotros</a>
                    </li>
                    <li class="navegacion__item">
                        <a href="/memberships" class="navegacion__enlace">Membresias</a>
                    </li>
                </ul>
                
            </nav>
            
            <div class="header__sesion">
                <a href="/login" class="boton boton--login">
                    <i class="fas fa-user"></i> Iniciar Sesión
                </a>
            </div>


            <button class="navegacion__hamburguesa" id="hamburguesa">
                    <i class='bx bx-menu'></i>
            </button>
        </div>
    </div>
</header>