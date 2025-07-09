(function(){
    
    const btnExit = document.querySelector("#btn-exit");
    const attemptsContainer = document.querySelector("#attempts-container");
    const containerAlert = document.querySelector("#container-alert");


    let attempts = [];
    
    app();

    //funcion principal
    function app(){
        btnExitMessage();
        getQuiz();

    }

    async function getQuiz(){
        try {
            const id = getCourseID();
            const url = `/api/attempts/${id}`;

            const request = await fetch(url);
            const response = await request.json();
            
            attempts = response.attempts;

            showAttempts();

        } catch (error) {
            console.log(error);
        }
    }

    function showAttempts(openAttemptID = 0){

       //generando preguntas del examen 
        clearQuizContainer();

        if(attempts.length === 0)
            return;
        
        attempts.forEach(attempt =>{
            let newAttempt = createAttemptElement(attempt);
            initAccordion(newAttempt);
            attemptsContainer.appendChild(newAttempt);
            
            if(attempt.id_attempt == openAttemptID){
                openAcordion(newAttempt);
            }

        });
    }

    function createAttemptElement(attempt) {
        // Crear el contenedor <details>
        const details = document.createElement('details');
        details.classList.add('acordeon__modulo');
        details.dataset.id = `${attempt.id_attempt}`; 
        
        // Crear el <summary> (encabezado del acordeón)
        const summary = document.createElement('summary');
        summary.classList.add('module__header');

        const headerAttempt = document.createElement('div');
        headerAttempt.classList.add("module__header-attempt");

        const names = attempt.student.split(' ');

        const attemptName = document.createElement('p');
        attemptName.classList.add("module__header-attempt-id");
        attemptName.textContent = `Intento de ${names.slice(0, 2).join(' ')}`;

        const attemptScore = document.createElement('p');
        attemptScore.classList.add("module__header-attempt-score");
        attemptScore.innerHTML = `<span>Porcentaje:</span> ${attempt.score}%`;

        const attemptTime = document.createElement('p');
        attemptTime.classList.add("module__header-attempt-time");
        attemptTime.innerHTML = `<span>Resuelto en:</span> ${attempt.time} Minutos`;

        const dates = attempt.answered_at.split('-');

        const attemptDate = document.createElement('p');
        attemptDate.classList.add("module__header-attempt-time");
        attemptDate.innerHTML = `<span>Fecha de aplicación:</span> ${dates.slice(0, 3).join('/')}`;

        headerAttempt.appendChild(attemptName);
        headerAttempt.appendChild(attemptScore);
        headerAttempt.appendChild(attemptTime);
        headerAttempt.appendChild(attemptDate);

        // Parte derecha: acciones
        const actionsContainer = document.createElement('div');
        actionsContainer.classList.add('module__header-actions');

        const btnAttemptChecked = document.createElement('button');
        btnAttemptChecked.dataset.id = attempt.id_attempt;
        btnAttemptChecked.innerHTML = attempt.checked?'Revisado':'Pendiente';
        btnAttemptChecked.onclick = function(){
            attempt.checked = attempt.checked?0:1;
            changeAttempt(attempt)
        }

        if(attempt.checked)
            btnAttemptChecked.classList.add('module__btn', 'module__btn--correcto');
        else
            btnAttemptChecked.classList.add('module__btn', 'module__btn--pendiente');
        
        const btnAttemptApproved = document.createElement('button');
        btnAttemptApproved.dataset.id = attempt.id_attempt;
        btnAttemptApproved.innerHTML = attempt.is_approved?'Aprobado':'No aprobado';
        
        if(attempt.is_approved)
            btnAttemptApproved.classList.add('module__btn', 'module__btn--correcto');
        else
            btnAttemptApproved.classList.add('module__btn', 'module__btn--incorrecto');
        

        const iconDelete = document.createElement('i');
        iconDelete.classList.add('bx', 'bx-trash');

        const btnEliminar = document.createElement('button');
        btnEliminar.classList.add('module__btn', 'module__btn--eliminar');
        btnEliminar.dataset.id = attempt.id_attempt;
        btnEliminar.appendChild(iconDelete);
        btnEliminar.onclick = function (){
            alertDeleteAttempt(attempt);   
        }


        const iconChevron = document.createElement('i');
        iconChevron.classList.add('bx', 'bx-chevron-down');

        actionsContainer.appendChild(btnAttemptChecked);
        actionsContainer.appendChild(btnAttemptApproved);
        actionsContainer.appendChild(btnEliminar);
        actionsContainer.appendChild(iconChevron);

        summary.appendChild(headerAttempt);
        summary.appendChild(actionsContainer);

        // Contenido interno del acordeón
        const contenido = document.createElement('div');
        contenido.classList.add('acordeon__contenido');
        contenido.id = `anwswers-${attempt.id_attempt}`;

        const attempt_answers = attempt.answersStudent;
        clearElementContainer(contenido);        

        if(attempt_answers.length === 0){
            const noClases = document.createElement('p');
            noClases.classList.add('module__no-class');
            noClases.textContent = 'Examen no respondido';

            contenido.appendChild(noClases);

            // Insertar summary y contenido en el details
            details.appendChild(summary);
            details.appendChild(contenido);

            return details;
        }
        
        attempt_answers.forEach(attempt_answer =>{
            let newAnswer = createAnswerElement({...attempt_answer});
            contenido.appendChild(newAnswer);
        });
        
        details.appendChild(summary);
        details.appendChild(contenido);

        return details;
    }

    function createAnswerElement(attempt_answer) {
        const {question, answer, is_correct} = attempt_answer;
        // Crear contenedor principal
        const answerContainer = document.createElement('div');
        answerContainer.className = 'lesson';

        // Crear contenedor izquierdo
        const lessonLeft = document.createElement('div');
        lessonLeft.className = 'lesson__left';

        const dataContent = document.createElement('div');
        dataContent.className = 'lesson__data-answers';
        
        const correctIcon = document.createElement('i');
        correctIcon.addEventListener('click', ()=>{
            attempt_answer.is_correct = attempt_answer.is_correct?0:1;
            updateCorrectAnswer(attempt_answer);
        });
        
        if(is_correct){
            correctIcon.classList.add("bx", "bxs-check-circle", "is-correct-answer");
        
        }else{
            correctIcon.classList.add("bx", "bx-x-circle", "not-correct-answer"); 
        }
        
        const dataQuestionContent = document.createElement('div');
        dataQuestionContent.classList.add('lesson__data-answerStudent');

        const questionContent = document.createElement('p');
        questionContent.className = 'lesson__question';
        questionContent.textContent = question??"";

        const answerContent = document.createElement('p');
        answerContent.className = 'lesson__answer';
        answerContent.textContent = answer??"Pregunta no respondida";
        
        dataQuestionContent.appendChild(questionContent)
        dataQuestionContent.appendChild(answerContent)

        // Añadir elementos al dataContent
        dataContent.appendChild(correctIcon);
        dataContent.appendChild(dataQuestionContent);

        // Añadir elementos al lessonLeft
        lessonLeft.appendChild(dataContent);

        // Crear contenedor derecho
        const lessonRight = document.createElement('div');
        lessonRight.className = 'lesson__right';

        const btnIncorrecto = document.createElement('button');
        btnIncorrecto.className = 'module__btn module__btn--calificar';
        btnIncorrecto.onclick = function(){
            if(!attempt_answer.is_correct)
                return;

            attempt_answer.is_correct = attempt_answer.is_correct?0:1;
            updateCorrectAnswer(attempt_answer);
        };

        btnIncorrecto.innerHTML = is_correct?"<i class='bx bx-x-circle'></i>":"<i class='bx bxs-x-circle'></i>";

        const BtnCorrecto = document.createElement('button');
        BtnCorrecto.className = 'module__btn module__btn--calificar';
        BtnCorrecto.onclick = function() {
            if(attempt_answer.is_correct)
                return;

            attempt_answer.is_correct = attempt_answer.is_correct?0:1;
            updateCorrectAnswer(attempt_answer);  
        };

        BtnCorrecto.innerHTML = is_correct?"<i class='bx bxs-check-circle' ></i>":"<i class='bx bx-check-circle' ></i>";

        lessonRight.appendChild(btnIncorrecto);
        lessonRight.appendChild(BtnCorrecto);

        // Añadir ambos lados al contenedor principal
        answerContainer.appendChild(lessonLeft);
        answerContainer.appendChild(lessonRight);

        return answerContainer;
    }

    function alertDeleteAttempt(attempt){
        Swal.fire({
            title: "Estas seguro que quieres eliminar este intento",
            text: `intento #"${attempt.id_attempt}"`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminalo"
        }).then((result) => {
            if (result.isConfirmed) 
                deleteAttempt(attempt);
        });
    }

    async function deleteAttempt(attempt) {
        const {id_attempt} = attempt

        try{
            const url = `/api/attempt/delete/${id_attempt}`;

            const request = await fetch(url, {
                method:'DELETE'
            });

            const response = await request.json();

            if(!response.ok){
                changeAlert('error', response.message);
                resetAlert();
                return;
            }

            attempts = attempts.filter(attempt => attempt.id_attempt != id_attempt);

            changeAlert('success', response.message);
            showAttempts();            
            resetAlert();

        }catch(error){
            console.log(error);
        }
    }

    async function updateCorrectAnswer(option_question) {
        const {id_answer, id_attempt, is_correct} = option_question;

        try{
            const url = `/api/answer_student/is_correct/${id_answer}`;

            changeAlert('inProcess', 'Guardando cambios...');

            const request = await fetch(url, {
                method:'PATCH',
                headers:{
                    'Accept':'application/json',
                    'Content-Type':'application/json'
                },
                body: JSON.stringify({is_correct:is_correct})
            });

            const response = await request.json();

            if(!response.ok){
                changeAlert('error', 'Error al guardar los cambios');
                return;
            }

            changeAlert('success', response.message);

            attempts = attempts.map(attempt =>{
                if(attempt.id_attempt == id_attempt){
                    attempt.answersStudent = attempt.answersStudent.map(answer =>{
                        if(answer.id_answer == id_answer)
                            answer.is_correct = is_correct;
                        return answer;
                    })
                }
                return attempt;
            });
            
            //recorremos array para recalcular los valores del attempt
            let score = 0;
            let maxScore = 0;
            let is_approved = 0

            attempts = attempts.map(attempt =>{
                if(attempt.id_attempt == id_attempt){
                    maxScore = attempt.answersStudent.length;

                    attempt.answersStudent.forEach(answer=>{
                        if(answer.is_correct)
                            score++;
                    });

                    const finalScore = (score / maxScore) * 100
                    is_approved = finalScore >= attempt.min_score?1:0;
                    
                    attempt.score = (score / maxScore) * 100;
                    attempt.is_approved = is_approved;
                }

                return attempt;
            });

            resetAlert();
            showAttempts(id_attempt);

        }catch(error){
            console.log(error);
        }
    }

    async function changeAttempt(attempt){
        const {id_attempt, checked} = attempt;

        try{
            const url = `/api/attempt/checked/${id_attempt}`;

            changeAlert('inProcess', 'Guardando cambios...');

            const request = await fetch(url, {
                method:'PATCH',
                headers:{
                    'Accept':'application/json',
                    'Content-Type':'application/json'
                },
                body: JSON.stringify({checked:checked})
            });

            const response = await request.json();

            if(!response.ok){
                changeAlert('error', 'Error al guardar los cambios');
                return;
            }

            changeAlert('success', response.message);

            attempts = attempts.map(attempt =>{
                if(attempt.id_attempt == id_attempt)
                    attempt.checked = checked;
                
                return attempt;
            });
            
            resetAlert();
            showAttempts();

        }catch(error){
            console.log(error);
        }
    }
    
    //funciones auxiliares--------------------------------------------------
    function btnExitMessage(){
        btnExit.addEventListener('click', () =>{
            window.location = "/kta-admin/cursos";
        });
    }

    function openAcordion(modulo){
        const summary = modulo.querySelector("summary");
        const content = modulo.querySelector(".acordeon__contenido");

        if (!summary || !content) return;

        modulo.setAttribute("open", "");
        const height = content.scrollHeight;
        content.style.height = height + "px";

    }

    // Función para inicializar el acordeón en un módulo específico
    function initAccordion(modulo) {
        const summary = modulo.querySelector("summary");
        const content = modulo.querySelector(".acordeon__contenido");

        if (!summary || !content) return;

        summary.addEventListener("click", (e) => {
            e.preventDefault(); // Evita el comportamiento nativo

            if(!e.target.classList.contains("module__header"))
            return;

            const isOpen = modulo.hasAttribute("open");
            modulo.classList.add("animating");

            if (isOpen) {
                const height = content.scrollHeight;
                content.style.height = height + "px";

                requestAnimationFrame(() => {
                content.style.height = "0px";
                });

                setTimeout(() => {
                modulo.removeAttribute("open");
                modulo.classList.remove("animating");
                }, 400);
            } else {
                modulo.setAttribute("open", "");
                const height = content.scrollHeight;
                content.style.height = "0px";

                requestAnimationFrame(() => {
                content.style.height = height + "px";
                });

                setTimeout(() => {
                content.style.height = "auto";
                modulo.classList.remove("animating");
                }, 400);
            }
        });
    }

    //obtiene el id del curso obtendio de la url
    function getCourseID(){
        const path = window.location.pathname;
        const parts = path.split('/');

        const ID = parts[parts.length -1];

        return ID;
    }

    //limpia contenedor de modulos
    function clearQuizContainer(){
        while(attemptsContainer.firstChild)
            attemptsContainer.removeChild(attemptsContainer.firstChild);
    }

    function clearElementContainer(element){
        while(element.firstChild)
            element.removeChild(element.firstChild);
    }

    function changeAlert(type, message = "Error al guardar" ){
        
        containerAlert.className = "";

        switch(type){
            case "success":
                containerAlert.classList.add("course-info__saved", "course-info__saved--correct");
                containerAlert.innerHTML = `<i class='bx bx-cloud-upload' ></i> ${message}`;
            break;

            case "inProcess":
                containerAlert.classList.add("course-info__saved", "course-info__saved--in-process");
                containerAlert.innerHTML = `<i class='bx bxs-cloud-upload bx-flashing' ></i> ${message}`;
            break;

            case "error":
                containerAlert.classList.add("course-info__saved", "course-info__saved--error");
                containerAlert.innerHTML = `<i class='bx bx-error-circle' ></i> ${message}`;
            break;

            case "warning":
                containerAlert.classList.add("course-info__saved", "course-info__saved--warning");
                containerAlert.innerHTML = `<i class='bx bx-error-circle' ></i> ${message}`;
            break;

            case "waiting":
                containerAlert.classList.add("course-info__saved", "course-info__saved--waiting");
                containerAlert.innerHTML = `<i class='bx bx-cloud' ></i>`;
            break;

            default:
                containerAlert.classList.add("course-info__saved", "course-info__saved--waiting");
                containerAlert.innerHTML = `<i class='bx bx-check-circle' ></i> ${message}`;
        }
    }

    function resetAlert(){
        setTimeout(() => {
            changeAlert('waiting')
        }, 5000);
    }

})();