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
                <a class="course-options__tab" href="/kta-admin/course-faq/<?=$course->id_course?>"><i class='bx bx-question-mark' ></i> FAQ's</a>
                <a class="course-options__tab course-options__tab--active" href="/kta-admin/course-quiz/<?=$course->id_course?>"><i class='bx bx-list-check' ></i> Examen</a>
            </div>
        </div>

        <div class="form tabs__container">
            <div class="new-module__title">
                <legend class="form__title">Evaluación del curso</legend>
                <div id="container-alert" class="course-info__saved course-info__saved--waiting"></div>
            </div>

            
            <div class="faq-control">
                <p class="faq-control__instructions">Edite las preguntas y respuestas  que desea cambiar</p>
                <div class="faq-control__buttons">
                    <button id="add_conf_btn" class="faq-control__btn-conf"><i class='bx bx-cog'></i> Configuración</button>
                    <button id="add_FAQ_btn" class="faq-control__btn-add"><i class='bx bxs-message-rounded-add'></i> Pregunta de examen</button>
                </div>
            </div>
            
            <div id="quiz-container" class="modules"></div>

        </div>

    </div>
</main>

<?php
    $scripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script src="/assets/js/privacyControl.js"></script>
        <script src="/assets/js/quiz.js"></script>
    ';
?>
