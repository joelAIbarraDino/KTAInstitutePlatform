<?php 

    $topScripts = '
        <link rel="preload" href="https://cdn.plyr.io/3.7.8/plyr.css" as="style"> 
        <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    ';
?>

<?php include_once __DIR__.'/../../components/estudentToolbar.php'; ?>

<main class="quiz-attempts">
    <a href="/curso/watch/<?=$url?>" class="quiz-attempts__return"><i class='bx bx-left-arrow-alt'></i> Regresar</a>
    
    <div class="quiz-attempts__container">

        <div class="quiz-info">
            <div class="quiz-info__container">
                <h1 class="quiz-info__name"><?=$quiz->name?></h1>

                <div class="quiz-info__container-info">
                    <p class="quiz-info__label-info">Calificación minima:</p>
                    <p class="quiz-info__label-data"><?=$quiz->min_score?>%</p>
                </div>

                <div class="quiz-info__container-info">
                    <p class="quiz-info__label-info">Intentos para pasar:</p>
                    <p class="quiz-info__label-data"><?=$quiz->max_attempts?></p>
                </div>

                <div class="quiz-info__container-info">
                    <p class="quiz-info__label-info">Tiempo para terminar(minutos):</p>
                    <p class="quiz-info__label-data"><?=$quiz->max_time?></p>
                </div>

                <div class="quiz-info__container-info">
                    <p class="quiz-info__label-info">Modo de avanzar preguntas:</p>
                    <p class="quiz-info__label-data"><?=$quiz->quiz_mode?></p>
                </div>

                <div class="quiz-info__container-info">
                    <p class="quiz-info__label-info">Puedo ver las respuestas despues de responer:</p>
                    <p class="quiz-info__label-data"><?=$quiz->show_answers=='ocultar'?'No':'Si' ?></p>
                </div>
            </div>

            <button class="quiz-info__attempt-btn" id="new-attempt">Tomar quiz</button>

            <div class="attempts"></div>
        </div>    
    
        <div class="messages">

            <div class="video-container active">
                    <h3 class="video-container__title">¿Como realizar el examen?</h3>

                    <div id="player">
                        <iframe
                            src="https://player.vimeo.com/video/<?=$quiz->tutorial_id?>"
                            allowfullscreen
                            allowtransparency
                            allow="autoplay"
                        ></iframe>
                    </div>
            </div>
            
            <div id="result-container" class="results-container">
                <div class="results-container__close">
                    <button id="result-container__close" class="results-container__close-btn">Cerrar <i class='bx bxs-x-circle'></i></button>
                </div>
                <div id="result-container__answers"></div>
            </div>

        </div>
    </div>
    
</main>

<script>
    let player = new Plyr('#player');
</script>


<?php 

    $createAttemptVersion = filemtime('assets/js/createAttempt.js');

    $scripts ='
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script src="/assets/js/createAttempt.js?v='.$createAttemptVersion.'"></script>
    ';
?>
