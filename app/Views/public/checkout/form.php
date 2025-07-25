<?php
    $topScripts ='
        <script src="https://js.stripe.com/v3/"></script>
    ';
?>

<?php include_once __DIR__.'/../../components/header.php'; ?>

<main class="checkout">

    <div class="checkout__summary">
        <img src="<?=$caratula?>" alt="Carátula del curso" class="checkout__image" />
        <h3 class="checkout__title"><?=$nameProducto?></h3>
        <p class="checkout__price">$ <?= number_format($price, 2)?> USD</p>
    </div>
    
    <form id="payment-form" class="form" method="post">
        <h2 class="form__title">Completa tu pago</h2>

        <div class="form__field">
            <label for="name" class="form__label">Nombre completo</label>
            <input type="text" id="name" name="name" class="form__input" required />
        </div>

        <div class="form__field">
            <label for="email" class="form__label">Correo electrónico</label>
            <input type="email" id="email" name="email" class="form__input" required />
        </div>

        <div id="payment-element" class="form__field"></div>

        <div class="form__field form__field--checkbox">
            <input type="checkbox" id="terms" class="form__checkbox" />
            <label for="terms" class="form__checkbox-label">
                Acepto los <a href="/terminos-condiciones" target="_blank">términos y condiciones</a>
            </label>
        </div>

        <div class="form__actions">
            <button type="submit" id="submit" class="form__submit" disabled>Pagar</button>
        </div>
    </form>


    <script>
        const termsCheckbox = document.querySelector("#terms");
        const submitBtn = document.querySelector("#submit");

        termsCheckbox.addEventListener("change", () => {
            submitBtn.disabled = !termsCheckbox.checked;
        });    
    </script>


</main>


<?php include_once __DIR__.'/../../components/footer.php'; ?>