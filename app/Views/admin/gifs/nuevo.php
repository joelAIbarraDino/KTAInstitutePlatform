<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <div class="top-main">
            <h1 class="top-main__title">Gestión de gifs</h1>
            <a class="btn nuevo" href="/kta-admin/gifs"><i class='bx bx-chevrons-left'></i> Regresar</a>
        </div>

        
        <form class="form form-admin" enctype="multipart/form-data" method="post">
            <legend class="form__title">Nuevo gif</legend>
            
            <p class="form__instructions">Completa los campos para crear un nuevo gif</p>
            <?php include_once __DIR__.'/../../components/alerts.php'; ?>
            
            <?php include_once __DIR__.'/form.php'; ?>

            <div class="submit-right">
                <input id="new-teacher-btn" class="submit" type="submit" value="Crear gif">
            </div>

        </form>
    </div>
</main>

<?php
    $scripts = '
        <script src="/assets/js/btnFile.js"></script>
    ';
?>