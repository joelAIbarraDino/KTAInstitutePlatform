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

            <a class="login-back" href="/">
                <i class='bx bx-arrow-back'></i>Volver
            </a>
            
            <form id="login-form" class="form no-background">
                <legend class="form__title">Iniciar sesión</legend>
                
                <p class="form__instructions">Ingresa tu correo electronico y tu contraseña</p>
        
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
                    <a href="/forgot" class="enlace-forgot">¿olvidaste tu contraseña?</a>    
                </div>
        
                <div class="submit-center">
                    <input class="submit-block" type="submit" value="Iniciar sesión">
                </div>
                
                <a class="enlace-signin"href="/sign-up">¿Nuevo en KTA?<span>Registrate</span></a>

                <div class="login-separator">
                    <hr class="login-line-separator" />
                        <span class="login-text-separator">Otras formas de iniciar sesión</span>
                    <hr class="login-line-separator" />
                </div>


                <div id="g_id_onload"
                    data-client_id="259164387547-is5ht615qalq1tud4mh1jik9u9l8phf7.apps.googleusercontent.com"
                    data-login_uri="<?=$googleCallBack?>"
                    data-auto_prompt="false"
                ></div>
                <div style="display: flex; justify-content: center; flex-direction:column">
                    <div class="g_id_signin"
                        data-type="standard"
                        data-size="large"
                        data-theme="outline"
                        data-text="sign_in_with"
                        data-shape="rectangular"
                        data-logo_alignment="left"
                        data-width="400px">
                    </div>
                </div>

            </form>            
        </div>
    </div>

    <div class="login-image-login">
        <div class="login-filter"></div>
    </div>


</main>

<?php

    $scripts ='
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/showPassword.js"></script>
        <script src="/assets/js/login.js"></script>
    ';

    Helpers::showSwalAlert();
?>