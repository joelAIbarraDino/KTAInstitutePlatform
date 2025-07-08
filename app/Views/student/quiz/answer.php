

<main class="quiz-container">
    <div class="quiz-content">
        <h1 class="quiz-title" id="quiz-title">Cargando quiz...</h1>
        
        <div class="time-container">
            <div class="time-display">
                <div class="time-card">
                    <div class="time" id="minutes-remaining">00</div>
                    <span>Minutos</span>
                </div>
                
                <div class="time-separator"></div>

                <div class="time-card">
                    <div class="time" id="seconds-remaining">00</div>
                    <span>Segundos</span>
                </div>
            </div>
            <div class="time-progress">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
        </div>
        
        <div class="quiz-card" id="quiz-card">
            <div class="question-container">
                <div class="question-header">
                    <h2 class="question-text" id="question-text">Cargando pregunta...</h2>
                </div>
                
                <div class="options-container" id="options-container"></div>
                
                <div class="question-footer">
                    <span class="question-counter" id="question-counter">Pregunta 0 de 0</span>
                </div>
            </div>
            
            <div class="navigation-buttons">
                <button class="btn btn-next" id="btn-previous" disabled>
                    <i class="bx bx-chevron-left"></i> Anterior
                </button>
                <button class="btn btn-next" id="btn-next" disabled>
                    Siguiente <i class="bx bx-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="submit-section">
            <button class="btn btn-cancel" id="btn-cancel">
                <i class="bx bx-x"></i> Cancelar intento
            </button>
            <button class="btn btn-submit" id="btn-submit" disabled>
                <i class="bx bx-check"></i> Enviar respuestas
            </button>
        </div>
        
        <div class="connection-status" id="connection-status">
            <i class="bx bx-wifi"></i> <span>Conectado - Respuestas se guardan localmente</span>
        </div>
</div>
</main>


<?php 

    $answerQuizVersion = filemtime('assets/js/answerQuiz.js');

    $scripts ='
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
        <script src="/assets/js/answerQuiz.js?v='.$answerQuizVersion.'"></script>
    ';
?>
