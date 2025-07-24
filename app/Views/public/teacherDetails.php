<?php include_once __DIR__.'/../components/header.php';?>

<main>

    <div class="ver-profesor">   
        <h1 class="ver-profesor__titulo" data-section="teacher-details" data-label="meet-teacher">Conoce a tu instructor</h1>
        <div class="ver-profesor__container width-50">
            <img class="ver-profesor__foto" src="/assets/teachers/<?=$teacher->photo?>" alt="<?=$teacher->photo?>">

            <div class="ver-profesor__data">
                <div class="ver-profesor__name">
                    <?=$teacher->name?>
                    <div class="ver-profesor__speciality" data-section="teacher-<?=$teacher->id_teacher?>" data-label="speciality"><?=$teacher->speciality?></div>
                </div>

                <div class="ver-profesor__experience">
                    <?=$teacher->experience?> <span data-section="teacher-details" data-label="years-experience">años de experiencia</span>
                </div>

                <div class="ver-profesor__bio" data-section="teacher-<?=$teacher->id_teacher?>" data-label="bio">
                    <?=$teacher->bio?>
                </div>
            </div>
        </div>

    </div>

    <div id="cursos-profesor" class="cursos-profesor">
        <h2 class="cursos-profesor__titulo"><span data-section="teacher-details" data-label="course-by">Cursos de</span> <?=$teacher->name?></h2>
        <div class="cursos-profesor__container">
            <?php if(!empty($courses)): ?>
                <?php foreach($courses as $course):?>
                    <?php include __DIR__.'/../components/courseCard.php'; ?>
                <?php endforeach;?>
            <?php else:?>
                <p class="cursos-profesor__empty">Proximamente mas cursos</p>
            <?php endif;?>

            
        </div>
    </div>
</main>

<?php include_once __DIR__.'/../components/footer.php';?>

<?php 
    $menuVersion = filemtime('assets/js/menu.js');
    $scripts ='
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
    ';
?>