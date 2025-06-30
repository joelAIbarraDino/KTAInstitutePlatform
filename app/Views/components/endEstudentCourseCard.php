<div class="curso">
    <div class="curso__imagen-contenedor">
        <img src="/assets/thumbnails/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>" class="curso__imagen">

        <span class="curso__categoria"><?=$course->category?></span>
    </div>
    <div class="curso__contenido">
        <h3 class="curso__nombre"><?=$course->course?></h3>

        <div class="curso__progress">
            <p class="curso__progress-label">Progreso:</p>
            <progress class="curso__progress-bar" max="100" value="20"></progress>
            <p class="curso__progress-percentage">20%</p>
        </div>

        <div class="curso__links">
            <p class="curso__nombre">Curso iniciado el: <?=$course->enrollment_at?></p>
        </div>

    </div>
</div>