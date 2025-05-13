<?php if(count($courses)> 0):?>
    
    <div class="kiosko">
        <h2 class="kiosko__titulo">Ultimos Cursos</h2>

        <div class="kiosko__content">
            
            <div class="kiosko__contenedor">

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
            
            <div class="kiosko__controles">
                <button class="kiosko__boton kiosko__boton--anterior"><i class='bx bx-chevrons-left' ></i></button>
                <button class="kiosko__boton kiosko__boton--siguiente"><i class='bx bx-chevrons-right'></i></button>
            </div>
            
            <div class="kiosko__puntos"></div>
        </div>
    </div>

<?php else:?>

    <div class="kiosko empty">
        <h2 class="kiosko__titulo empty">Proximamente</h2>

        <p class="kiosko__title empty">Nuevos cursos para tí </p>
    </div>

<?php endif;?>