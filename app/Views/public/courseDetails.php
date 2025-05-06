<?php include_once __DIR__.'/../components/header.php';?>

<div class="principal">
    <section class="detalle-curso">
        <div class="container detalle-curso__grid">
            
            <!-- Izquierda -->
            <div class="detalle-curso__info">
                <h1 class="detalle-curso__nombre"><?=$course->name?></h1>
                <p class="detalle-curso__watchword"><?=$course->watchword?></p>
                
                <div class="detalle-curso__cont-metadata">
                    <p class="detalle-curso__metadata">
                        <i class='bx bxs-landmark'></i><?=$course->enrollment?> alumnos inscritos
                    </p>

                    <p class="detalle-curso__metadata">
                        <i class='bx bx-slideshow'></i><?=$course->enrollment?> clases
                    </p>

                    <a href="/maestro/view/<?=$course->id_teacher?>" class="detalle-curso__metadata detalle-curso__metadata--link">
                        <i class='bx bx-glasses-alt' ></i></i><?=$course->teacher?>
                    </a>
                </div>
                
                <div class="detalle-curso__precio-cont">

                    <p class="detalle-curso__precio">$<?=$course->price?> USD</p>
    
                    <button class="detalle-curso__boton">
                        <i class='bx bx-cart'></i> Comprar ahora
                    </button>
                </div>

                <div class="detalle-curso__contenido">
                    <h2>Contenido de curso</h2>
                    
                    <?php for($i = 0; $i < 5; $i++): ?>
                        <details class="modulo">
                            <summary>
                                <span>Módulo <?=$i + 1?></span>
                                <i class='bx bx-chevron-down'></i>
                            </summary>

                            <div class="contenido">
                                <ul>
                                    <li>Clase 1 - Bienvenida</li>
                                    <li>Clase 2 - Primeros trabajos</li>
                                    <li>Clase 3 - Minicasos</li>
                                </ul>
                            </div>
                        </details>
                    <?php endfor;?>
                </div>
            </div>

            <!-- Derecha -->
            <div class="detalle-curso__media">

                <img class="detalle-curso__caratula" src="/assets/thumbnails/<?=$course->thumbnail?>" alt="caratula de video">

                <div class="detalle-curso__descripcion">
                    <h2>Descripción de curso</h2>
                    <div class="detalle-curso__descripcion-text"><?=$course->description?></div>
                </div>
            </div>
        </div>
    </section>

</div>

<?php include_once __DIR__.'/../components/footer.php';?>

<?php 
    $scripts ='
        <script src="/assets/js/listaPlegable.js"></script>
    ';
?>