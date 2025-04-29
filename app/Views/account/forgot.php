<?php include_once __DIR__.'/../components/header.php'; ?>

<section class="login principal">
    <form method="post" class="form login-cont">
        <legend class="form__title">Recuperar contraseña</legend>
        
        <p class="form__instructions">Ingresa tu correo electronico para recuperar su acceso a la plataforma</p>

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

        <div class="submit-right">
            <input class="submit" type="submit" value="Enviar correo">
        </div>

    </form>

    <a class="login-signin"href="/sign-in">¿Nuevo en KTA?<span>Registrate</span></a>

    <a class="login-signin"href="/login">¿Ya tienes una cuenta con nosotros?<span>Inicia sesión</span></a>
</section>


<?php include_once __DIR__.'/../components/footer.php'; ?>