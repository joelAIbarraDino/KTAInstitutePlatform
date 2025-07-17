<?php if($courses):?>

    <section class="last-courses">
        <?php if($title != "Inicio"):?>
            <h3 class="last-courses__title">Ultimos cursos</h3>
        <?php endif;?>
        <div class="main-courses">
            <?php foreach($courses as $course):?>
                <?php include __DIR__.'/courseCard.php';?>
            <?php endforeach;?>
        </div>
    </section>

<?php else:?>
    <div class="empty-main-course">
        <p class="empty-main-course__empty">Proximamente, mas cursos para tí</p>
    </div>
<?php endif;?>