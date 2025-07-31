<?php

    use App\Classes\Helpers;

    $topScripts = '
        <script src="https://accounts.google.com/gsi/client" async></script>
    ';
?>

<main class="login">

    <div class="login-form">
        
        <div class="login-form-content">
            <a href="/">
                <img src="/assets/images/logoKTA.jpg" alt="logo kta" class="login-logo">
            </a>

            <a class="login-back" href="/login">
                <i class='bx bx-arrow-back'></i>Volver
            </a>

            <form id="signin-form" method="post" class="form no-background">
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

                <div class="login-separator">
                    <hr class="login-line-separator" />
                        <span class="login-text-separator">Otras formas de registrarse</span>
                    <hr class="login-line-separator" />
                </div>


                <div id="g_id_onload"
                    data-client_id="259164387547-is5ht615qalq1tud4mh1jik9u9l8phf7.apps.googleusercontent.com"
                    data-login_uri="http://localhost:3000/auth/google-callback"
                    data-auto_prompt="false"
                ></div>
                <div class="g_id_signin"
                    data-type="standard"
                    data-size="large"
                    data-theme="outline"
                    data-text="signup_with"
                    data-shape="rectangular"
                    data-logo_alignment="left">
                </div>
            </form>
        </div>
    </div>

    <div class="login-image-sigin">
        <div class="login-filter"></div>

    </div>


</main>

<?php 
    
    $scripts ='
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/showPassword.js"></script>
        <script src="/assets/js/signIn.js"></script>
    ';

    Helpers::showSwalAlert();
?>