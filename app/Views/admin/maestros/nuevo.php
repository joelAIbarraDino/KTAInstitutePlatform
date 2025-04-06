<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <div class="top-main">
            <h1 class="top-main__title">Gestión de maestros</h1>
            <a class="btn nuevo" href="javascript:history.back()"><i class='bx bx-chevrons-left'></i> Regresar</a>
        </div>

        <form id="form-teacher" class="form" enctype="multipart/form-data">
            <legend class="form__title">Nuevo maestro</legend>
            
            <p class="form__instructions">Completa los campos para registrar un nuevo maestro</p>
            
            <div class="grid-elements">
                <div class="form__file col-4">
                    <label for="photo-btn"> Foto de maestro (requerido)</label>
                    <input 
                        type="file"
                        name="photo"
                        id="photo"
                        accept="image/*"
                        hidden
                    >
                    <button type="button" id="photo-btn" class="form__file-btn">Seleccionar foto</button>
                    <span id="msg-photo" class="form__input-msg"></span>
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
                        placeholder="Nombre del categoria"
                        
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
                        >
                    </div>    
                    <span id="msg-experience" class="form__input-msg"></span>
                </div>

                <div class="form__input col-4">
                    <label for="password">Contraseña (requerido)</label>

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
                        
                    ></textarea>
                    <span id="msg-bio" class="form__input-msg"></span>
                </div>
            </div>

            <div class="submit-right">
                <input class="submit" type="submit" value="Registarar maestro">
            </div>

        </form>
    </div>
</main>

<?php
    $scripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/newTeacher.js"></script>
        <script src="/assets/js/showPassword.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>