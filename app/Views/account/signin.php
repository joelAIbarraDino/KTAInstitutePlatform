<main class="login">

    <div class="login-form">
        
        <div class="login-form-content">
            <a href="/">
                <img src="/assets/images/logoKTA.jpg" alt="logo kta" class="login-logo">
            </a>

            <a class="login-back" href="/login">
                <i class='bx bx-arrow-back'></i>Volver
            </a>

            <form method="post" class="form no-background">
                <legend class="form__title">Registro</legend>
                
                <p class="form__instructions">Complete los campos para continuar su registro</p>
        

                <div class="form__input">
                    <label for="name">Nombre</label>
                    <input 
                        type="text"
                        name="name"
                        id="name"
                        class="field"
                        placeholder="Ingrese su nombre"
                    >
                </div>

                <div class="form__input">
                    <label for="email">Correo</label>
                    <input 
                        type="email"
                        name="email"
                        id="email"
                        class="field"
                        placeholder="Ingrese su correo"
                    >
                </div>
                        
                <div class="form__input">
                    <label for="password">Contraseña</label>
        
                    <div class="icon-right">
                        <input 
                            type="password"
                            name="password"
                            id="password"
                            class="field"
                            placeholder="Ingrese su contraseña"
                        >
                        <i id="btn-showPass" class='bx bx-show is-btn'></i>
                    </div>
                </div>
        
                <div class="submit-center">
                    <input class="submit-block" type="submit" value="Registrarse">
                </div>
                
                <a class="enlace-signin"href="/login">¿Ya tienes una cuenta?<span>Inicia sesión</span></a>
            </form>
        </div>
    </div>

    <div class="login-image">
        <div class="login-filter"></div>

    </div>


</main>

<?php 
    $scripts ='
        <script src="/assets/js/showPassword.js"></script>
    ';
?>