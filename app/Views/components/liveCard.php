<?php
    // use App\Classes\Helpers;
    // $fechas =  Helpers::formatearFechasHoras($live->dates_times);
?>

<?php if($live->discount): ?>

    <div class="curso">
        <div class="curso__imagen-contenedor">
            <a href="/curso/view/<?=$course->url?>">
                <img src="/assets/thumbnails/courses/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>" class="curso__imagen">
            </a>

            <span class="curso__categoria"><?=$course->category?></span>
            <div class="curso__descuento-etiqueta">-<?=$course->discount?>%</div>
        </div>
        <div class="curso__contenido">
            
            <!-- <div class="curso__tipo">
                <i class='bx bxl-zoom' ></i> <span>Contenido en vivo</span>
            </div> -->

            <a href="/curso/view/<?=$course->url?>"><h3 class="curso__nombre curso__nombre--student"><?=$course->name?></h3></a>
            
            <!-- <?php if($course->enrollment >2): ?>
                <div class="curso__detail">
                    <i class='bx bxs-graduation'></i> <?=$course->enrollment?> <span>inscritos</span>
                </div>
            <?php endif;?> -->

            <!-- <div class="curso__precios">
                <p class="curso__precio curso__precio--original">$<?=$course->price?></p>
                <p class="curso__precio curso__precio--oferta">$<?= $course->price * (1 - ($course->discount/100))?> USD</p>
            </div> -->
            <!-- <p class="curso__fecha-descuento">Oferta válida hasta: <?= date('F j, Y', strtotime($course->discount_ends_date))?></p> -->
        </div>
    </div>

<?php else: ?>

    <div class="curso">
        <div class="curso__imagen-contenedor">
            <a href="/live/view/<?=$live->url?>">
                <img src="/assets/thumbnails/lives/<?=$live->thumbnail?>" alt="<?=$live->thumbnail?>" class="curso__imagen">
            </a>
            
            <span class="curso__categoria"><?=$live->category?></span>
        </div>
        <div class="curso__contenido">
            <!-- <div class="curso__tipo curso__tipo--live" data-section="live-details" data-label="type-content">
                <i class='bx bxl-zoom' ></i> <span>Contenido en vivo</span>
            </div> -->

            <a href="/curso/view/<?=$live->url?>"><h3 class="curso__nombre curso__nombre--student" data-section="live-<?=$live->id_live?>" data-label="name"><?=$live->name?></h3></a>
            
            <!-- <div class="curso__detail">
                <i class='bx bx-calendar'></i> <?php //$fechas['fechas'] ?>
            </div> -->

            <!-- <div class="curso__detail">
                <i class='bx bx-time'></i> <?php //$fechas['horas'] ?> <span class="curso__detail-timezone">Hora del este</span>
            </div> -->

            <!-- <?php if($live->enrollment >2): ?>
                <div class="curso__detail">
                    <i class='bx bxs-graduation'></i> <?=$live->enrollment?> <span>inscritos</span>
                </div>
            <?php endif;?> -->

            <!-- <div class="curso__precios">
                <p class="curso__precio curso__precio--normal">$<?=$live->price?> USD</p>
            </div> -->

        </div>

        <!-- <div class="curso__botones">
            <a href="/checkout/live/<?=$live->url?>" class="curso__boton curso__boton--venta" data-section="course-details" data-label="checkout">¡Comprar ahora!</a>
            <a href="/live/view/<?=$live->url?>" class="curso__boton curso__boton--ver" data-section="index" data-label="membership-button">Mas detalles</a>
        </div> -->
    </div>

<?php endif; ?>
