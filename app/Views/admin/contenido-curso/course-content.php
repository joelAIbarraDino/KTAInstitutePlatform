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
                <a class="course-options__tab course-options__tab--active" href="/kta-admin/course-content/<?=$course->id_course?>"><i class='bx bxs-videos'></i> Contenido</a>
                <a class="course-options__tab" href="/kta-admin/course-faq/<?=$course->id_course?>"><i class='bx bx-question-mark' ></i> FAQ's</a>
                <a class="course-options__tab" href="/kta-admin/course-quiz/<?=$course->id_course?>"><i class='bx bx-list-check' ></i> Examen</a>
                <a class="course-options__tab" href="/kta-admin/review-quiz/<?=$course->id_course?>"><i class='bx bx-file-find'></i> Evaluaciones pendientes</a>
                <a class="course-options__tab" href="/kta-admin/attempts-quiz/<?=$course->id_course?>"><i class='bx bx-list-check'></i> Todas las evaluaciones</a>
            </div>
        </div>

        <div class="form tabs__container">
            <div class="new-module__title">
                <legend class="form__title">Contenido de curso</legend>
                <div id="container-alert" class="course-info__saved course-info__saved--waiting"></div>
            </div>
            <p class="form__instructions">Agrega los modulos y clases que tendra el nuevo curso</p>

            <div class="form__input new-module__form">
                <input 
                    type="text" 
                    id="new_module_name" 
                    placeholder="Nombre del módulo" 
                    class="field" 
                />
                
                <button id="add_module_btn" type="button" class="new-module__btn"><i class='bx bx-subdirectory-left'></i></button>
            </div>
            
            <legend>Mueva los modulos al orden deseado</legend>
            
            <div id="modules-container" class="modules"></div>

        </div>

    </div>
</main>

<?php

    $courseContentVersion = filemtime('assets/js/courseContent.js');

    $scripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script src="/assets/js/privacyControl.js"></script>
        <script src="/assets/js/courseContent.js?v='.$courseContentVersion.'"></script>
    ';
?>
