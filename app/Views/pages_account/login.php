<?php include_once __DIR__.'/../components/header.php'; ?>

<section class="login">
    <form method="post" class="form login-cont">
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
                <i class='bx bx-show is-btn'></i>
            </div>    
        </div>

        <a href="/forgot" class="enlace-forgot">¿olvidaste tu contraseña?</a>


        <div class="submit-right">
            <input class="submit" type="submit" value="Iniciar sesión">
        </div>

    </form>

    <a class="login-signin"href="/sign-in">¿Nuevo en KTA?<span>Registrate</span></a>
</section>


<?php include_once __DIR__.'/../components/footer.php'; ?>