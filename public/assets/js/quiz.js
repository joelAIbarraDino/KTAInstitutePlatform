(function(){
    
    const btnExit = document.querySelector("#btn-exit");
    const quizContainer = document.querySelector("#quiz-container");
    const btnConf = document.querySelector('#add_conf_btn');
    const courseID = getCourseID();
    const containerAlert = document.querySelector("#container-alert");
    const questionInput = document.querySelector('#new_question');
    const questionAddButton = document.querySelector('#add_question_btn');


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

        questionAddButton.addEventListener('click', ()=>{
            addQuestion();
        });

        questionInput.addEventListener('input', e=>{
            if(e.target.value.trim().length == 0){
                e.target.value = "";
            }
        });

        questionInput.addEventListener('keydown', e=>{
            
            if(e.key != "Enter")return;

            addQuestion();
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

            showQuestions();

        } catch (error) {
            console.log(error);
        }
    }

    function showQuestions(){

       //generando preguntas del examen 
        clearQuizContainer();

        if(questions.length === 0)
            return;
        
        questions.forEach(question =>{
            let newQuestion = createQuestionElement(question);
            quizContainer.appendChild(newQuestion);
            initAccordion(newQuestion);
        });
    }

    function quizModal(modeEdit = false){
        const {id_quiz, name, tutorial_id, min_score, max_time, max_attempts} = quiz;

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

        // Input: Video tutorial
        const divTutorialID = document.createElement("div");
        divTutorialID.classList.add("form__input", "col-12");

        const labelTutorialID = document.createElement("label");
        labelTutorialID.setAttribute("for", "tutorial_id");
        labelTutorialID.textContent = " Vimeo ID(obligatorio)";

        const inputTutorialID = document.createElement("input");
        inputTutorialID.setAttribute("autocomplete", "off");
        inputTutorialID.type = "text";
        inputTutorialID.name = "tutorial_id";
        inputTutorialID.id = "tutorial_id";
        inputTutorialID.classList.add("field");
        inputTutorialID.placeholder = "ID de tutorial en Vimeo";
        inputTutorialID.value = tutorial_id || "";
        
        divTutorialID.appendChild(labelTutorialID);
        divTutorialID.appendChild(inputTutorialID);

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
        grid.appendChild(divTutorialID);
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
            const newIDVimeo = inputTutorialID.value.trim();
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

            if(!newIDVimeo || !Number.isInteger( Number(newIDVimeo))){
                Swal.fire({
                    icon: "error",
                    title: "Vimeo ID invalido",
                    text: "El ID ingresado es invalido",
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
                tutorial_id:newIDVimeo,
                min_score:newMinScore,
                max_time:newMaxTime,
                max_attempts:newAttempts,
                id_course:courseID
            }

            if(!modeEdit){
                addQuiz(quizObject);
                return;
            }
            
            updateQuiz(quizObject);
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
        inputQuestion.addEventListener('blur', ()=>{

            if(!questionChanged(inputQuestion))
                return;

            question.question = inputQuestion.value.trim();
            updateQuestion(question);
        });

        questionContainer.appendChild(inputQuestion);

        // Parte derecha: acciones
        const actionsContainer = document.createElement('div');
        actionsContainer.classList.add('module__header-actions');

        const btnType = document.createElement('div');
        btnType.classList.add('module__btn', 'module__btn--agregar');
        btnType.dataset.id = question.id_question;
        btnType.innerHTML = `Tipo: <strong>${question.type_question}</strong>`;
        btnType.onclick = function (){
            question.type_question = question.type_question == "multiple"?"abierta":"multiple";
            updateTypeQuestion(question);
        }

        const btnAgregar = document.createElement('button');
        btnAgregar.classList.add('module__btn', 'module__btn--agregar');
        btnAgregar.innerHTML = '<i class="bx bxs-add-to-queue"></i> respuesta';
        btnAgregar.dataset.id = question.id_question;
        btnAgregar.onclick = function (){

            if(question.answers.length == 4){
                changeAlert('error', "Respuestas completas: solo se permiten 4 respuestas");
                resetAlert();
                return;
            }

            answerModal(question, false);
        }

        const iconDelete = document.createElement('i');
        iconDelete.classList.add('bx', 'bx-trash');

        const btnEliminar = document.createElement('button');
        btnEliminar.classList.add('module__btn', 'module__btn--eliminar');
        btnEliminar.dataset.id = question.id_question;
        btnEliminar.appendChild(iconDelete);
        btnEliminar.onclick = function (){
            alertDeleteQuestion(question);   
        }


        const iconChevron = document.createElement('i');
        iconChevron.classList.add('bx', 'bx-chevron-down');

        actionsContainer.appendChild(btnType);

        if(question.type_question == "multiple"){
            actionsContainer.appendChild(btnAgregar);
        }

        actionsContainer.appendChild(btnEliminar);
        actionsContainer.appendChild(iconChevron);

        summary.appendChild(questionContainer);
        summary.appendChild(actionsContainer);

        // Contenido interno del acordeón
        const contenido = document.createElement('div');
        contenido.classList.add('acordeon__contenido');
        contenido.id = `anwswers-${question.id_question}`;
        
        if(question.type_question != "multiple"){
            const noClases = document.createElement('p');
            noClases.classList.add('module__no-class');
            noClases.textContent = 'Esta pregunta es de respuesta abierta';

            contenido.appendChild(noClases);

            // Insertar summary y contenido en el details
            details.appendChild(summary);
            details.appendChild(contenido);

            return details;
        }

        const option_questions = question.answers;
        clearElementContainer(contenido);        

        if(option_questions.length === 0){
            const noClases = document.createElement('p');
            noClases.classList.add('module__no-class');
            noClases.textContent = 'Sin respuestas agregadas';

            contenido.appendChild(noClases);

            // Insertar summary y contenido en el details
            details.appendChild(summary);
            details.appendChild(contenido);

            return details;
        }
        
        option_questions.forEach(option_question =>{
            let newAnswer = createAnswerElement({...option_question}, {...question});
            contenido.appendChild(newAnswer);
        });
        
        details.appendChild(summary);
        details.appendChild(contenido);

        return details;
    }

    function createAnswerElement(option_question, question) {
        const {id_option, text_option} = option_question;
        // Crear contenedor principal
        const answerContainer = document.createElement('div');
        answerContainer.className = 'lesson';

        // Crear contenedor izquierdo
        const lessonLeft = document.createElement('div');
        lessonLeft.className = 'lesson__left';

        const dataContent = document.createElement('div');
        dataContent.className = 'lesson__data-question';
        
        const correctIcon = document.createElement('i');
        
        if(option_question.is_correct){
            correctIcon.classList.add("bx", "bxs-check-circle", "is-correct-answer");
        
        }else{
            correctIcon.classList.add("bx", "bx-check-circle", "is-correct-answer");
            
        }
        
        const nombre = document.createElement('p');
        nombre.className = 'lesson__name';
        nombre.textContent = text_option??"";
        
        // Añadir elementos al dataContent
        dataContent.appendChild(correctIcon);
        dataContent.appendChild(nombre);

        // Añadir elementos al lessonLeft
        lessonLeft.appendChild(dataContent);

        // Crear contenedor derecho
        const lessonRight = document.createElement('div');
        lessonRight.className = 'lesson__right';

        const btnEditar = document.createElement('button');
        btnEditar.className = 'module__btn module__btn--agregar';
        btnEditar.setAttribute('data-id', id_option);
        btnEditar.innerHTML = "<i class='bx bx-edit'></i>";
        btnEditar.onclick = function(){
            answerModal(question, true, option_question);
        };

        const btnEliminar = document.createElement('button');
        btnEliminar.className = 'module__btn module__btn--eliminar';
        btnEliminar.setAttribute('data-id', id_option);
        btnEliminar.innerHTML = "<i class='bx bx-trash'></i>";
        btnEliminar.onclick = function(){
            alertDeleteAnswer(option_question);
        }

        // Añadir botones al lessonRight
        lessonRight.appendChild(btnEditar);
        lessonRight.appendChild(btnEliminar);

        // Añadir ambos lados al contenedor principal
        answerContainer.appendChild(lessonLeft);
        answerContainer.appendChild(lessonRight);

        return answerContainer;
    }

    function answerModal(question, modeEdit = false, option_question = {}){
        const {id_question} = question;
        const {id_option, text_option, is_correct} = option_question;

        const modalWindow = document.createElement("div");
        modalWindow.classList.add("modal");

        // FORM
        const form = document.createElement("form");
        form.classList.add("form", "modal__form");

        // LEGEND
        const legend = document.createElement("legend");
        legend.classList.add("form__title");
        legend.textContent = "Respuesta de pregunta";

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
        labelNombre.textContent = " Opción de respuesta (obligatorio)";

        const inputNombre = document.createElement("input");
        inputNombre.setAttribute("autocomplete", "off");
        inputNombre.type = "text";
        inputNombre.name = "name";
        inputNombre.id = "name";
        inputNombre.classList.add("field");
        inputNombre.placeholder = "Opción de respuesta a escoger";
        inputNombre.value = text_option || "";
        inputNombre.onkeydown =  function(e){
            //capitalizo primera letra del nombre de la clase
            e.target.value = capitalize(e.target.value);
        }

        divNombre.appendChild(labelNombre);
        divNombre.appendChild(inputNombre);

        // Input: es correcto
        const divIsCorrect = document.createElement("div");
        divIsCorrect.classList.add("form__input", "col-12");

        const laberIsCorrect = document.createElement("label");
        laberIsCorrect.textContent = "La respuesta es correcta";

        const realInputIsCorrect = document.createElement("input");
        realInputIsCorrect.value  = is_correct?"true":"false";
        realInputIsCorrect.type = "hidden";

        const inputIsCorrect = document.createElement("i");
        inputIsCorrect.classList.add("bx", "bx-check-square", "field-checkbox");
        inputIsCorrect.addEventListener('click', ()=>{
            
            if(realInputIsCorrect.value == "true"){
                realInputIsCorrect.value = "false";
                inputIsCorrect.classList.remove("bxs-check-square");
                inputIsCorrect.classList.add("bx-check-square");
            }else{
                realInputIsCorrect.value = "true";
                inputIsCorrect.classList.add("bxs-check-square");
                inputIsCorrect.classList.remove("bx-check-square");
            }
        });

        if(is_correct){
            inputIsCorrect.classList.remove("bx-check-square");
            inputIsCorrect.classList.add("bxs-check-square");
        }else{
            inputIsCorrect.classList.add("bx-check-square");
            inputIsCorrect.classList.remove("bxs-check-square");
        }

        divIsCorrect.appendChild(laberIsCorrect);
        divIsCorrect.appendChild(realInputIsCorrect);
        divIsCorrect.appendChild(inputIsCorrect);

        // Agregar inputs al grid
        grid.appendChild(divNombre);
        grid.appendChild(divIsCorrect);

        // Submit
        const divSubmit = document.createElement("div");
        divSubmit.classList.add("modal__controllers");

        const inputSubmit = document.createElement("input");
        inputSubmit.type = "submit";
        inputSubmit.classList.add("submit");
        inputSubmit.value = "Guardar";
        inputSubmit.addEventListener('click', function(){
            const newName = inputNombre.value.trim();
            const is_correct = realInputIsCorrect.value
            
            if(newName.length === 0){
                Swal.fire({
                    icon: "error",
                    title: "Respuesta invalida",
                    text: "Debe colocar una respuesta valida a la pregunta",
                });
                return;
            }

            const answerObject = {
                id_option: id_option??null,
                text_option:newName,
                is_correct:is_correct=="true"?1:0,
                id_question:id_question
            }

            if(!modeEdit){
                addAnswer(answerObject);
                return;
            }
            
            updateAnswer(answerObject);
        });

        const inputClose = document.createElement("button");
        inputClose.classList.add("modal__cancel");
        inputClose.textContent = "Cancelar";
        inputClose.addEventListener("click", function(){

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
            
                const form = document.querySelector(".modal__form");
                form.classList.add("modal-close");
                
                setTimeout(() => {
                    modalWindow.remove();
                }, 550);
            }
        });

        document.querySelector("body").appendChild(modalWindow);
    }

    function alertDeleteAnswer(option_question){
        const {text_option} = option_question

        Swal.fire({
            title: `Estas seguro que quieres eliminar la respuesta "${text_option}"`,
            text: "Este proceso no se puede revertir",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminalo"
        }).then((result) => {
            if (result.isConfirmed) {
                deleteAnswer(option_question);
            }
                
        });
    }

    function alertDeleteQuestion(question){
        Swal.fire({
            title: "Estas seguro que quieres eliminar esta pregunta",
            text: `"${question.question}"`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminalo"
        }).then((result) => {
            if (result.isConfirmed) 
                deleteQuestion(question);
        });
    }

    async function addQuiz(newQuiz) {

        const {name, tutorial_id, min_score, max_time, max_attempts, id_course} = newQuiz;

        try {

            //registro el modelo en la base de datos
            const formData = new FormData();
            formData.append("name", name);
            formData.append("tutorial_id", tutorial_id);
            formData.append("min_score", min_score);
            formData.append("max_time", max_time);
            formData.append("max_attempts", max_attempts);
            formData.append("id_course", courseID);
            
            const url = `/api/quiz/create/${courseID}`;
            
            changeAlert('inProcess', 'Guardando cambios...');

            //cerramos modal
            const form = document.querySelector(".modal__form");
            const modalWindow = document.querySelector(".modal");
            form.classList.add("modal-close");
            
            setTimeout(() => {
                modalWindow.remove();
            }, 0);

            const request = await fetch(url, {
                method:"POST",
                body:formData
            });

            const response = await request.json();

            if(!response.ok){
                changeAlert('error', response.message);
                return;
            }
            
            //actualizamos DOM
            const newQuiz = {
                id_quiz:response.id,
                name:name,
                tutorial_id:tutorial_id,
                min_score:min_score,
                max_time:max_time,
                max_attempts:max_attempts,
                id_course:id_course
            }
            changeAlert('success', response.message);
            resetAlert();
            quiz = newQuiz;

        } catch (error) {
            console.log(error);
        }
        
    }

    async function updateQuiz(quizMemory){
        const {id_quiz, name, tutorial_id, min_score, max_time, max_attempts, id_course} = quizMemory;

        try {

            const url = `/api/quiz/update/${id_quiz}`;

            //cerramos modal
            const form = document.querySelector(".modal__form");
            const modalWindow = document.querySelector(".modal");
            form.classList.add("modal-close");

            setTimeout(() => {
                modalWindow.remove();
            }, 0);

            changeAlert('inProcess', 'Guardando cambios...');

            const request = await fetch(url, {
                method:"PUT",
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    name: name,
                    tutorial_id: tutorial_id,
                    min_score: min_score ,
                    max_time:max_time,
                    max_attempts:max_attempts,
                    id_course:id_course
                })
            });

            const response = await request.json();

            if(!response.ok){
                changeAlert('error', response.message);
                return;
            }

            //sincronizo objeto quiz 
            quiz.name = name,
            quiz.tutorial_id = tutorial_id,
            quiz.min_score = min_score ,
            quiz.max_time = max_time,
            quiz.max_attempts = max_attempts,
            quiz.id_course = id_course

            changeAlert('success', response.message);
            resetAlert();
        } catch (error) {
            console.log(error);
        }
    }

    async function addQuestion() {
        const questionTextInput = questionInput.value.trim();
        if(!questionTextInput) return;

        //registro de nueva pregunta
        try{
            //registro el modelo en la base de datos
            const formData = new FormData();
            formData.append("question", questionTextInput);
            formData.append("type_question", "multiple");
            formData.append("id_quiz", quiz.id_quiz);
            
            const url = `/api/question/create/${quiz.id_quiz}`;

            changeAlert('inProcess', 'Guardando cambios...');

            const request = await fetch(url, {
                method:"POST",
                body:formData
            });

            const response = await request.json();

            if(!response.ok){
                changeAlert('error', response.message);
                return;
            }

            changeAlert('success', response.message);

            //registro el nuevo modelo en mi objeto local
            const   quizObject= {
                id_question: response.id,
                question: questionTextInput,
                type_question:"multiple",
                id_quiz: quiz.id_quiz,
                answers: []
            }
            
            questions = [...questions, quizObject];
        
            questionInput.value = "";
            questionInput.focus(); 
            resetAlert();
            showQuestions();

        }catch(error){
            console.log(error);
        }
    }

    async function updateQuestion(questionObject){
        const {id_question, question} = questionObject;

        try {
            const url = `/api/question/question/${id_question}`;

            changeAlert('inProcess', 'Guardando datos...');

            const request = await fetch(url, {
                method:'PATCH',
                headers:{
                    'Accept': 'application/json',
                    'Content-type':'application/json'
                },
                body:JSON.stringify({question:question})
            });

            const response = await request.json();

            if(!response.ok){
                changeAlert('error', response.message);
                return;
            }

            questions = questions.map(questionMemory=>{
                if(questionMemory.id_question == id_question){
                    questionMemory.question = question
                }
                return questionMemory;
            });

            changeAlert('success', response.message);
            resetAlert();
            showQuestions();

        } catch (error) {
            
        }
    }

    async function addAnswer(option_question) {
        const {text_option, is_correct, id_question} = option_question;

        try {
            const formData = new FormData();
            formData.append("text_option", text_option);
            formData.append("is_correct", is_correct);
            formData.append("id_question", id_question);

            const url = `/api/option_question/create/${id_question}`;

            changeAlert('inProcess', 'Guardando cambios...');

            //cerramos modal
            const form = document.querySelector(".modal__form");
            const modalWindow = document.querySelector(".modal");
            form.classList.add("modal-close");
            
            setTimeout(() => {
                modalWindow.remove();
            }, 0);

            const request = await fetch(url, {
                method:"POST",
                body:formData
            });

            const response = await request.json();
            
            if(!response.ok){
                changeAlert('error', response.message);
                return;
            }

            changeAlert('success', response.message);

            const newOptionQuestion = {
                id_option: response.id,
                text_option:text_option,
                is_correct:is_correct,
                id_question:id_question
            }

            questions = questions.map(question =>{
                if(question.id_question == id_question){
                    question.answers = [...question.answers, newOptionQuestion]
                }
                return question;
            });

            showQuestions();
            resetAlert();

        } catch (error) {
            console.log(error);
        }
    }

    async function updateAnswer(option_question) {
        const {id_option, text_option, is_correct, id_question} = option_question;

        try{
            const url = `/api/option_question/update/${id_option}`;

            changeAlert('inProcess', 'Guardando cambios...');

            //cerramos modal
            const form = document.querySelector(".modal__form");
            const modalWindow = document.querySelector(".modal");
            form.classList.add("modal-close");
            
            setTimeout(() => {
                modalWindow.remove();
            }, 0);

            const request = await fetch(url, {
                method:"PUT",
                headers:{
                    'Accept': 'application/json',
                    'content-type':'application/json'
                },
                body: JSON.stringify({
                    id_option:id_option,
                    text_option:text_option,
                    is_correct:is_correct,
                    id_question:id_question
                })
            });

            const response = await request.json();

            if(!response.ok){
                changeAlert('error', response.message);
                return;
            }

            questions = questions.map(question =>{
                if(question.id_question == id_question){

                    if(is_correct){
                        question.answers = question.answers.map(option_question =>{
                            if(option_question.id_option == id_option){
                                option_question.text_option = text_option;
                                option_question.is_correct = is_correct;
                            }else{
                                option_question.is_correct = 0;
                            }

                            return option_question;
                        });
                    }else{
                        question.answers = question.answers.map(option_question =>{
                            if(option_question.id_option == id_option){
                                option_question.text_option = text_option;
                                option_question.is_correct = is_correct;
                            }
                            
                            return option_question;
                        });
                    }
                }
                return question;
            });

            showQuestions();
            changeAlert('success', response.message);
            resetAlert();

        }catch(error){
            console.log(error);
        }
    }

    async function deleteAnswer(option_question){
        const {id_option, id_question} = option_question;

        try {
            const url = `/api/option_question/delete/${id_option}`;

            changeAlert('inProcess', 'Guardando cambios...');

            const request = await fetch(url, {
                method:'DELETE'
            });

            const response = await request.json();

            if(!response.ok){
                changeAlert('error', response.message);
                return;
            }

            questions = questions.map(question =>{
                if(question.id_question == id_question)
                    question.answers = question.answers.filter(answer => answer.id_option != id_option);
                return question;
            });

            changeAlert('success', response.message);
            resetAlert();
            showQuestions();

        } catch (error) {
            console.log(error);
        }
    }

    async function  deleteQuestion(question) {
        const {id_question} = question

        try{
            const url = `/api/question/delete/${id_question}`;

            const request = await fetch(url, {
                method:'DELETE'
            });

            const response = await request.json();

            if(!response.ok){
                changeAlert('error', response.message);
                resetAlert();
                return;
            }

            questions = questions.filter(question => question.id_question != id_question);

            changeAlert('success', response.message);
            showQuestions();            
            resetAlert();

        }catch(error){
            console.log(error);
        }
    }

    async function updateTypeQuestion(question) {
        const {id_question, type_question} = question;

        try{
            const url = `/api/question/type_question/${id_question}`;

            changeAlert('inProcess', 'Guardando cambios...');

            const request = await fetch(url, {
                method:'PATCH',
                headers:{
                    'Accept':'application/json',
                    'Content-Type':'application/json'
                },
                body: JSON.stringify({type_question:type_question})
            });

            const response = await request.json();

            if(!response.ok){
                changeAlert('error', 'Error al guardar los cambios');
                return;
            }

            changeAlert('success', response.message);

            questions = questions.map(question =>{
                if(question.id_question == id_question){
                    question.type_question = type_question;
                }
                return question;
            });
            
            resetAlert();
            showQuestions();

        }catch(error){
            console.log(error);
        }
    }
    //funciones auxiliares--------------------------------------------------
    function questionChanged(inputElement) {
        const question = questions.find(question => question.id_question == inputElement.dataset.id);
        const newQuestion = inputElement.value.trim();

        if(newQuestion.length == 0)return false;
        if (!question) return false;
        return question.question != newQuestion;
    }
    
    function btnExitMessage(){
        btnExit.addEventListener('click', () =>{
            window.location = "/kta-admin/cursos";
        });
    }

    // Función para inicializar el acordeón en un módulo específico
    function initAccordion(modulo) {
        const summary = modulo.querySelector("summary");
        const content = modulo.querySelector(".acordeon__contenido");

        if (!summary || !content) return;

        summary.addEventListener("click", (e) => {
            e.preventDefault(); // Evita el comportamiento nativo

            if(!e.target.classList.contains("module__header") && !e.target.classList.contains("bx-chevron-down"))
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