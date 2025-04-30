<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <div class="top-main">
            <h1 class="top-main__title">Gestión de sliders</h1>
            <a class="btn nuevo" href="javascript:history.back()"><i class='bx bx-chevrons-left'></i> Regresar</a>
        </div>

        
        <form class="form form-admin" enctype="multipart/form-data" method="post">
            <legend class="form__title">Nuevo slider</legend>
            
            <p class="form__instructions">Completa los campos para crear un nuevo slidebar</p>
            <?php include_once __DIR__.'/../../components/alerts.php'; ?>
            
            <div class="grid-elements">
                <div class="form__file col-4">
                    <label for="photo-btn"> Background de slider (requerido)</label>
                    <input 
                        type="file"
                        name="background"
                        id="background"
                        accept="image/*"
                        hidden
                        class="real-btn-file"
                    >
                    <button type="button" class="form__file-btn btn-file">Seleccionar foto</button>
                    <span class="form__input-msg name-file"></span>
                </div>
            </div>

            <div class="grid-elements">

                <div class="form__input col-12">
                    <label for="title"> Titulo (requerido)</label>
                    <input 
                        type="text"
                        name="title"
                        id="title"
                        class="field"
                        placeholder="Titulo de slider"
                        value="<?=$slidebar->title ?>"
                        
                    >
                    <span id="msg-name" class="form__input-msg"></span>
                </div>

                <div class="form__input col-12">
                    <label for="subtitule"> Subtitulo (requerido)</label>
                    <input
                        type="text"
                        name="subtitule"
                        id="subtitule"
                        class="field"
                        placeholder="Nombre del categoria"
                        value="<?=$slidebar->subtitule?>"
                        
                    >
                    <span id="msg-email" class="form__input-msg"></span>
                </div>

            </div>

            <div class="submit-right">
                <input id="new-teacher-btn" class="submit" type="submit" value="Crear slidebar">
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