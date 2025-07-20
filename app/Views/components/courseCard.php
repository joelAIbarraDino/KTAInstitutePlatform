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
            
            <div class="curso__tipo curso__tipo--grabado" data-section="course-details" data-label="type-content">
                <i class='bx bx-camera-movie'></i> <span>Contenido grabado</span>
            </div>
            <a href="/curso/view/<?=$course->url?>"><h3 class="curso__nombre" data-section="course-<?=$course->id_course?>" data-label="name"><?=$course->name?></h3></a>
            
            <div class="curso__detail">
                <i class='bx bx-calendar'></i> <?=$course->max_months_enroll?> <span data-section="course-details" data-label="access-content">Meses de acceso a material</span>
            </div>

            <div class="curso__detail">
                <i class='bx bx-book-bookmark'></i> <div data-section="course-details" data-label="teacher">Profesor:</div> <span><a href="/profesor/view/<?=$course->id_teacher?>"><?=$course->teacher?></a></span>
            </div>

            <?php if($course->enrollment >2): ?>
                <div class="curso__detail">
                    <i class='bx bxs-graduation'></i> <?=$course->enrollment?> <span>estudiantes</span>
                </div>
            <?php endif;?>

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
            <div class="curso__tipo curso__tipo--grabado" data-section="course-details" data-label="type-content">
                <i class='bx bx-camera-movie'></i> <span>Contenido grabado</span>
            </div>
            <a href="/curso/view/<?=$course->url?>"><h3 class="curso__nombre" data-section="course-<?=$course->id_course?>" data-label="name"><?=$course->name?></h3></a>
            
            <div class="curso__detail">
                <i class='bx bx-calendar'></i> <?=$course->max_months_enroll?> <span data-section="course-details" data-label="access-content">Meses de acceso a material</span>
            </div>

            <div class="curso__detail">
                <i class='bx bx-book-bookmark'></i> <div data-section="course-details" data-label="teacher">Profesor:</div> <span><a href="/profesor/view/<?=$course->id_teacher?>"><?=$course->teacher?></a></span>
            </div>

            <?php if($course->enrollment >2): ?>
                <div class="curso__detail">
                    <i class='bx bxs-graduation'></i> <?=$course->enrollment?> <span>estudiantes</span>
                </div>
            <?php endif;?>

            <div class="curso__precios">
                <p class="curso__precio curso__precio--normal">$<?=$course->price?> USD</p>
            </div>
        </div>

        <div class="curso__botones">
            <a href="/curso/checkout/<?=$course->url?>" class="curso__boton curso__boton--venta" data-section="course-details" data-label="checkout">¡Comprar ahora!</a>
            <a href="/curso/view/<?=$course->url?>" class="curso__boton curso__boton--ver" data-section="index" data-label="membership-button">Mas detalles</a>
        </div>
    </div>

<?php endif; ?>
