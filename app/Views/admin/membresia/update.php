<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <div class="top-main">
            <h1 class="top-main__title">Gestión de membresias</h1>
            <a class="btn nuevo" href="/kta-admin/membresias"><i class='bx bx-chevrons-left'></i> Regresar</a>
        </div>

        <form method="post" class="form form-admin">
            <legend class="form__title">Editar membresia</legend>
            
            <p class="form__instructions">Edite los campos que quiere cambiar</p>
            
            <?php include_once __DIR__.'/../../components/alerts.php'; ?>
            
            <?php include_once __DIR__.'/form.php'; ?>

            <div class="submit-right">
                <input class="submit" type="submit" value="Actualizar membresia">
            </div>

        </form>

    </div>
</main>

<?php
    $scripts = '
        <script src="/assets/js/showPassword.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>