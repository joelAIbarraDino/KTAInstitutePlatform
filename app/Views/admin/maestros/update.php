<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <div class="top-main">
            <h1 class="top-main__title">Gestión de maestros</h1>
            <a class="btn nuevo" href="javascript:history.back()"><i class='bx bx-chevrons-left'></i> Regresar</a>
        </div>

        <div class="picture-form">
            <img src="/assets/teachers/<?=$teacher->photo?>" alt="foto de maestro">
        </div>

        <form method="post" class="form form-admin" enctype="multipart/form-data">
            <legend class="form__title">Editar maestro maestro</legend>
            
            <p class="form__instructions">Edite los campos que quiere cambiar</p>
            <?php include_once __DIR__.'/../../components/alerts.php'; ?>
            
            <div class="grid-elements">
                <div class="form__file col-4">
                    <label for="photo-btn"> Foto de maestro</label>
                    <input 
                        type="file"
                        name="photo"
                        id="photo"
                        accept="image/*"
                        class="real-btn-file"
                    >
                </div>
            </div>

            <div class="grid-elements">

                <div class="form__input col-6">
                    <label for="name"> Nombre (requerido)</label>
                    <input 
                        type="text"
                        name="name"
                        id="name"
                        class="field"
                        placeholder="Nombre del maestro(a)"
                        value="<?=$teacher->name?>"
                        
                    >
                    <span id="msg-name" class="form__input-msg"></span>
                </div>

                <div class="form__input col-6">
                    <label for="email"> Email (requerido)</label>
                    <input 
                        type="email"
                        name="email"
                        id="email"
                        class="field"
                        placeholder="Nombre del categoria"
                        value="<?=$teacher->email?>"
                        
                    >
                    <span id="msg-email" class="form__input-msg"></span>
                </div>

            </div>

            <div class="grid-elements">

                <div class="form__input col-4">
                    <label for="speciality">Especialidad (requerido)</label>
                    <input 
                        type="text"
                        name="speciality"
                        id="speciality"
                        class="field"
                        placeholder="Area de experiencia"
                        value="<?=$teacher->speciality?>"
                        
                    >
                    <span id="msg-speciality" class="form__input-msg"></span>
                </div>

                <div class="form__input col-4">
                    <label for="experience">Experiencia (requerido)</label>
                    <div class="icon-left">
                        <i class='bx bxs-graduation'></i>
                        <input 
                            type="text"
                            name="experience"
                            id="experience"
                            class="field"
                            placeholder="Tiempo en años de experiencia"
                            value="<?=$teacher->experience?>"
                        >
                    </div>    
                    <span id="msg-experience" class="form__input-msg"></span>
                </div>

                <div class="form__input col-4">
                    <label for="password">Actualizar contraseña</label>

                    <div class="icon-right">
                        <input 
                            type="password"
                            name="password"
                            id="password"
                            class="field"
                            placeholder="Ingrese una contraseña"
                        >
                        <i id="btn-showPass" class='bx bx-show is-btn'></i>
                    </div>    
                    <span id="msg-password" class="form__input-msg"></span>
                </div>
                
            </div>

            <div class="grid-elements">
                <div class="form__input col-12">
                    <label for="bio">Bio (requerido)</label>
                    <textarea 
                        name="bio" 
                        id="bio"
                        class="text-area"
                        placeholder="Biografia y experiencia del maestro"
                    ><?=$teacher->bio?></textarea>
                    <span id="msg-bio" class="form__input-msg"></span>
                </div>
            </div>

            <div class="submit-right">
                <input class="submit" type="submit" value="Actualizar maestro">
            </div>

        </form>

    </div>
</main>

<?php
    $scripts = '
        <script src="/assets/js/showPassword.js"></script>
        <script src="/assets/js/btnFile.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>