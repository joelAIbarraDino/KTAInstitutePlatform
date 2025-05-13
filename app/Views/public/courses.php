<?php include_once __DIR__.'/../components/header.php'; ?>

<div class="principal cursos-principal">

    <div class="cursos-filtro">
        <p class="cursos-filtro__titulo" >Categorias</p>

        <div class="cursos-filtro__categorias">
            <?php foreach($categories as $category): ?>
                <a class="cursos-filtro__categoria" href="/cursos/categoria/<?=$category->id_category?>" ><?=$category->name?></a>
            <?php endforeach ;?>
        </div>
    </div>

    <div class="cursos-container">

        <p class="cursos-container__title" >Todos los cursos</p>

        <div class="cursos-container__grid">
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
                                <p class="curso__precio curso__precio--oferta">$<?= $course->price * (1 - ($course->discount/100))?></p>
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
                                <p class="curso__precio curso__precio--normal">$<?=$course->price?></p>
                            </div>
                        </div>
                    </div>
                    
                <?php endif; ?>
            <?php endforeach;?>
        </div>
    </div>

    
</div>

<?php include_once __DIR__.'/../components/footer.php'; ?>