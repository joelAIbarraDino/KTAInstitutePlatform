<?php include_once __DIR__.'/../components/header.php';?>

<div class="">
    <div class="cover-curso" style="background-image: url(/assets/thumbnails/<?=$course->thumbnail?>);">
        <div class="cover-curso__cover">

            <div class="cover-curso__datos">
                
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
                            <i class='bx bxs-graduation'></i> 0 <span>estudiantes</span>
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
                    <?php if($course->discount): ?>
                            <p class="cover-curso__precio cover-curso__precio--original">$ <?=$course->price?> USD</p>
                            <p class="cover-curso__precio cover-curso__precio--oferta">$ <?= $course->price * (1 - ($course->discount/100))?> USD</p>
                        <?php else: ?>
                            <p class="cover-curso__precio cover-curso__precio--normal">$ <?=$course->price?> USD</p>
                    <?php endif;?>
                </div>

                <div class="cover-curso__botones">
                    <a href="/curso/payment/<?=$course->url?>" class="cover-curso__boton cover-curso__boton--comprar">Comprar ahora</a>
                </div>

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
                <?php for($i = 0; $i < 5; $i++): ?>
                    <details class="acordeon__modulo width-70">
                        <summary>
                            <span>Módulo <?=$i + 1?></span>
                            <i class='bx bx-chevron-down'></i>
                        </summary>

                        <div class="acordeon__contenido">
                            <ul>
                                <li>Clase 1 - Bienvenida</li>
                                <li>Clase 2 - Primeros trabajos</li>
                                <li>Clase 3 - Minicasos</li>
                            </ul>
                        </div>
                    </details>
                <?php endfor;?>
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

                <?php if(!empty($faq)):?>
                    <?php foreach($faq as $index=>$question):?>
                        <details class="acordeon__modulo width-70">
                            <summary>
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

</div>

<?php include_once __DIR__.'/../components/footer.php';?>

<?php 
    $scripts ='
        <script src="/assets/js/listaPlegable.js"></script>
        <script src="/assets/js/tabs.js"></script>
    ';
?>