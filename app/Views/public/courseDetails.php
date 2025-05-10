<?php include_once __DIR__.'/../components/header.php';?>

<div>
    <div class="contenedor-curso" style="background-image: url(/assets/thumbnails/<?=$course->thumbnail?>);">
        <div class="contenedor-curso__cover">

            <div class="contenedor-curso__datos">
                <a class="contenedor-curso__regreso" href="/"><i class='bx bx-left-arrow-alt'></i> Regresar</a>
                <h2 class="contenedor-curso__name"><?=$course->name?></h2>
                <p class="contenedor-curso__lema"><?=$course->watchword?></p>

                <div class="contenedor-curso__detalles">
                    <div class="contenedor-curso__detalle">
                        <i class='bx bx-movie'></i> 0 <span>lecciones</span>
                    </div>

                    <div class="contenedor-curso__detalle">
                    <i class='bx bxs-graduation'></i> 0 <span>estudiantes</span>
                    </div>

                    <div class="contenedor-curso__detalle">
                        <i class='bx bx-book-bookmark'></i> Profesor: <span><a href="/profesor/watch/<?=$course->id_teacher?>"><?=$course->teacher?></a></span>
                    </div>
                </div>

                <div class="contenedor-curso__description">
                    <?=$course->description?>
                </div>

            </div>

        </div>
    </div>

</div>

<?php include_once __DIR__.'/../components/footer.php';?>

<?php 
    $scripts ='
        <script src="/assets/js/listaPlegable.js"></script>
    ';
?>