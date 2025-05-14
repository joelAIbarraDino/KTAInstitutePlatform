<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <div class="top-main">
            <h1 class="top-main__title">Gestión de cursos</h1>
            <a class="btn nuevo" href="/kta-admin/categorias"><i class='bx bx-chevrons-left'></i> Regresar</a>
        </div>

        <form class="form tabs__container" method="POST">
            <legend class="form__title">Nueva categoria</legend>
            
            <p class="form__instructions">Completa los campos para crear una nueva categoria</p>
            
            <?php include_once __DIR__.'/../../components/alerts.php'; ?>
            
            <?php include_once __DIR__.'/form.php';?>

            <div class="submit-right">
                <input class="submit" type="submit" value="Crear categoria">
            </div>

        </form>
    </div>
</main>

<?php
    $scripts = '
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>