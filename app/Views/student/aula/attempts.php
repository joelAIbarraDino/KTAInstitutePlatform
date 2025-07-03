<?php include_once __DIR__.'/../../components/estudentToolbar.php'; ?>

<main class="quiz-attempts">
    <a href="/curso/watch/<?=$url?>" class="quiz-attempts__return"><i class='bx bx-left-arrow-alt'></i> Regresar</a>
    
    <div class="quiz-attempts__container">
        <div class="quiz-info">
            <div class="quiz-info__container">
                <h1 class="quiz-info__name"><?=$quiz->name?></h1>
                <p class="quiz-info__info">Calificación minima: <span><?=$quiz->min_score?>%</span></p>
                <p class="quiz-info__info">Intentos para pasar: <span><?=$quiz->max_attempts?> intentos</span></p>
                <p class="quiz-info__info">Tiempo para terminar: <span><?=$quiz->max_time?> minutos</span></p>
            </div>

            <button class="quiz-info__attempt-btn" id="new-attempt">Tomar quiz</button>
        </div>    
    
        <div class="attempts">

            <?php if(!empty($attempts)):?>
                <?php foreach($attempts as $key=>$attempt):?>      
                    
                    <div class="attempt">
                        <div class="attempt__header">
                            <h2 class="attempt__title">Intento # <?=$key + 1?></h2>
                        </div>

                        <p class="attempt__info">Tiempo: <span><?=$attempt->time?></span></p>
                        <p class="attempt__info">Score: <span><?=$attempt->score?>%</span></p>

                        <?php if($attempt->is_approved):?>
                            <p class="attempt__info attempt__info--aprobado">Status: <span>aprobado</span></p>
                        <?php else:?>
                                <p class="attempt__info attempt__info--reprobado">Status: <span>Pendiente revisión</span></p>
                        <?php endif;?>

                    </div>
                <?php endforeach;?>

            <?php else:?>
                <p class="attempt__empty">Sin intentos registrados</p>
            <?php endif;?>
            
        </div>
    </div>
    
</main>

<?php 
    $scripts ='
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script src="/assets/js/createAttempt.js"></script>
    ';
?>
