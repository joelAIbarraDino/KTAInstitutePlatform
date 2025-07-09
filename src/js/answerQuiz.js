(function(){

    document.addEventListener('DOMContentLoaded', function() {
        // Elementos del DOM
        const quizTitle = document.getElementById('quiz-title');
        const hourRemaining = document.getElementById('hours-remaining');
        const minuteRemaining = document.getElementById('minutes-remaining');
        const secondsRemaining = document.getElementById('seconds-remaining');
        const progressBar = document.getElementById('progress-bar');
        const questionText = document.getElementById('question-text');
        const optionsContainer = document.getElementById('options-container');
        const questionCounter = document.getElementById('question-counter');
        const btnPrevious = document.getElementById('btn-previous');
        const btnNext = document.getElementById('btn-next');
        const btnSubmit = document.getElementById('btn-submit');
        const btnCancel = document.getElementById('btn-cancel');
        const connectionStatus = document.getElementById('connection-status');
        
        // Variables de estado
        let quizData = null;
        let currentQuestionIndex = 0;
        let userAnswers = {};
        let timer = null;
        let timeLeft = 0;
        let maxTime = 0;
        let idAttempt = null;
        let uuid = null;
        let lastOnlineTime = null;
        let offlineTimer = null;
        let answeredPercentage = null;
        let totalQuestions = 0;
        let answeredQuestions = 0;
        const OFFLINE_LIMIT = 5 * 60 * 1000; // 5 minutos en milisegundos
        
        // Obtener parámetros de la URL
        function getUrlParams() {
            const pathParts = window.location.pathname.split('/');
            uuid = pathParts[pathParts.length - 2];
            idAttempt = pathParts[pathParts.length - 1];
        }
        
        // Verificar conexión a internet
        function checkConnection() {
        if (navigator.onLine) {
            connectionStatus.innerHTML = '<i class="bx bx-wifi"></i> <span>Conectado</span>';
            connectionStatus.classList.remove('offline');
            lastOnlineTime = null;
            clearTimeout(offlineTimer);
        } else {
            connectionStatus.innerHTML = '<i class="bx bx-wifi-off"></i> <span>Sin conexión</span>';
            connectionStatus.classList.add('offline');
            
            if (!lastOnlineTime) {
                lastOnlineTime = Date.now();
                offlineTimer = setTimeout(() => {
                    cancelAttempt();
                }, OFFLINE_LIMIT);
            }
        }
    }
        
        // Cargar datos del quiz desde la API
        async function loadQuizData() {
            try {
                // Primero verificar si hay datos en localStorage
                const savedData = localStorage.getItem(`quizAttempt_${idAttempt}`);
                
                if (savedData) {
                    const parsed = JSON.parse(savedData);
                    quizData = parsed.quizData;
                    userAnswers = parsed.userAnswers ?? {};
                    currentQuestionIndex = parsed.currentQuestionIndex ?? 0;
                    timeLeft = parsed.timeLeft ?? quizData.quiz.max_time * 60;

                    // Cargar datos frescos del servidor pero mantener el tiempo local
                    const response = await fetch(`/api/quiz/attempt/${idAttempt}`);
                    if (response.ok) {
                        const freshData = await response.json();
                        quizData = freshData; // Actualizar datos pero mantener el tiempo
                    }
                    
                    initializeQuiz();
                } else {
                    // Cargar datos nuevos si no hay en localStorage
                    const response = await fetch(`/api/quiz/attempt/${idAttempt}`);
                    if (!response.ok) throw new Error('Error al cargar el quiz');
                    
                    quizData = await response.json();
                    timeLeft = quizData.quiz.max_time * 60;
                    initializeQuiz();
                }
            } catch (error) {
                Swal.fire({
                    title: '¡Error al cargar quiz!',
                    text: 'Hay un error con la configuración del quiz, por favor de contactar con KTA para alertar de este error',
                    icon: 'error',
                    confirmButtonText: 'Entendido'
                });

                window.location.href = `/quiz/attempts/${uuid}`;
                
            }
        }
        
        // Inicializar el quiz
        function initializeQuiz() {

            //inicializar variables para saber el progreso del examen
            totalQuestions = quizData.questions.length;
            answeredQuestions = Object.keys(userAnswers).length;
            
            // Configurar título
            quizTitle.textContent = quizData.quiz.name;
            
            // Configurar tiempo
            maxTime = quizData.quiz.max_time * 60; // Convertir a segundos
            timeLeft = timeLeft == 0?maxTime:timeLeft;
            updateTimerDisplay();
            
            // Iniciar temporizador
            timer = setInterval(updateTimer, 1000);
            
            // Cargar respuestas guardadas localmente si existen
            const savedAnswers = localStorage.getItem(`quizAttempt_${idAttempt}`);
            if (savedAnswers) {
                const parsed = JSON.parse(savedAnswers);
                if (parsed.userAnswers) {
                    userAnswers = parsed.userAnswers;
                }
            }
            
            // Mostrar primera pregunta
            showQuestion(currentQuestionIndex);
            
            // Configurar eventos
            btnPrevious.addEventListener('click', goToPreviousQuestion);
            btnNext.addEventListener('click', goToNextQuestion);
            btnSubmit.addEventListener('click', submitQuiz);
            btnCancel.addEventListener('click', confirmCancelAttempt);
            
            // Verificar conexión inicial
            checkConnection();
            window.addEventListener('online', checkConnection);
            window.addEventListener('offline', checkConnection);
            
            // Guardar datos en localStorage periódicamente
            setInterval(saveToLocalStorage, 2500); // Cada 5 segundos
        }
        
        // Actualizar el temporizador
        function updateTimer() {
            timeLeft--;
            updateTimerDisplay();
            
            if (timeLeft <= 0) {
                clearInterval(timer);
                timeExpired();
            } else if (timeLeft <= 600) { // 10 minutos = 600 segundos
                document.querySelector('.time-container').classList.add('time-critical');
            }
        }
        
        // Actualizar visualización del temporizador
        function updateTimerDisplay() {
            const hours = Math.floor(timeLeft / 3600);
            const minutes = Math.floor(timeLeft % 3600 / 60);
            const seconds = timeLeft % 60;

            hourRemaining.textContent = hours.toString().padStart(2, '0');
            minuteRemaining.textContent = minutes.toString().padStart(2, '0');
            secondsRemaining.textContent = seconds.toString().padStart(2, '0');
        
            const progressPercentage = (timeLeft / maxTime) * 100;
            progressBar.style.width = `${progressPercentage}%`;
        }
        
        // Mostrar pregunta
        function showQuestion(index) {
            const question = quizData.questions[index];
            questionText.textContent = question.question;
            
            // Actualizar contador de preguntas
            questionCounter.textContent = `Pregunta ${index + 1} de ${quizData.questions.length}`;
            
            // Mostrar opciones según el tipo de pregunta
            optionsContainer.innerHTML = '';
            
            if (question.type_question === 'multiple') {
                question.answers.forEach((option, i) => {
                    const optionId = `option-${option.id_option}`;
                    const optionElement = document.createElement('div');
                    optionElement.className = 'option-item';
                    
                    const input = document.createElement('input');
                    input.type = 'radio';
                    input.name = 'question-option';
                    input.id = optionId;
                    input.value = option.id_option;
                    
                    // Verificar si esta opción ya fue seleccionada
                    if (userAnswers[question.id_question] && userAnswers[question.id_question].includes(option.id_option)) {
                        input.checked = true;
                    }
                    
                    const label = document.createElement('label');
                    label.htmlFor = optionId;
                    label.textContent = option.text_option;
                    
                    optionElement.appendChild(input);
                    optionElement.appendChild(label);
                    optionsContainer.appendChild(optionElement);
                    
                    // Agregar evento para guardar la respuesta al seleccionar
                    input.addEventListener('change', () => {
                        saveAnswer(question.id_question, option.id_option);
                    });
                });
            } else { // Pregunta abierta
                const textarea = document.createElement('textarea');
                textarea.className = 'open-answer';
                textarea.placeholder = 'Escribe tu respuesta aquí...';
                
                // Cargar respuesta guardada si existe
                if (userAnswers[question.id_question] && userAnswers[question.id_question].text) {
                    textarea.value = userAnswers[question.id_question].text;
                }
                
                textarea.addEventListener('input', () => {
                    saveAnswer(question.id_question, null, textarea.value);
                });
                
                optionsContainer.appendChild(textarea);
            }
            
            //actualizo avance de examen
            answeredQuestions = Object.keys(userAnswers).length;
            answeredPercentage = (answeredQuestions / totalQuestions) * 100;

            console.log(answeredPercentage);
            // Actualizar botones de navegación
            btnPrevious.disabled = index === 0;
            btnNext.disabled = index === quizData.questions.length - 1;
            
            // Mostrar botón de enviar si es la última pregunta
            if (index === quizData.questions.length - 1)
                btnSubmit.disabled = false;

            if(answeredPercentage > 50){
                btnCancel.disabled = true;
                btnCancel.style.opacity = 0;
            }

            console.log(btnCancel.disabled)

        }
        
        // Guardar respuesta del usuario
        function saveAnswer(questionId, optionId, text = null) {
            if (text) {
                userAnswers[questionId] = { text };
            } else {
                // Para preguntas múltiples, guardar array de opciones seleccionadas
                if (!userAnswers[questionId]) {
                    userAnswers[questionId] = [];
                }
                
                // Verificar si la opción ya está seleccionada
                const index = userAnswers[questionId].indexOf(optionId);
                if (index === -1) {
                    userAnswers[questionId] = [optionId]; // Solo permitir una respuesta
                } else {
                    userAnswers[questionId].splice(index, 1);
                }
            }
            
            saveToLocalStorage();
        }
        
        // Ir a la pregunta anterior
        function goToPreviousQuestion() {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                showQuestion(currentQuestionIndex);
            }
        }
        
        // Ir a la siguiente pregunta
        function goToNextQuestion() {
            if (currentQuestionIndex < quizData.questions.length - 1) {
                currentQuestionIndex++;
                showQuestion(currentQuestionIndex);
            }
        }
        
        // Guardar datos en localStorage
        function saveToLocalStorage() {
            const dataToSave = {
                quizData,
                userAnswers,
                currentQuestionIndex,
                timeLeft
            };
            
            localStorage.setItem(`quizAttempt_${idAttempt}`, JSON.stringify(dataToSave));
        }
            
        // Tiempo expirado
        function timeExpired() {
            Swal.fire({
                title: '¡Tiempo terminado!',
                text: 'El tiempo para completar el quiz ha finalizado. Se enviarán las respuestas que hayas contestado.',
                icon: 'warning',
                confirmButtonText: 'Entendido'
            }).then(() => {
                submitQuiz();
            });
        }
        
        // Confirmar cancelación de intento
        function confirmCancelAttempt() {
            // Calcular el porcentaje de preguntas respondidas
            answeredPercentage = (answeredQuestions / totalQuestions) * 100;

            // Si ha respondido más del 50%, no permitir cancelar
            if (answeredPercentage > 50) {
                Swal.fire({
                    title: 'No puedes cancelar ahora',
                    text: 'Has respondido más del 50% del quiz. Debes completarlo o esperar a que el tiempo termine.',
                    icon: 'warning',
                    confirmButtonText: 'Entendido'
                });
                return;
            }

            // Si ha respondido menos del 50%, mostrar confirmación normal
            Swal.fire({
                title: '¿Cancelar intento?',
                text: '¿Estás seguro de que deseas cancelar este intento? No podrás volver a esta página.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'No, continuar'
            }).then((result) => {
                if (result.isConfirmed) {
                    cancelAttempt();
                }
            });
        }
        
        // Cancelar intento
        async function cancelAttempt() {
            try {
                if(!navigator.onLine)
                    return;

                const request = await fetch(`/api/attempt/cancel/${idAttempt}`, {
                        method: 'DELETE'
                });

                if(!request.ok)
                    return;
                
                // Limpiar localStorage y redirigir
                localStorage.removeItem(`quizAttempt_${idAttempt}`);
                window.location.href = `/quiz/attempts/${uuid}`;
            } catch (error) {
                console.log(error);
            }
        }
        
        // Enviar quiz
        async function submitQuiz() {
            clearInterval(timer);

            if(!navigator.onLine){
                saveToLocalStorage();
                Swal.fire({
                    title: '¡Conexión inestable!',
                    text: 'Mantenga la ventana abierta para enviar sus respuestas cuanto vuelva a tener internet',
                    icon: 'warning',
                    confirmButtonText: 'Entendido'
                });                
                return;
            }
                   
            try {

                const request = await fetch(`/api/answer_student/${idAttempt}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        answers: userAnswers,
                        timeUsed: maxTime - timeLeft
                    })
                });

                const response = await request.json();
                
                if (!response.ok){
                    Swal.fire({
                        title: 'Error al guardar',
                        text: 'Ha ocurrido un error al enviar las respuestas',
                        icon: 'error',
                        confirmButtonText: 'Entendido'
                    });
                    return;
                };

                //limpio memoria 
                localStorage.removeItem(`quizAttempt_${idAttempt}`);

                Swal.fire({
                    title: '¡Respuestas enviadas!',
                    text: 'Tus respuestas han sido guardadas correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Entendido'
                }).then(() => {

                    if(!response.openQuestions  && response.approved)
                        window.location.href = `/quiz/success/${idAttempt}`;
                    else if(!response.openQuestions && !response.approved)
                        window.location.href = `/quiz/failed`;
                    else
                        window.location.href = `/quiz/completed`;

                });
                
            } catch (error) {
                console.error('Error:', error);
            }
        }
        
        // Iniciar la aplicación
        getUrlParams();
        loadQuizData();
    });

})();