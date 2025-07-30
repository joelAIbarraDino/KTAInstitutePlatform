<?php 

    $topScripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <link rel="preload" href="https://cdn.plyr.io/3.7.8/plyr.css" as="style"> 
        <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    ';
?>

<?php include_once __DIR__.'/../../components/estudentToolbar.php'; ?>

<main class="main-class">

    <div id="class" class="class class-dark-mode">

        <div class="class__content">

            <div class="class__controls">
                <div class="class__controls-left">
                    <a class="class__exit" href="/mis-cursos"><i class='bx bx-arrow-back' ></i> Volver</a>
                </div>
                
                <div class="class__controls-right">
                    <button class="class__next-btn"><i class='bx bx-skip-previous' ></i></button>
                    <button class="class__next-btn"><i class='bx bx-skip-next'></i></button>
                </div>
            </div>

            <div class="class__info-container">
                <div class="class__name-container">
                    <div class="class__module"></div>
                    <h1 class="class__name"></h1>
                </div>
            </div>

            <div id="player"  data-plyr-provider="vimeo" data-plyr-embed-id=""></div>

            <div class="class__tabs">
                <button class="class__tab class__tab--active" data-step="1">Descripción</button>
                <button class="class__tab" data-step="2">Material</button>
            </div>

            <div class="class__extras">
                
                <div id="step-1" class="class__extra class__extra--active">
                    <div class="description" id="description"></div>
                </div>

                <div id="step-2" class="class__extra">
                    <div id="material-conteiner" class="material">

                        <!-- <div href="#" class="material__element">
                            <div class="material__name">
                                <i class='bx bxs-file-blank'></i>
                                Nombre de material
                            </div>

                            <button class="material__download" data-id="10">
                                Descargar
                                <i class='bx bx-download' ></i>
                            </button>
                        </div>

                        <div href="#" class="material__element">
                            <div class="material__name">
                                <i class='bx bxs-file-blank'></i>
                                Nombre de material
                            </div>

                            <button class="material__download" data-id="10">
                                Descargar
                                <i class='bx bx-download' ></i>
                            </button>
                        </div>

                        <div href="#" class="material__element">
                            <div class="material__name">
                                <i class='bx bxs-file-blank'></i>
                                Nombre de material
                            </div>

                            <button class="material__download" data-id="10">
                                Descargar
                                <i class='bx bx-download' ></i>
                            </button>
                        </div> -->

                    </div>
                </div>

            </div>

        </div>

    </div>

    <aside id="aside" class="aside aside-dark-mode">
        <button id="aside__btn-close" class="aside__btn-close"><i class='bx bx-last-page'></i></button>
        
        <div id="aside__content" class="aside__content">
        
            <div class="aside__content-header">
                <h3 class="aside__title" >Contenido de curso</h3>

                <div id="night-mode-btn" class="aside__night-mode dark-mode">
                    <i id="night-mode-icon" class='bx bx-moon' ></i>
                </div>
            </div>    

            <div class="aside__modules">
                
            </div>
        </div>
    </aside>


</main>

<?php

    $coursePlayVersion = filemtime('assets/js/coursePlay.js');

    $scripts ='
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script src="/assets/js/coursePlay.js?v='.$coursePlayVersion.'"></script>
    ';
?>
