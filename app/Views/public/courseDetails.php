<?php include_once __DIR__.'/../components/header.php';?>

<main>
    <div class="cover-curso" style="background-image: url(/assets/thumbnails/<?=$course->thumbnail?>);">
        <div class="cover-curso__cover">

            <div class="cover-curso__datos" id="main-content">
                
                <div class="cover-curso__cont-regreso">
                    <a class="cover-curso__regreso" href="javascript:history.back();">&laquo Regresar</a>
                </div>

                <h1 class="cover-curso__name"><?=$course->name?></h1>
                <p class="cover-curso__lema"><?=$course->watchword?></p>

                <div class="cover-curso__detalles">
                    <div class="cover-curso__detalle">
                        <i class='bx bx-movie'></i> 0 <span>lecciones</span>
                    </div>
                    
                    <div class="cover-curso__detalle">
                        <i class='bx bx-calendar'></i> <?=$course->max_months_enroll?> <span>meses de estudio</span>
                    </div>

                    <?php if($course->enrollment):?>
                        <div class="cover-curso__detalle">
                            <i class='bx bxs-graduation'></i> <?=$course->enrollment?> <span>estudiantes</span>
                        </div>
                    <?php endif;?>

                    <div class="cover-curso__detalle">
                        <i class='bx bx-book-bookmark'></i> Profesor: <span><a href="/profesor/view/<?=$course->id_teacher?>"><?=$course->teacher?></a></span>
                    </div>
                </div>

                <div class="cover-curso__description">
                    <?=$course->description?>
                </div>

                <div class="cover-curso__cont-precio">
                    <?php if($course->discount && date('Y-m-d') <= $course->discount_ends_date &&  date('H:i:s') <= $course->discount_ends_time): ?>
                            <p class="cover-curso__precio cover-curso__precio--original">$ <?=$course->price?> USD</p>
                            <p class="cover-curso__precio cover-curso__precio--oferta">$ <?= $course->price * (1 - ($course->discount/100))?> USD</p>
                        <?php else: ?>
                            <p class="cover-curso__precio cover-curso__precio--normal">$ <?=$course->price?> USD</p>
                    <?php endif;?>
                </div>

                <?php if(!$cursoInscrito):?>
                    <div class="cover-curso__botones">
                        <a href="/curso/checkout/<?=$course->url?>" class="cover-curso__boton cover-curso__boton--comprar">Comprar ahora</a>
                    </div>
                <?php else:?>
                    <div class="cover-curso__botones">
                        <a href="/curso/watch/<?=$enroll_url?>" class="cover-curso__boton cover-curso__boton--comprar">Continuar curso</a>
                    </div>
                <?php endif;?>

            </div>

        </div>
    </div>

    <div class="detalles-curso">
        <div class="detalles-curso__top">
            <div class="detalles-curso__tabs">
                <button data-step="1" class="btn_tab detalles-curso__tab detalles-curso__tab--active">Contenido</button>
                <button data-step="2" class="btn_tab detalles-curso__tab">Instructor</button>
                <button data-step="3" class="btn_tab detalles-curso__tab">FAQ</button>
            </div>
        </div>

        <div class="detalles-cursos__tab-cont">

            <div id="step-1" class="detalles-curso__content detalles-curso__content--active">
                <?php if(!empty($modules)):?>
                    <?php foreach($modules as $key=>$module): ?>
                        <details class="acordeon__modulo width-70">
                            <summary class="module__header">
                                <span>Módulo <?=$key + 1?> - <?=$module['name']?></span>
                                <i class='bx bx-chevron-down'></i>
                            </summary>

                            <div class="acordeon__contenido">
                                <?php if(!empty($module['lessons'])):?>
                                    <ul>
                                        <?php foreach($module['lessons'] as $lesson):?>
                                            <li><?=$lesson ?></li>
                                        <?php endforeach;?>
                                    </ul>
                                <?php else:?>
                                    <ul>
                                        <li>Sin clases registradas</li>
                                    </ul>
                                <?php endif;?>

                            </div>
                        </details>
                    <?php endforeach;?>
                <?php else:?>
                    <p class="acordeon__vacio">No hay contenido disponible</p>
                <?php endif;?>
            </div>

            <div id="step-2" class="detalles-curso__content">

                <div class="detalle-profesor width-70">
                    
                    <img class="detalle-profesor__foto" src="/assets/teachers/<?=$teacher->photo?>" alt="<?=$teacher->photo?>">

                    <div>
                        
                        <div class="detalle-profesor__name">
                            <?=$teacher->name?>
                            <div class="detalle-profesor__speciality"><?=$teacher->speciality?></div>
                        </div>

                        <div class="detalle-profesor__experience">
                            <?=$teacher->experience?> años de <span>experiencia</span>
                        </div>

                        <div class="detalle-profesor__bio">
                            <?=$teacher->bio?>
                        </div>

                        <a class="detalle-profesor__btn" href="/profesor/view/<?=$course->id_teacher?>?#cursos-profesor">Mis cursos</a>

                    </div>
                </div>
            </div>

            <div id="step-3" class="detalles-curso__content">

                <?php if(!is_null($faq)):?>
                    <?php foreach($faq as $index=>$question):?>
                        <details class="acordeon__modulo width-70">
                            <summary class="module__header">
                                <span>Pregunta #<?=($index + 1).' - '.$question->question?></span>
                                <i class='bx bx-chevron-down'></i>
                            </summary>

                            <div class="acordeon__contenido">
                                <ul>
                                    <li><?=$question->answer?></li>
                                </ul>
                            </div>
                        </details>
                    <?php endforeach;?>
                <?php else:?>
                    <p class="acordeon__vacio">No hay preguntas disponibles</p>
                <?php endif;?>
                
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__.'/../components/footer.php';?>

<?php 
    $scripts ='
        <script src="/assets/js/listaPlegable.js"></script>
        <script src="/assets/js/tabs.js"></script>
        <script src="/assets/js/menu.js"></script>
    ';
?>