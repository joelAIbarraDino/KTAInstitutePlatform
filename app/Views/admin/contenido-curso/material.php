<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <div class="top-main">
            <h1 class="top-main__title">Gestión de curso</h1>
            <button class="btn nuevo" id="btn-exit"><i class='bx bx-left-arrow-alt'></i> Salir</button>
        </div>

        <?php include_once __DIR__.'/../../components/contentCourseCard.php'; ?>

        <div class="course-options tabs__container">
            <div class="course-options__links">
                <a class="course-options__tab" href="/kta-admin/course-content/<?=$course->id_course?>"><i class='bx bxs-videos'></i> Contenido</a>
                <a class="course-options__tab course-options__tab--active" href="/kta-admin/course-material/<?=$course->id_course?>"><i class='bx bx-file' ></i> Materiales</a>
                <a class="course-options__tab" href="/kta-admin/course-faq/<?=$course->id_course?>"><i class='bx bx-question-mark' ></i> FAQ's</a>
                <a class="course-options__tab" href="/kta-admin/course-quiz/<?=$course->id_course?>"><i class='bx bx-list-check' ></i> Examen</a>
                <a class="course-options__tab" href="/kta-admin/review-quiz/<?=$course->id_course?>"><i class='bx bx-file-find'></i> Evaluaciones pendientes</a>
                <a class="course-options__tab" href="/kta-admin/attempts-quiz/<?=$course->id_course?>"><i class='bx bx-list-check'></i> Todas las evaluaciones</a>
            </div>
        </div>

        

        <form class="form form-admin" enctype="multipart/form-data" id="form-material">
            <legend class="form__title">Nuevo slider</legend>
        
            <p class="form__instructions">Completa los campos para crear un nuevo slidebar</p>

            <div class="grid-elements">
                
                <div class="form__input col-4">
                    <label for="name_file"> Nombre de archivo</label>
                    <input 
                        type="text"
                        name="name_file"
                        id="name_file"
                        class="field"
                        placeholder="Nombre que verá el estudiante"
                    >
                </div>

                <div class="form__input col-4">
                    <label for="lesson">Leccion</label>
                        <select name="lesson" id="lesson" class="field" >
                            <option value="" disabled selected >Seleccionar lección</option>
                            <?php foreach($lessons as $lesson):?>
                                <option value="<?=$lesson->id_lesson?>" ><?=$lesson->name?></option>
                            <?php endforeach;?>
                        </select>
                </div>
            
                <div id="input-image" class="form__file col-4">
                    <label for="file_material"> Material del curso</label>
                    <input 
                        type="file"
                        name="file_material"
                        id="file_material"
                        accept="*/*"
                        hidden
                        class="real-btn-file"
                    >
                    <button type="button" class="form__file-btn btn-file">Seleccionar archivo</button>
                    <span class="form__input-msg name-file"></span>
                </div>
            </div>

            <div class="submit-right">
                <input id="new-teacher-btn" class="submit" type="submit" value="Subir material">
            </div>

            <div id="modules-container" class="material">
                <div class="material__element">
                    <p>Nombre de archivo</p>
                    <button type="button" class="module__btn module__btn--eliminar"><i class="bx bx-trash"></i></button>
                </div>
            </div>
        </form>
        
    </div>
</main>

<?php

    $materialContentVersion = filemtime('assets/js/content-material.js');

    $scripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script src="/assets/js/btnFile.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script src="/assets/js/content-material.js?v='.$materialContentVersion.'"></script>
        <script src="/assets/js/privacyControl.js"></script>
        
    ';
?>
