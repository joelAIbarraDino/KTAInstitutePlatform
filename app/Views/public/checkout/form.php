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
    
    <form id="payment-form" class="form-checkout" method="post">
        <h2 class="form-checkout__title">Completa tu pago</h2>

        <div class="form-checkout__field">
            <label for="name" class="form-checkout__label">Nombre completo</label>
            <input type="text" id="name" name="name" class="form-checkout__input" required />
        </div>

        <div class="form-checkout__field">
            <label for="email" class="form-checkout__label">Correo electrónico</label>
            <input type="email" id="email" name="email" class="form-checkout__input" required />
        </div>

        <div id="payment-element" class="form-checkout__field"></div>

        <div class="form-checkout__field form-checkout__field--checkbox">
            <input type="checkbox" id="terms" class="form-checkout__checkbox" />
            <label for="terms" class="form-checkout__checkbox-label">
                Acepto los <a href="/terminos-condiciones" target="_blank">términos y condiciones</a>
            </label>
        </div>

        <div class="form-checkout__actions">
            <button type="submit" id="submit" class="form-checkout__submit" disabled>Pagar</button>
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