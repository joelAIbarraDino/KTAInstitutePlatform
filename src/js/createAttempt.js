(function(){

    const attemptBtn = document.querySelector('#new-attempt');
    const videoContainer = document.querySelector('.video-container');
    const messageContainer = document.querySelector('.results-container');
    const answersContainer = document.querySelector('#result-container__answers');
    const closeMessageContainer = document.querySelector('#result-container__close');

    let quiz = [];
    let attempts = [];

    window.addEventListener("DOMContentLoaded", ()=>{
        app();
    });

    function app(){
        createAttempt();
        getQuiz();
        closeMessageContainer.addEventListener('click', ()=>{
            videoContainer.classList.add('active');
            messageContainer.classList.remove('active');
        })
    }

    async function getQuiz(){
        try{
            
            const id = getCourseID();
            const url = `/api/quiz-uuid/${id}`;

            const request = await fetch(url);
            const response = await request.json();
            
            quiz = response.quiz;
            attempts = response.attempts;

            showAttempts();

        }catch(error){
            console.log(error);
        }
    }

    function createAttempt(){
        attemptBtn.addEventListener('click', ()=>{
            Swal.fire({
                title: quiz.quiz_mode=="libre"?'Iniciando quiz':'Iniciando quiz modo restingido',
                text: quiz.quiz_mode=="libre"?"¿Estas seguro de que quieres iniciar el quiz?":"El quiz en este modo no te permitira retroceder las preguntas",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: 'Todavia no',
                confirmButtonText: "Si, Empecemos"
            }).then((result) => {
                if (result.isConfirmed) 
                    newAtempt();
            });

        });
    }
    
    async function newAtempt(){
        try{
            const id = getCourseID();
            const url = `/attempts/create/${id}`;

            const request = await fetch(url, {
                method:'POST'
            })            

            const response = await request.json();

            if(!response.ok){
                Swal.fire({
                    title: "Error",
                    text: response.message,
                    icon: "error"
                })
                return;
            }

            window.location = `/quiz/answer/${id}/${response.id}`;

        }catch(error){
            console.log(error);
        }
    }

    function showAttempts(){
        const container = document.querySelector('.attempts');
        container.innerHTML = '';

        if(!attempts.length){
            const empty = document.createElement('p');
            empty.classList.add('attempt__empty');
            empty.textContent = 'Sin intentos registrados';
            container.appendChild(empty);
            return;
        }

        attempts.forEach((attempt, index) => {
            const attemptDiv = document.createElement('div');
            attemptDiv.classList.add('attempt');

            attemptDiv.innerHTML = `
                <div class="attempt__header">
                    <h2 class="attempt__title">Intento # ${index + 1}</h2>
                    <div class="attempt__status ${attempt.checked ? 'attempt__status--revisado' : 'attempt__status--pendiente'}">
                        ${attempt.checked ? 'Revisado' : 'Pendiente'}
                    </div>
                </div>

                <div class="quiz-info__container-info">
                    <p class="quiz-info__label-info-black">Tiempo:</p>
                    <p class="quiz-info__label-data">${(attempt.time * 60).toFixed(0)} min</p>
                </div>

                <div class="quiz-info__container-info quiz-info__container-info--gold">
                    <p class="quiz-info__label-info-black">Score:</p>
                    <p class="quiz-info__label-data">${attempt.score}%</p>
                </div>
                
                <div class="quiz-info__container-info">
                    <p class="quiz-info__label-info-black">Resultado:</p>
                    <p class="quiz-info__label-data ${attempt.is_approved ? 'quiz-info__label-data--aprobado' : 'quiz-info__label-data--no-aprobado'}">
                        ${attempt.is_approved ? 'Aprobado' : 'No aprobado'}
                    </p>
                </div>

                <div class="attempt__actions">
                    <button class="attempt__action attempt__action--answer" data-id="${attempt.id_attempt}">Ver respuestas</button>
                    <button class="attempt__action attempt__action--certificado" data-id="${attempt.id_attempt}">Descargar certificado</button>
                </div>
            `;

            const btnAnswer = attemptDiv.querySelector('.attempt__action--answer');
            const btnCert = attemptDiv.querySelector('.attempt__action--certificado');

            if(quiz.show_answers !== 'mostrar'){
                btnAnswer.style.display = 'none';
            }

            if(!attempt.is_approved){
                btnCert.style.display = 'none';
            }

            btnAnswer.addEventListener('click', ()=>{
                if(quiz.show_answers !== 'mostrar')
                    return;

                videoContainer.classList.remove("active");
                messageContainer.classList.add("active");

                const answersAttempt = attempts.find(attemptMemory=> attempt.id_attempt == attemptMemory.id_attempt);

                showAnswers(answersAttempt);

            });
            btnCert.addEventListener('click', ()=>{
                window.open(`/certificado/${attempt.id_attempt}`, '_blank');
            });

            container.appendChild(attemptDiv);
        });
    }

    function showAnswers(attempt){
        answersContainer.innerHTML = ''; // Limpia antes

        const wrapper = document.createElement('div');
        wrapper.classList.add('answers');

        const title = document.createElement('h2');
        title.classList.add('answers__title');
        title.textContent = `Respuestas del intento #${attempt.id_attempt}`;
        wrapper.appendChild(title);

        attempt.answersStudent.forEach(answer => {
            const answerDiv = document.createElement('div');
            answerDiv.classList.add('answer');

            answerDiv.innerHTML = `
                <div class="answer__question-container">
                    <p class="answer__question">${answer.question}</p>
                    <p class="answer__status ${answer.is_correct ? 'answer__status--correct' : 'answer__status--incorrect'}">
                        ${answer.is_correct ? 'Correcta' : 'Incorrecta'}
                    </p>
                </div>
                <p class="answer__user-answer">Tu respuesta: <span>${answer.answer}</span></p>
            `;

            wrapper.appendChild(answerDiv);
            document.body.scrollIntoView({ behavior: "smooth", block: "start" });
        });

        answersContainer.appendChild(wrapper);
        document.body.scrollIntoView({ behavior: "smooth", block: "start" });
    }

    function getCourseID(){
        const path = window.location.pathname;
        const parts = path.split('/');

        const ID = parts[parts.length -1];

        return ID;
    } 

})();