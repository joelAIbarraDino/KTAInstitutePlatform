<?php if($course->discount): ?>

    <div class="curso">
        <div class="curso__imagen-contenedor">
            <a href="/curso/view/<?=$course->url?>">
                <img src="/assets/thumbnails/courses/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>" class="curso__imagen">
            </a>

            <span class="curso__categoria"><?=$course->category?></span>
            <div class="curso__descuento-etiqueta">-<?=$course->discount?>%</div>
        </div>
        <div class="curso__contenido">
            
            <div class="curso__tipo">
                <i class='bx bx-camera-movie'></i> <span>Contenido grabado</span>
            </div>

            <a href="/curso/view/<?=$course->url?>"><h3 class="curso__nombre"><?=$course->name?></h3></a>
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
            <a href="/curso/view/<?=$course->url?>">
                <img src="/assets/thumbnails/courses/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>" class="curso__imagen">
            </a>
            
            <span class="curso__categoria"><?=$course->category?></span>
        </div>
        <div class="curso__contenido">
            <div class="curso__tipo curso__tipo--live">
                <i class='bx bxl-zoom' ></i> <span>Contenido en vivo</span>
            </div>
            <a href="/curso/view/<?=$course->url?>"><h3 class="curso__nombre"><?=$course->name?></h3></a>
            
            <div class="curso__detail">
                <i class='bx bx-calendar'></i> 20 de Enero
            </div>

            <div class="curso__detail">
                <i class='bx bx-time'></i> 5 pm <span class="curso__detail-timezone">Hora del este</span>
            </div>

            <div class="curso__detail">
                <i class='bx bx-book-bookmark'></i> Profesor: <span><a href="/profesor/view/<?=$course->id_teacher?>"><?=$course->teacher?></a></span>
            </div>

            <?php if($course->enrollment >2): ?>
                <div class="curso__detail">
                    <i class='bx bxs-graduation'></i> <?=$course->enrollment?> <span>inscritos</span>
                </div>
            <?php endif;?>

            <div class="curso__precios">
                <p class="curso__precio curso__precio--normal">$<?=$course->price?> USD</p>
            </div>
        </div>

        <div class="curso__botones">
            <a href="/live/checkout/<?=$course->url?>" class="curso__boton curso__boton--venta">¡Comprar ahora!</a>
            <a href="/live/view/<?=$course->url?>" class="curso__boton curso__boton--ver">Mas detalles</a>
        </div>
    </div>

<?php endif; ?>
