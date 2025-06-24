<?php include_once __DIR__.'/../components/estudentToolbar.php'; ?>

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
                    <div class="class__module"> <span>Módulo 1</span> Introducción</div>
                    <h1 class="class__name">Nombre de clase</h1>
                </div>
            </div>


            <div id="player" data-plyr-provider="vimeo" data-plyr-embed-id="692146609"></div>

            <div class="class__tabs">
                <button class="class__tab class__tab--active" data-step="1">Descripción</button>
                <button class="class__tab" data-step="2">Material</button>
            </div>

            <div class="class__extras">
                
                <div id="step-1" class="class__extra class__extra--active">
                    <div class="description" id="description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsa, dolor placeat? Ad fugit suscipit quo vitae magnam itaque molestiae eos nihil pariatur, laborum molestias culpa sunt repellendus officiis commodi incidunt. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint at possimus placeat dignissimos, vero tenetur earum blanditiis, sapiente consectetur amet labore expedita nesciunt error neque eaque aperiam ut praesentium dolorum. Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi quo suscipit rem, perspiciatis iure ea sit blanditiis. Quia qui accusantium exercitationem consequuntur minus. Consectetur dolore, voluptatum repellendus fuga numquam necessitatibus.</div>
                </div>

                <div id="step-2" class="class__extra">
                    <div id="material-conteiner" class="material">

                        <div href="#" class="material__element">
                            <div class="material__name">
                                <i class='bx bxs-file-blank'></i>
                                Nombre de material
                            </div>

                            <button class="material__download" data-id="10">
                                Descargar
                                <i class='bx bx-download' ></i>
                            </dbuttoniv>
                        </div>

                        <div href="#" class="material__element">
                            <div class="material__name">
                                <i class='bx bxs-file-blank'></i>
                                Nombre de material
                            </div>

                            <button class="material__download" data-id="10">
                                Descargar
                                <i class='bx bx-download' ></i>
                            </dbuttoniv>
                        </div>

                        <div href="#" class="material__element">
                            <div class="material__name">
                                <i class='bx bxs-file-blank'></i>
                                Nombre de material
                            </div>

                            <button class="material__download" data-id="10">
                                Descargar
                                <i class='bx bx-download' ></i>
                            </dbuttoniv>
                        </div>

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
                <?php for($i = 0; $i < 20; $i++):?>
                    <details class="content-module">
                        <summary class="content-module__header">
                            <div class="content-module__title">
                                <span>Módulo <?=$i + 1?> - Bienvenida</span>
                                <div class="content-module__progress-container">
                                    <p class="content-module__progress-percentage" >20%</p>
                                    <progress class="content-module__progress-bar" max="100" value="20"></progress>
                                </div>
                            </div>

                            <i class='bx bx-chevron-down'></i>
                        </summary>

                        <div class="content-module__lessons">
                            <?php for($y = 0; $y < 10; $y++):?>
                                <div class="content-module__lesson">
                                    <p class="content-module__lesson-name">Clase <?= $y +1 ?></p>
                                    <button class="content-module__lesson-checked">
                                        <i class='bx bx-check-circle' ></i>
                                    </button>
                                </div>
                            <?php endfor;?>
                        </div>
                    </details>
                <?php endfor;?>
            </div>
        </div>
    </aside>


</main>

<?php 
    $scripts ='
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script src="/assets/js/coursePlay.js"></script>
    ';
?>
