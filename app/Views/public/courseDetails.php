<?php include_once __DIR__.'/../components/header.php';?>

<div class="principal">
    <div class="cover-curso" style="background-image: url(/assets/thumbnails/<?=$course->thumbnail?>);">
        <div class="cover-curso__cover">

            <div class="cover-curso__datos">
                
                <div class="cover-curso__cont-regreso">
                    <a class="cover-curso__regreso" href="/">&laquo Regresar</a>
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

                    <div class="cover-curso__detalle">
                        <i class='bx bxs-graduation'></i> 0 <span>estudiantes</span>
                    </div>

                    <div class="cover-curso__detalle">
                        <i class='bx bx-book-bookmark'></i> Profesor: <span><a href="/profesor/watch/<?=$course->id_teacher?>"><?=$course->teacher?></a></span>
                    </div>
                </div>

                <div class="cover-curso__description">
                    <?=$course->description?>
                </div>

                <div class="cover-curso__botones">
                    <button class="cover-curso__boton cover-curso__boton--agregar">Agregar al carrito</button>
                    <button class="cover-curso__boton cover-curso__boton--comprar">Comprar ahora</button>
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

                <div class="detalle-profesor width-80">
                    
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

                    </div>
                </div>
            </div>

            <div id="step-3" class="detalles-curso__content">
                <?php for($i = 0; $i < 5; $i++): ?>
                    <details class="acordeon__modulo width-70">
                        <summary>
                            <span>Pregunta <?=$i + 1?></span>
                            <i class='bx bx-chevron-down'></i>
                        </summary>

                        <div class="acordeon__contenido">
                            <ul>
                                <li>Respuesta a pregunta <?=$i + 1?></li>
                            </ul>
                        </div>
                    </details>
                <?php endfor;?>
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