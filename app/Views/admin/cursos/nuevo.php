<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

        <div class="top-main">
            <h1 class="top-main__title">Gestión de cursos</h1>
            <a class="btn nuevo" href="javascript:history.back()"><i class='bx bx-chevrons-left'></i> Regresar</a>
        </div>

        <form class="form form-admin" enctype="multipart/form-data">
            <legend class="form__title">Nuevo curso</legend>
            
            <p class="form__instructions">Completa los campos requeridos para crear un nuevo curso</p>
            
            <?php include_once __DIR__.'/../../components/alerts.php'; ?>

            <?php include_once __DIR__.'/form.php'; ?>
            
            <div class="submit-right">
                <input class="submit" type="submit" value="Crear curso">
            </div>

        </form>

    </div>
</main>

<?php
    $scripts = '
        <script src="/assets/js/btnFile.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>