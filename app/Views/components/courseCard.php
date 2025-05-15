<?php if($course->discount): ?>

    <div class="curso">
        <div class="curso__imagen-contenedor">
            <a href="/curso/view/<?=$course->id_course?>">
                <img src="/assets/thumbnails/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>" class="curso__imagen">
            </a>

            <span class="curso__categoria"><?=$course->category?></span>
            <div class="curso__descuento-etiqueta">-<?=$course->discount?>%</div>
        </div>
        <div class="curso__contenido">
            <a href="/curso/view/<?=$course->id_course?>"><h3 class="curso__nombre"><?=$course->name?></h3></a>
            <p class="curso__maestro">Por: <?=$course->teacher?></p>
            <div class="curso__precios">
                <p class="curso__precio curso__precio--original">$<?=$course->price?></p>
                <p class="curso__precio curso__precio--oferta">$<?= $course->price * (1 - ($course->discount/100))?> USD</p>
            </div>
            <p class="curso__fecha-descuento">Oferta válida hasta: <?= date('F j, Y', strtotime($course->discount_ends_date))?></p>
        </div>
    </div>

<?php else: ?>

    <div class="curso">
        <div class="curso__imagen-contenedor">
            <a href="/curso/view/<?=$course->id_course?>">
                <img src="/assets/thumbnails/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>" class="curso__imagen">
            </a>
            
            <span class="curso__categoria"><?=$course->category?></span>
        </div>
        <div class="curso__contenido">
            <a href="/curso/view/<?=$course->id_course?>"><h3 class="curso__nombre"><?=$course->name?></h3></a>
            <p class="curso__maestro">Por: <?=$course->teacher?></p>
            <div class="curso__precios">
                <p class="curso__precio curso__precio--normal">$<?=$course->price?> USD</p>
            </div>
        </div>
    </div>

<?php endif; ?>
