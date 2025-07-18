<?php $topScripts = '<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">'; ?>
<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>
<?php include_once __DIR__.'/../../components/fontFamilyCB.php'; ?>

<main class="main">
    <div class="main__container">

        <div class="top-main">
            <h1 class="top-main__title">Gestión de cursos</h1>
            <a class="btn nuevo" href="/kta-admin/cursos"><i class='bx bx-chevrons-left'></i> Regresar</a>
        </div>

        <form class="form form-admin" enctype="multipart/form-data" method="POST">
            <legend class="form__title">Actualizar curso</legend>
            
            <p class="form__instructions">Edite los campos que quiere cambiar</p>
            
            <?php include_once __DIR__.'/../../components/alerts.php'; ?>

            <?php include_once __DIR__.'/form.php'; ?>
            
            <div class="submit-right">
                <input class="submit" type="submit" value="Actualizar curso">
            </div>

        </form>

    </div>
</main>

<script>

</script>

<?php
    $editorVersion = filemtime('assets/js/editor.js');

    $scripts = '
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
        <script src="/assets/js/editor.js?v='.$editorVersion.'"></script>
        <script src="/assets/js/btnFile.js"></script>
        <script src="/assets/js/btnFile2.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>