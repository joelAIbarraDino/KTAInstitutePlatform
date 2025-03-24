<?php include_once __DIR__.'/../components/header.php'; ?>


<section class="login">

    <?php include_once __DIR__.'/../components/alerts.php'; ?>

    <form method="post" class="form login-cont" enctype="multipart/form-data">
        <legend class="form__title">Cargar video</legend>
        
        <p class="form__instructions">Completa todos los campos para subir el video</p>

        <div class="form__input">
            <label for="name"> Nombre</label>
            <input 
                type="text"
                name="name"
                id="name"
                class="field"
            >
        </div>

        <div class="form__input">
            <label for="desc">Description</label>

            <textarea 
                name="desc" 
                id="desc"
                class="text-area"
            ></textarea>
        </div>
        
        <div class="form__input">
            <label for="video">Archivo</label>
            <input 
                type="file"
                name="video"
                id="video"
            >
        </div>

        <div class="submit-right">
            <input class="submit" type="submit" value="Subir video">
        </div>

    </form>
</section>


<?php include_once __DIR__.'/../components/footer.php'; ?>

