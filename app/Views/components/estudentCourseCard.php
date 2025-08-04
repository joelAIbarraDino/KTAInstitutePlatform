<?php if($course->privacy == 'Público'): ?>

    <div class="curso">
        <div class="curso__imagen-contenedor">
            <a href="/curso/watch/<?=$course->enroll_url?>">
                <img src="/assets/thumbnails/courses/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>" class="curso__imagen">
            </a>

            <span class="curso__categoria"><?=$course->category?></span>
        </div>
        <div class="curso__contenido">
            <a href="/curso/watch/<?=$course->enroll_url?>"><h3 class="curso__nombre curso__nombre--student"><?=$course->course?></h3></a>

            <?php if($percentage == 0):?>
                <div class="curso__progress">
                    <p class="curso__progress-no-progress">Empezar curso</p>
                    <progress class="curso__progress-bar" max="100" value="0"></progress>
                </div>
            <?php else: ?>
                <div class="curso__progress">
                    <p class="curso__progress-label">Progreso:</p>
                    <progress class="curso__progress-bar" max="100" value="<?=$percentage?>"></progress>
                    <p class="curso__progress-percentage"><?=sprintf("%02.2s", $percentage) ?>%</p>
                </div>
            <?php endif; ?>                

            <div class="curso__links">
                <a href="/curso/view/<?=$course->course_url?>" class="curso__link curso__link--secondary">Ver detalles</a>
                <a href="/curso/watch/<?=$course->enroll_url?>" class="curso__link curso__link--active">Continuar</a>
            </div>

        </div>
    </div>

<?php else: ?>

    <div class="curso">
        <div class="curso__imagen-contenedor">
            <img src="/assets/thumbnails/courses/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>" class="curso__imagen">

            <div class="curso__filter"></div>
            <span class="curso__categoria"><?=$course->category?></span>
            <div class="curso__descuento-etiqueta">Curso no disponible</div>
        </div>
        <div class="curso__contenido">
            <h3 class="curso__nombre"><?=$course->course?></h3>

            <?php if($percentage == 0):?>
                <div class="curso__progress">
                    <p class="curso__progress-no-progress">Empezar curso</p>
                    <progress class="curso__progress-bar" max="100" value="0"></progress>
                </div>
            <?php else: ?>
                <div class="curso__progress">
                    <p class="curso__progress-label">Progreso:</p>
                    <progress class="curso__progress-bar" max="100" value="<?=$percentage?>"></progress>
                    <p class="curso__progress-percentage"><?=sprintf("%02.2s", $percentage)?>%</p>
                </div>
            <?php endif; ?>                

            <div class="curso__links">
                <p class="curso__link--disabled">Ver detalles</p>
                <p class="curso__link--disabled">Iniciar</p>
            </div>

        </div>
    </div>

<?php endif; ?>
