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
                <legend class="form__title">Recuperar acceso</legend>
                
                <p class="form__instructions">Ingresa tu correo electronico para recuperar el acceso a tu cuenta</p>

                <?php include_once __DIR__.'/../components/alerts.php'; ?>

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
                    <input class="submit-block" type="submit" value="Enviar correo">
                </div>

                <div class="credit-kta">
                    <p class="credit-kta__text">Powered by </p>
                    <img src="/assets/images/logoKTA.jpg" alt="logo kta" class="credit-kta__logo">
                </div>

            </form>
        </div>
    </div>

    <div class="login-image-sigin">
        <div class="login-filter-admin"></div>
    </div>

</main>