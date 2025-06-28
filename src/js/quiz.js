(function(){
    
    const btnExit = document.querySelector("#btn-exit");
    const quizContainer = document.querySelector("#quiz-container");
    const btnConf = document.querySelector('#add_conf_btn');
    const btnFaq = document.querySelector('#add_FAQ_btn');
    const courseID = getCourseID();
    const containerAlert = document.querySelector("#container-alert");

    let questions = [];
    let quiz = [];
    
    app();

    //funcion principal
    function app(){
        btnExitMessage();
        getQuiz();
        configButtons();
    }

    function configButtons(){
        btnConf.addEventListener('click', ()=>{
            quizModal(true);
        });

        btnFaq.addEventListener('click', ()=>{

        });
    }

    async function getQuiz(){
        try {
            const id = getCourseID();
            const url = `/api/quiz/${id}`;

            const request = await fetch(url);
            const response = await request.json();
            
            questions = response.questions;
            quiz = response.quiz;

            if(quiz.length == 0)
                quizModal();

        } catch (error) {
            console.log(error);
        }
    }

    function showQuiz(){

       //generando preguntas del examen 
        clearQuizContainer();

        if(questions.length === 0)
            return;
        
        questions.forEach(question =>{
            let newQuestion = createQuestionElement(question);
            quizContainer.appendChild(newQuestion);
            initAccordion(newModule);
        });
    }

    function quizModal(modeEdit = false){
        const {id_quiz, name, min_score, max_time, max_attempts} = quiz;

        const modalWindow = document.createElement("div");
        modalWindow.classList.add("modal");

        // FORM
        const form = document.createElement("form");
        form.classList.add("form", "modal__form");

        // LEGEND
        const legend = document.createElement("legend");
        legend.classList.add("form__title");
        legend.textContent = "Parametros del quiz";

        // Instrucciones
        const instrucciones = document.createElement("p");
        instrucciones.classList.add("form__instructions");
        instrucciones.textContent = "Completa los campos requeridos";

        // Grid contenedor
        const grid = document.createElement("div");
        grid.classList.add("grid-elements", "border");

        // Input: Nombre
        const divNombre = document.createElement("div");
        divNombre.classList.add("form__input", "col-12");

        const labelNombre = document.createElement("label");
        labelNombre.setAttribute("for", "name");
        labelNombre.textContent = " Titulo del examen (obligatorio)";

        const inputNombre = document.createElement("input");
        inputNombre.setAttribute("autocomplete", "off");
        inputNombre.type = "text";
        inputNombre.name = "name";
        inputNombre.id = "name";
        inputNombre.classList.add("field");
        inputNombre.placeholder = "Titulo del examen";
        inputNombre.value = name || "";
        inputNombre.onkeydown =  function(e){
            //capitalizo primera letra del nombre de la clase
            e.target.value = capitalize(e.target.value);
        }

        divNombre.appendChild(labelNombre);
        divNombre.appendChild(inputNombre);

        // Input: Min score
        const divMinScore = document.createElement("div");
        divMinScore.classList.add("form__input", "col-12");

        const labelMinScore = document.createElement("label");
        labelMinScore.setAttribute("for", "min_score");
        labelMinScore.textContent = "Score minimo aprobatorio (1 - 100)";

        const inputMinScore = document.createElement("input");
        inputMinScore.setAttribute("autocomplete", "off");
        inputMinScore.type = "number";
        inputMinScore.name = "min_score";
        inputMinScore.id = "min_score";
        inputMinScore.classList.add("field");
        inputMinScore.placeholder = "Puntaje minimo para aprobar (1 - 100)";
        inputMinScore.value = min_score || "";

        divMinScore.appendChild(labelMinScore);
        divMinScore.appendChild(inputMinScore);

        // Input: Max time
        const divMaxTime = document.createElement("div");
        divMaxTime.classList.add("form__input", "col-12");

        const labelMaxTime = document.createElement("label");
        labelMaxTime.setAttribute("for", "max_time");
        labelMaxTime.textContent = "Tiempo maximo para concluir el examen (en minutos)";

        const inputMaxTime = document.createElement("input");
        inputMaxTime.setAttribute("autocomplete", "off");
        inputMaxTime.type = "number";
        inputMaxTime.name = "max_time";
        inputMaxTime.id = "max_time";
        inputMaxTime.classList.add("field");
        inputMaxTime.placeholder = "Tiempo en minutos para terminar";
        inputMaxTime.value = max_time || "";

        divMaxTime.appendChild(labelMaxTime);
        divMaxTime.appendChild(inputMaxTime);

        // Input: Max time
        const divMaxAttempts = document.createElement("div");
        divMaxAttempts.classList.add("form__input", "col-12");

        const labelMaxAttempts = document.createElement("label");
        labelMaxAttempts.setAttribute("for", "max_attempts");
        labelMaxAttempts.textContent = "Numero de intentos maximos para aprobar";

        const inputMaxAttempts = document.createElement("input");
        inputMaxAttempts.setAttribute("autocomplete", "off");
        inputMaxAttempts.type = "number";
        inputMaxAttempts.name = "max_attempts";
        inputMaxAttempts.id = "max_attempts";
        inputMaxAttempts.classList.add("field");
        inputMaxAttempts.placeholder = "Tiempo en minutos para terminar";
        inputMaxAttempts.value = max_attempts || "";

        divMaxAttempts.appendChild(labelMaxAttempts);
        divMaxAttempts.appendChild(inputMaxAttempts); 
        
        // Agregar inputs al grid
        grid.appendChild(divNombre);
        grid.appendChild(divMinScore);
        grid.appendChild(divMaxTime);
        grid.appendChild(divMaxAttempts);

        // Submit
        const divSubmit = document.createElement("div");
        divSubmit.classList.add("modal__controllers");

        const inputSubmit = document.createElement("input");
        inputSubmit.type = "submit";
        inputSubmit.classList.add("submit");
        inputSubmit.value = "Guardar";
        inputSubmit.addEventListener('click', function(){
            const newName = inputNombre.value.trim();
            const newMinScore = inputMinScore.value.trim();
            const newMaxTime = inputMaxTime.value.trim();
            const newAttempts = inputMaxAttempts.value.trim();


            if(newName.length === 0){
                Swal.fire({
                    icon: "error",
                    title: "Nombre invalido",
                    text: "El nombre del quiz es obligatorio",
                });
                return;
            }

            if(newMinScore < 1 || newMinScore > 100){
                Swal.fire({
                    icon: "error",
                    title: "Score minimo invalido",
                    text: "El score debe estar en el rango de (1 - 100)",
                });
                return;
            }

            if(newMaxTime < 1){
                Swal.fire({
                    icon: "error",
                    title: "Tiempo maximo invalido",
                    text: "El tiempo maximo no puede ser negativo",
                });
                return;
            }

            if(newAttempts < 1){
                Swal.fire({
                    icon: "error",
                    title: "Numero de intentos invalido",
                    text: "El numero de intentos no puede ser negativo",
                });
                return;
            }

            const quizObject = {
                id_quiz:id_quiz??null,
                name:newName,
                min_score:newMinScore,
                max_time:newMaxTime,
                max_attempts:newAttempts,
                id_course:courseID
            }

            if(!modeEdit)
                addQuiz(quizObject);
        });

        const inputClose = document.createElement("button");
        inputClose.classList.add("modal__cancel");
        inputClose.textContent = "Cancelar";
        inputClose.addEventListener("click", function(){

            if(!modeEdit)
                location.href = `/kta-admin/course-content/${courseID}`;

            const form = document.querySelector(".modal__form");
            form.classList.add("modal-close");
            
            setTimeout(() => {
                modalWindow.remove();
            }, 550);
        });

        divSubmit.appendChild(inputClose);
        divSubmit.appendChild(inputSubmit);

        // Ensamblar el formulario
        form.appendChild(legend);
        form.appendChild(instrucciones);
        form.appendChild(grid);
        form.appendChild(divSubmit);

        // Agregar el formulario al modal
        modalWindow.appendChild(form);

        //animación de apertura
        setTimeout(() => {
            const form = document.querySelector(".modal__form");
            form.classList.add("modal-open");
        }, 100);

        //animación de close
        modalWindow.addEventListener('click', e =>{
            e.preventDefault();

            if(e.target.classList.contains("modal")){
                
                if(!modeEdit)
                    location.href = `/kta-admin/course-content/${courseID}`;

            
                const form = document.querySelector(".modal__form");
                form.classList.add("modal-close");
                
                setTimeout(() => {
                    modalWindow.remove();
                }, 550);
            }
        });

        document.querySelector("body").appendChild(modalWindow);
    }

    function createQuestionElement(question) {
        // Crear el contenedor <details>
        const details = document.createElement('details');
        details.classList.add('acordeon__modulo');
        details.dataset.id = `${question.id_question}`; 

        // Crear el <summary> (encabezado del acordeón)
        const summary = document.createElement('summary');
        summary.classList.add('module__header');

        // Parte izquierda: nombre del módulo
        const questionContainer = document.createElement('div');
        questionContainer.classList.add('module__header-name');

        const inputQuestion = document.createElement('input');
        inputQuestion.type = 'text';
        inputQuestion.placeholder = 'Pregunta de examen';
        inputQuestion.classList.add('module__name');
        inputQuestion.value = question.question;
        inputQuestion.id = `question-question-${question.id_question}`;
        inputQuestion.dataset.id=`${question.id_question}`;
        inputQuestion.onkeydown = (e) =>{ e.target.value = capitalize(e.target.value); }
        inputQuestion.addEventListener('blur', ()=>{

            if(!questionChanged(inputQuestion))
                return;

            updateQuestion({...question}, inputQuestion.value);
        });

        questionContainer.appendChild(inputQuestion);

        // Parte derecha: acciones
        const actionsContainer = document.createElement('div');
        actionsContainer.classList.add('module__header-actions');

        const btnAgregar = document.createElement('button');
        btnAgregar.classList.add('module__btn', 'module__btn--agregar');
        btnAgregar.innerHTML = '<i class="bx bxs-add-to-queue"></i> Clase';
        btnAgregar.dataset.id = question.id_question;
        btnAgregar.onclick = function (){
            questionModal({...question});
        }

        const iconDelete = document.createElement('i');
        iconDelete.classList.add('bx', 'bx-trash');

        const btnEliminar = document.createElement('button');
        btnEliminar.classList.add('module__btn', 'module__btn--eliminar');
        btnEliminar.dataset.id = question.id_question;
        btnEliminar.appendChild(iconDelete);
        btnEliminar.onclick = function (){
            alertDeleteQuestion({...question});   
        }


        const iconChevron = document.createElement('i');
        iconChevron.classList.add('bx', 'bx-chevron-down');

        actionsContainer.appendChild(btnAgregar);
        actionsContainer.appendChild(btnEliminar);
        actionsContainer.appendChild(iconChevron);

        summary.appendChild(questionContainer);
        summary.appendChild(actionsContainer);

        // Contenido interno del acordeón
        const contenido = document.createElement('div');
        contenido.classList.add('acordeon__contenido');
        contenido.id = `anwswers-${question.id_question}`;
        

        const answers = question.answers;
        clearElementContainer(contenido);        

        if(answers.length === 0){
            const noClases = document.createElement('p');
            noClases.classList.add('module__no-class');
            noClases.textContent = 'Sin respuestas agregadas';

            contenido.appendChild(noClases);

            // Insertar summary y contenido en el details
            details.appendChild(summary);
            details.appendChild(contenido);

            return details;
        }
        
        answers.forEach(answer =>{
            let newAnswer = createAnswerElement({...answer}, {...question});
            contenido.appendChild(newAnswer);
        });
        
        details.appendChild(summary);
        details.appendChild(contenido);

        return details;
    }

    function createAnswerElement(answer, question) {
        const {id_question, question, id_quiz} = answer;
        // Crear contenedor principal
        const lessonContainer = document.createElement('div');
        lessonContainer.className = 'lesson';

        // Crear contenedor izquierdo
        const lessonLeft = document.createElement('div');
        lessonLeft.className = 'lesson__left';

        const iconMenu = document.createElement('i');
        iconMenu.className = 'bx bx-menu';

        const dataContent = document.createElement('div');
        dataContent.className = 'lesson__data-content';

        const nombre = document.createElement('p');
        nombre.className = 'lesson__name';
        nombre.textContent = question;

        const enlace = document.createElement('a');
        enlace.className = 'lesson__video-link link-active';
        enlace.href = `https://vimeo.com/${id_video}`;
        enlace.target = '_blank';
        enlace.textContent = 'Ver clase en vimeo';

        // Añadir elementos al dataContent
        dataContent.appendChild(nombre);
        dataContent.appendChild(enlace);

        // Añadir elementos al lessonLeft
        //lessonLeft.appendChild(iconMenu);
        lessonLeft.appendChild(dataContent);

        // Crear contenedor derecho
        const lessonRight = document.createElement('div');
        lessonRight.className = 'lesson__right';

        const btnEditar = document.createElement('button');
        btnEditar.className = 'module__btn module__btn--agregar';
        btnEditar.setAttribute('data-id', id_module);
        btnEditar.innerHTML = "<i class='bx bx-edit'></i>";
        btnEditar.onclick = function(){
            lessonModal(module, true, lesson);
        };

        const btnEliminar = document.createElement('button');
        btnEliminar.className = 'module__btn module__btn--eliminar';
        btnEliminar.setAttribute('data-id', id_module);
        btnEliminar.innerHTML = "<i class='bx bx-trash'></i>";
        btnEliminar.onclick = function(){
            alertDeleteLesson({...lesson});
        }

        // Añadir botones al lessonRight
        lessonRight.appendChild(btnEditar);
        lessonRight.appendChild(btnEliminar);

        // Añadir ambos lados al contenedor principal
        lessonContainer.appendChild(lessonLeft);
        lessonContainer.appendChild(lessonRight);

        return lessonContainer;
    }

    async function addQuiz(newQuiz) {

        const {name, min_score, max_time, max_attempts, id_course} = newQuiz;

        try {

            //registro el modelo en la base de datos
            const formData = new FormData();
            formData.append("name", name);
            formData.append("min_score", min_score);
            formData.append("max_time", max_time);
            formData.append("max_attempts", max_attempts);
            formData.append("id_course", id_course);
            
            const url = `/api/quiz/create/${id_course}`;

            const request = await fetch(url, {
                method:"POST",
                body:formData
            });

            const response = await request.json();

            if(!response.ok){
                Swal.fire({
                    icon: "error",
                    title: "Ha ocurrido un error",
                    text: response.message,
                });
                return;
            }

            //mostramos alerta de confirmación
            Swal.fire({
                icon: "success",
                title: "Registro exitoso",
                text: response.message,
            });

            //cerramos modal
            const form = document.querySelector(".modal__form");
            const modalWindow = document.querySelector(".modal");
            form.classList.add("modal-close");
            
            setTimeout(() => {
                modalWindow.remove();
            }, 0);

            //actualizamos DOM
            const newQuiz = {
                id_quiz:response.id,
                name:name,
                min_score:min_score,
                max_time:max_time,
                max_attempts:max_attempts,
                id_course:id_course
            }

            quiz = newQuiz;

        } catch (error) {
            console.log(error);
        }
        
    }

    async function updateQuiz(quizMemory){
        const {id_quiz, name, min_score, max_time, max_attempts, id_course} = quizMemory;

        try {

            const url = `/api/quiz/update/${id_quiz}`;

            const request = await fetch(url, {
                method:"PUT",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    name: name,
                    min_score: min_score ,
                    max_time:max_time,
                    max_attempts:max_attempts,
                    id_course:id_course
                })
            });

            const response = await request.json();

            if(!response.ok){
                Swal.fire({
                    icon: "error",
                    title: "Ha ocurrido un error",
                    text: response.message,
                });
                return;
            }

            //mostramos alerta de confirmación
            Swal.fire({
                icon: "success",
                title: "Actualización exitosa",
                text: response.message,
            });

            //cerramos modal
            const form = document.querySelector(".modal__form");
            const modalWindow = document.querySelector(".modal");
            form.classList.add("modal-close");

            setTimeout(() => {
                modalWindow.remove();
            }, 0);

            //sincronizo objeto quiz 
            quiz.name = name,
            quiz.min_score = min_score ,
            quiz.max_time = max_time,
            quiz.max_attempts = max_attempts,
            quiz.id_course = id_course


        } catch (error) {
            console.log(error);
        }
    }

    //funciones auxiliares--------------------------------------------------
    function questionChanged(inputElement) {
        const question = questions.find(question => question.id_question == inputElement.dataset.id);
        const newQuestion = inputElement.value.trim();

        if(newQuestion.length === 0)return false;
        if (!question) return false;
        return question.question !== newQuestion;
    }
    
    function btnExitMessage(){
        btnExit.addEventListener('click', () =>{
            Swal.fire({
                icon: "info",
                title: `Recuerde`,
                html: `Puede editar el contenido del curso dando click al icono <i class='bx bxs-widget'></i> en el administrador de cursos`,
            }).then((result) => {
                if (result.isConfirmed) 
                    window.location = "/kta-admin/cursos";
            });

        });
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

    //capitaliza primera letra de texto
    function capitalize(str){
        return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
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
        while(quizContainer.firstChild)
            quizContainer.removeChild(quizContainer.firstChild);
    }

    function clearElementContainer(element){
        while(element.firstChild)
            element.removeChild(element.firstChild);
    }

    function changeAlert(type, message = ""){
        
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