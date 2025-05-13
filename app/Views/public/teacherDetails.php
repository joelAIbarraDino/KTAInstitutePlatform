<?php include_once __DIR__.'/../components/header.php';?>

<div class="principal">

    <div class="ver-profesor">   
        <h1 class="ver-profesor__titulo">Conoce a tu instructor</h1>
        <div class="ver-profesor__container width-50">
            <img class="ver-profesor__foto" src="/assets/teachers/<?=$teacher->photo?>" alt="<?=$teacher->photo?>">

            <div class="ver-profesor__data">
                <div class="ver-profesor__name">
                    <?=$teacher->name?>
                    <div class="ver-profesor__speciality"><?=$teacher->speciality?></div>
                </div>

                <div class="ver-profesor__experience">
                    <?=$teacher->experience?> años de <span>experiencia</span>
                </div>

                <div class="ver-profesor__bio">
                    <?=$teacher->bio?>
                </div>
            </div>
        </div>

    </div>

    <div id="cursos-profesor" class="cursos-profesor">
        <h2 class="cursos-profesor__titulo">Cursos de <?=$teacher->name?></h2>
        <div class="cursos-profesor__container width-80">
            <?php foreach($courses as $course):?>
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
                            <p class="curso__fecha-descuento">Oferta válida hasta: <?=$course->discount_ends_date?></p>
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
            <?php endforeach;?>
        </div>
    </div>
</div>

<?php include_once __DIR__.'/../components/footer.php';?>