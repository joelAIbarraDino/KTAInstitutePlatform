<?php if($course->privacy == 'Público'): ?>

    <div class="curso">
        <div class="curso__imagen-contenedor">
            <a href="/curso/view/<?=$course->url?>">
                <img src="/assets/thumbnails/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>" class="curso__imagen">
            </a>

            <span class="curso__categoria"><?=$course->category?></span>
        </div>
        <div class="curso__contenido">
            <a href="/curso/view/<?=$course->url?>"><h3 class="curso__nombre"><?=$course->name?></h3></a>

            <div class="curso__progress">
                <p class="curso__progress-label">Progreso:</p>
                <progress class="curso__progress-bar" max="100" value="20"></progress>
                <p class="curso__progress-percentage">20%</p>
            </div>

            <div class="curso__links">
                <p class="curso__link">Ver detalles</p>
                <p class="curso__link curso__link--active">Continuar</p>
            </div>

        </div>
    </div>

<?php else: ?>

    <div class="curso">
        <div class="curso__imagen-contenedor">
            <img src="/assets/thumbnails/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>" class="curso__imagen">

            <div class="curso__filter"></div>
            <span class="curso__categoria"><?=$course->category?></span>
            <div class="curso__descuento-etiqueta">Curso no disponible</div>
        </div>
        <div class="curso__contenido">
            <h3 class="curso__nombre"><?=$course->name?></h3>

            <div class="curso__progress">
                <p class="curso__progress-no-progress">Empezar curso</p>
                <progress class="curso__progress-bar" max="100" value="0"></progress>
            </div>


            <div class="curso__links">
                <p class="curso__link--disabled">Ver detalles</p>
                <p class="curso__link--disabled">Iniciar</p>
            </div>

        </div>
    </div>

<?php endif; ?>
