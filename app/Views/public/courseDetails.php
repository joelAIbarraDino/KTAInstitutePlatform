<?php include_once __DIR__.'/../components/header.php';?>

<main>

    <div class="info-curso">
        <img class="info-curso__background" src="/assets/background-courses/<?=$course->background?>" alt="<?=$course->background?>">

        <div class="info-curso__cover">
            <a class="info-curso__return" href="javascript:history.back()" data-section="course-details" data-label="return"><i class='bx bx-left-arrow-alt'></i> Regresar</a>
            
            <div class="info-curso__type" data-section="course-details" data-label="type-content">
                <i class='bx bx-camera-movie'></i> <span>Contenido grabado</span>
            </div>
            
            <h1 class="info-curso__name" data-section="course-<?=$course->id_course?>" data-label="name"><?=$course->name?></h1>
            <p class="info-curso__lema" data-section="course-<?=$course->id_course?>" data-label="watchword"><?=$course->watchword?></p>

            <div class="info-curso__details">

                <div class="info-curso__detail">
                    <i class='bx bx-calendar'></i> <?=$course->max_months_enroll?> <span data-section="course-details" data-label="access-content">Meses de acceso a material</span>
                </div>

                <?php if($course->enrollment >2): ?>
                    <div class="info-curso__detail">
                        <i class='bx bxs-graduation'></i> <?=$course->enrollment?> <span data-section="course-details" data-label="students">estudiantes</span>
                    </div>
                <?php endif;?>

                <div class="info-curso__detail">
                    <i class='bx bx-book-bookmark'></i> <div data-section="course-details" data-label="teacher">Profesor:</div> <span><a href="/profesor/view/<?=$course->id_teacher?>"><?=$course->teacher?></a></span>
                </div>

            </div>

            <div class="info-curso__description" data-section="course-<?=$course->id_course?>" data-label="description">
                <?=$course->description ?>
            </div>

            <div class="info-curso__price-container">
                <?php if($course->discount && date('Y-m-d') <= $course->discount_ends_date &&  date('H:i:s') <= $course->discount_ends_time): ?>
                        <p class="info-curso__price info-curso__price--original">$ <?=$course->price?> USD</p>
                        <p class="info-curso__price info-curso__price--oferta">$ <?= $course->price * (1 - ($course->discount/100))?> USD</p>
                <?php else: ?>
                        <p class="info-curso__price info-curso__price--normal">$ <?=$course->price?> USD</p>
                <?php endif;?>
            </div>

            <?php if(!$cursoInscrito):?>
                <a href="/curso/checkout/<?=$course->url?>" class="info-curso__button" data-section="course-details" data-label="checkout">Comprar ahora</a>
            <?php else:?>
                <a href="/curso/watch/<?=$enroll_url?>" class="info-curso__button" data-section="course-details" data-label="continue">Continuar curso</a>
            <?php endif;?>

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

    $menuVersion = filemtime('assets/js/menu.js');
    $scripts ='
        <script src="/assets/js/listaPlegable.js"></script>
        <script src="/assets/js/tabs.js"></script>
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
    ';
?>