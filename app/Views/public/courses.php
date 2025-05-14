<?php include_once __DIR__.'/../components/header.php'; ?>

<div class="principal cursos-principal">

    <div class="cursos-filtro width-80">
        <h1 class="cursos-filtro__titulo" >Nuestros cursos</h1>
        <p class="cursos-filtro__desc">Empieza, cambia o avanza en tu carrera con KTA como guía.</p>

        <div class="cursos-filtro__categorias">
            <a class="cursos-filtro__categoria <?=!isset($category_url)?'cursos-filtro__categoria--active':''?>" href="/cursos" >Todos los cursos</a>
            <?php foreach($categories as $category): ?>

                <?php if(isset($category_url)):?>
                    <a 
                        class="cursos-filtro__categoria  <?=$category_url == $category->id_category?'cursos-filtro__categoria--active':''?>"
                        href="/cursos/categoria/<?=$category->id_category?>"
                        ><?=$category->name?>
                    </a>

                <?php else:?>
                    <a 
                        class="cursos-filtro__categoria"
                        href="/cursos/categoria/<?=$category->id_category?>"
                        ><?=$category->name?>
                    </a>
                <?php endif;?>
                
            <?php endforeach ;?>
        </div>
    </div>

    <div class="cursos-container">
        
        <div class="cursos-container__grid width-80">
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