<?php include_once __DIR__.'/../../components/estudentToolbar.php'; ?>

<main class="background-profile">
    <div class="courses-container">

        <h2 class="course-title" >Mis cursos</h2>

        <div class="my-courses">
            <?php if(count($myCourses) === 0): ?>
                <p class="my-courses__empty">No hay cursos activos</p>
            <?php else: ?>
                <div class="my-courses__courses">
                    <?php foreach($myCourses as $course):?>
                            <?php include __DIR__.'/../../components/estudentCourseCard.php'; ?>
                    <?php endforeach;?>
                </div>
            <?php endif; ?>
        </div>

        <?php if($courses):?>

        <section class="last-courses">
            <?php if($title != "Inicio"):?>
                <h3 class="last-courses__title">Ultimos cursos</h3>
            <?php endif;?>
            <div class="main-courses col-4">
                <?php foreach($courses as $course):?>
                    <?php include __DIR__.'/../../components/courseCard.php';?>
                <?php endforeach;?>
            </div>
        </section>

    <?php else:?>
        <div class="empty-main-course">
            <p class="empty-main-course__empty">Proximamente, mas cursos para tí</p>
        </div>
    <?php endif;?>
    </div>
</main>

<?php include_once __DIR__.'/../../components/footer.php'; ?>

<?php 
    $scripts ='
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>