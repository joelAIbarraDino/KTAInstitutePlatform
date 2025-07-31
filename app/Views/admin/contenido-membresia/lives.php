<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <div class="top-main">
            <h1 class="top-main__title">Gestión de membresías</h1>
            <a class="btn nuevo" href="/kta-admin/membresias"><i class='bx bx-left-arrow-alt'></i> Salir</a>
        </div>

        <?php include_once __DIR__.'/../../components/contentMembershipCard.php'; ?>

        <div class="course-options tabs__container">
            <div class="course-options__links">
                <a class="course-options__tab" href="/kta-admin/membership-course/<?=$membership->id_membership?>"><i class='bx bxs-video-recording'></i> Cursos self study</a>
                <a class="course-options__tab course-options__tab--active" href="/kta-admin/membership-live/<?=$membership->id_membership?>"><i class='bx bxl-zoom' ></i> Cursos en vivo</a>
            </div>
        </div>

        <div class="form tabs__container">
            <div class="new-module__title">
                <legend class="form__title">Cursos en vivo agregados</legend>
                <div id="container-alert" class="course-info__saved course-info__saved--waiting"></div>
            </div>
            <p class="form__instructions">Agrega los cursos en vivo que tendra la membresía</p>

            <div class="form__input new-module__form">
                <select name="live-cb" id="live-cb" class="field" >
                    <?php foreach($lives as $live): ?>
                        <option value="<?=$live->id_live?>"><?=$live->name?></option>
                    <?php endforeach; ?>
                </select>
                <button id="add_course_btn" type="button" class="new-module__btn"><i class='bx bxs-plus-circle'></i></button>
            </div>
            
            <div id="courses-container" class="courses-membership"></div>

        </div>

    </div>
</main>

<?php
    $membershipLiveVersion = filemtime('assets/js/membershipLive.js');

    $scripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/membershipLive.js?v='.$membershipLiveVersion.'"></script>
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>
