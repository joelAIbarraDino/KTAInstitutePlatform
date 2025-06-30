<?php include_once __DIR__.'/../../components/estudentToolbar.php'; ?>

<main class="background-profile">
    <div class="courses-container">

        <h1 class="course-title" >Mis cursos</h1>

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
    </div>
</main>

<?php include_once __DIR__.'/../../components/footer.php'; ?>

<?php 
    $scripts ='
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>