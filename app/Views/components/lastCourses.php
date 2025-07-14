<?php if($courses):?>

    <section class="last-courses">
        <?php if($title != "Inicio"):?>
            <h3 class="last-courses__title">Ultimos cursos</h3>
        <?php endif;?>
        <div class="main-courses">
            <?php foreach($courses as $course):?>
                <div class="main-course">
                    <a href="/curso/view/<?=$course->url?>"> 
                        <img class="main-course__picture" src="/assets/background-courses/<?=$course->background?>" alt="thumbnail">
                    </a>
                    <div class="main-course__more-info-container">
                        <a class="main-course__more-info" href="/curso/view/<?=$course->url?>">+ info</a>   
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </section>

<?php else:?>
    <div class="empty-main-course">
        <p class="empty-main-course__empty">Proximamente, mas cursos para tí</p>
    </div>
<?php endif;?>