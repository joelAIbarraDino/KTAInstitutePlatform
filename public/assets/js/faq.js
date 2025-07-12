(function(){
    
    const btnAdd = document.querySelector("#add_FAQ_btn");
    const btnExit = document.querySelector("#btn-exit");
    const FAQContainer = document.querySelector("#faq-container");
    const containerAlert = document.querySelector("#container-alert");
    const courseID = getCourseID();

    let faqs = [];
    
    app();

    //funcion principal
    function app(){
        newFAQ();
        getFAQ();
        btnExitMessage();
    }

    async function getFAQ(){
        try {
            const id = getCourseID();
            const url = `/api/faq/${id}`;

            const request = await fetch(url);
            const response = await request.json();
            faqs = response.faq;

            showFAQ();

        } catch (error) {
            console.log(error);
        }
    }   

    function createFAQElement(FAQ) {
        // Crear el contenedor <details>
        const details = document.createElement('details');
        details.classList.add('acordeon__modulo');
        details.dataset.id = `${FAQ.id_FAQ}`; 

        // Crear el <summary> (encabezado del acordeón)
        const summary = document.createElement('summary');
        summary.classList.add('module__header');

        // Parte izquierda: nombre del módulo
        const nameContainer = document.createElement('div');
        nameContainer.classList.add('module__header-name');
        
        const inputQuestion = document.createElement('input');
        inputQuestion.type = 'text';
        inputQuestion.placeholder = 'Pregunta a responder';
        inputQuestion.classList.add('module__name');
        inputQuestion.value = FAQ.question;
        inputQuestion.id = `faq-${FAQ.id_FAQ}`;
        inputQuestion.dataset.id=FAQ.id_FAQ;
        inputQuestion.onkeydown = (e) => {e.target.value = capitalize(e.target.value);}
        inputQuestion.addEventListener('blur', ()=>{
            //verifico si el nombre actual es diferente al valor ingresado
            if(!isFAQ_QuestionChanged(inputQuestion))
                return;

            updateQuestion({...FAQ}, inputQuestion.value);
        });

        nameContainer.appendChild(inputQuestion);

        // Parte derecha: acciones
        const actionsContainer = document.createElement('div');
        actionsContainer.classList.add('module__header-actions');

        const iconDelete = document.createElement('i');
        iconDelete.classList.add('bx', 'bx-trash');

        const btnEliminar = document.createElement('button');
        btnEliminar.classList.add('module__btn', 'module__btn--eliminar');
        btnEliminar.dataset.id = FAQ.id_FAQ;
        btnEliminar.appendChild(iconDelete);
        btnEliminar.onclick = function (){
            alertDeleteFAQ({...FAQ});   
        }


        const iconChevron = document.createElement('i');
        iconChevron.classList.add('bx', 'bx-chevron-down');

        actionsContainer.appendChild(btnEliminar);
        actionsContainer.appendChild(iconChevron);

        summary.appendChild(nameContainer);
        summary.appendChild(actionsContainer);
        
        const contenido = document.createElement('div');
        contenido.classList.add('acordeon__contenido');
        contenido.id = `faq-${FAQ.id_FAQ}`;

        // Contenido interno del acordeón
        const inputAnswer = document.createElement('input');
        inputAnswer.type = 'text';
        inputAnswer.placeholder = 'Pregunta a responder';
        inputAnswer.classList.add('acordeon__answer');
        inputAnswer.value = FAQ.answer;
        inputAnswer.id = `question-faq-${FAQ.answer}`;
        inputAnswer.dataset.id=`${FAQ.id_FAQ}`;
        inputAnswer.onkeydown = (e)=>{e.target.value = capitalize(e.target.value);}
        inputAnswer.addEventListener('blur', ()=>{
            //verifico si el nombre actual es diferente al valor ingresado
            if(!isFAQ_AnswerChanged(inputAnswer))
                return;

            updateAnswer({...FAQ}, inputAnswer.value);
        });

        contenido.appendChild(inputAnswer);
            
        details.appendChild(summary);
        details.appendChild(contenido);

        return details;
    }

    function newFAQ(){
        btnAdd.addEventListener('click', function(){
            FAQModal();
        });
    }

    function FAQModal(){
        const modalWindow = document.createElement("div");
        modalWindow.classList.add("modal");

        // FORM
        const form = document.createElement("form");
        form.classList.add("form", "modal__form");
        form.enctype = "multipart/form-data";

        // LEGEND
        const legend = document.createElement("legend");
        legend.classList.add("form__title");
        legend.textContent = "Agregar nueva FAQ";

        // Instrucciones
        const instrucciones = document.createElement("p");
        instrucciones.classList.add("form__instructions");
        instrucciones.textContent = "Completa los campos requeridos";

        // Grid contenedor
        const grid = document.createElement("div");
        grid.classList.add("grid-elements", "border");

        // Input: question
        const divQuestion = document.createElement("div");
        divQuestion.classList.add("form__input", "col-12");

        const labelQuestion = document.createElement("label");
        labelQuestion.setAttribute("for", "question");
        labelQuestion.textContent = " Pregunta (requerido)";

        const inputQuestion = document.createElement("input");
        inputQuestion.setAttribute("autocomplete", "off");
        inputQuestion.type = "text";
        inputQuestion.name = "question";
        inputQuestion.id = "question";
        inputQuestion.classList.add("field");
        inputQuestion.placeholder = "Pregunta frecuente a responder";
        inputQuestion.onkeydown =  function(e){
            //capitalizo primera letra del nombre de la clase
            e.target.value = capitalize(e.target.value);
        }

        divQuestion.appendChild(labelQuestion);
        divQuestion.appendChild(inputQuestion);

        // Input: answer
        const divAnswer = document.createElement("div");
        divAnswer.classList.add("form__input", "col-12");

        const labelAnswer = document.createElement("label");
        labelAnswer.setAttribute("for", "answer");
        labelAnswer.textContent = "Respuesta (requerido)";

        const textareaAnswer = document.createElement("textarea");
        textareaAnswer.classList.add("text-area");
        textareaAnswer.name = "answer";
        textareaAnswer.id = "description";
        textareaAnswer.placeholder = "Respuesta de la pregunta frecuente";

        divAnswer.appendChild(labelAnswer);
        divAnswer.appendChild(textareaAnswer);

        // Agregar inputs al grid
        grid.appendChild(divQuestion);
        grid.appendChild(divAnswer);

        // Submit
        const divSubmit = document.createElement("div");
        divSubmit.classList.add("modal__controllers");

        const inputSubmit = document.createElement("input");
        inputSubmit.type = "submit";
        inputSubmit.classList.add("submit");
        inputSubmit.value = "Guardar FAQ";
        inputSubmit.addEventListener('click', function(){
            
            const newQuestion = inputQuestion.value.trim();
            const newAnswer = textareaAnswer.value.trim();

            if(newQuestion.length === 0){
                Swal.fire({
                    icon: "error",
                    title: "Pregunta invalida",
                    text: "La pregunta es obligatoria",
                });
                return;
            }
            
            if(newAnswer.length === 0 || newAnswer.length < 2){
                Swal.fire({
                    icon: "error",
                    title: "Respuesta invalida",
                    text: "La respuesta de la pregunta es obligatoria y de minimo 10 caracteres",
                });
                return;
            }

            const objectFAQ = {
                question:newQuestion,
                answer:newAnswer,
                id_course:courseID
            };

            addFAQ(objectFAQ);
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

    function updateQuestion(faq, newQuestion){
    
        faq.question = newQuestion;
        //actualizamos el nombre de la base de datos
        saveNewQuestion(faq);
    }

    async function saveNewQuestion(faq){
        const {id_FAQ, question} = faq;

        try {
            const url = `/api/faq/question/${id_FAQ}`;

            //coloco icono de que estamos guardando cambios
            changeAlert('inProcess', 'Guardando cambios...');

            const request = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({question: question})
            });

            const response = await request.json();

            if(!response.ok){
                Swal.fire({
                    icon: "error",
                    title: "Ha ocurrido un error",
                    text: response.message,
                });
                changeAlert('error', 'Error al guardar cambios');
                return;
            }

            //cambio el icono de que se guardaron los cambios un tiempo
            changeAlert('success', 'Cambios guardados');

            //sincronizo objeto modulos 
            faqs = faqs.map(faq =>{
                if(faq.id_FAQ === id_FAQ){
                    faq.question = question;
                }

                return faq;
            });
            
            resetAlert();
            showFAQ();

        } catch (error) {
            console.log(error);
        }
    }

    function updateAnswer(faq, newAnswer){
    
        faq.answer = newAnswer;
        //actualizamos el nombre de la base de datos
        saveNewAnswer(faq);
    }

    async function saveNewAnswer(faq){
        const {id_FAQ, answer} = faq;

        try {
            const url = `/api/faq/answer/${id_FAQ}`;

            //coloco icono de que estamos guardando cambios
            changeAlert('inProcess', 'Guardando cambios...');

            const request = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({answer: answer})
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

            //cambio el icono de que se guardaron los cambios un tiempo
            changeAlert('success', 'Cambios guardados');

            //sincronizo objeto modulos 
            faqs = faqs.map(faq =>{
                if(faq.id_FAQ === id_FAQ){
                    faq.answer = answer;
                }

                return faq;
            });
            
            resetAlert();
            showFAQ();

        } catch (error) {
            console.log(error);
        }
    }
    
    function alertDeleteFAQ(faq){
        // Avisa de eliminar módulo
        Swal.fire({
            title: "Estas seguro que quieres eliminar esta FAQ",
            text: "Este proceso no se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminalo"
        }).then((result) => {
            if (result.isConfirmed) 
                deleteFAQ(faq);
        });
    }

    async function deleteFAQ(faq){
        const {id_FAQ} = faq;

        try {
            const url = `/api/faq/delete/${id_FAQ}`;

            const request = await fetch(url, {
                method: 'DELETE'
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

            //sincronizo objeto modulos 
            faqs = faqs.filter(faq => faq.id_FAQ != id_FAQ);

            showFAQ();

        } catch (error) {
            console.log(error);
        }
    }

    //valida si el nombre de los modulos ha cambiado
    function isFAQ_QuestionChanged(inputElement) {
        const FAQ = faqs.find(faq => faq.id_FAQ == inputElement.dataset.id);
        const newQuestion = inputElement.value.trim();

        if(newQuestion.length === 0)return false;
        if (!FAQ) return false;
        return FAQ.question != newQuestion;
    }

    function isFAQ_AnswerChanged(inputElement) {
        const FAQ = faqs.find(faq => faq.id_FAQ == inputElement.dataset.id);
        const newAnswer = inputElement.value.trim();

        if(newAnswer.length === 0)return false;
        if (!FAQ) return false;
        
        return FAQ.answer != newAnswer;
    }

    function showFAQ(){
        clearFAQContainer();

        if(faqs.length === 0)
            return;
        
        faqs.forEach(FAQ =>{
            let newFAQ = createFAQElement(FAQ);
            FAQContainer.appendChild(newFAQ);
            initAccordion(newFAQ);
        });
    }

    function btnExitMessage(){
        btnExit.addEventListener('click', () =>{
            window.location = "/kta-admin/cursos";
        });
    }
    
    // Función para agregar un nuevo módulo
    async function addFAQ(faq) {
        const {question, answer, id_course} = faq;


        //registro el modelo en la base de datos
        const formData = new FormData();
        formData.append("question", question);
        formData.append("answer", answer);
        formData.append("id_course", id_course);
        
        const url = `/api/faq/create/${courseID}`;

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

        //cerramos modal
        const form = document.querySelector(".modal__form");
        const modalWindow = document.querySelector(".modal");
        form.classList.add("modal-close");
        
        setTimeout(() => {
            modalWindow.remove();
        }, 0);

        //registro el nuevo modelo en mi objeto local
        const   faqObject= {
            id_FAQ: response.id,
            question: question,
            answer: answer,
            id_course: id_course,
        }
        
        faqs = [...faqs, faqObject];
        
        showFAQ();
    }

    // Función para inicializar el acordeón en un módulo específico
    function initAccordion(faq) {
        const summary = faq.querySelector("summary");
        const content = faq.querySelector(".acordeon__contenido");

        if (!summary || !content) return;

        summary.addEventListener("click", (e) => {
            e.preventDefault(); // Evita el comportamiento nativo

            if(!e.target.classList.contains("module__header") && !e.target.classList.contains("bx-chevron-down"))
                return;

            const isOpen = faq.hasAttribute("open");
            faq.classList.add("animating");

            if (isOpen) {
                const height = content.scrollHeight;
                content.style.height = height + "px";

                requestAnimationFrame(() => {
                content.style.height = "0px";
                });

                setTimeout(() => {
                faq.removeAttribute("open");
                faq.classList.remove("animating");
                }, 400);
            } else {
                faq.setAttribute("open", "");
                const height = content.scrollHeight;
                content.style.height = "0px";

                requestAnimationFrame(() => {
                content.style.height = height + "px";
                });

                setTimeout(() => {
                content.style.height = "auto";
                faq.classList.remove("animating");
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
    function clearFAQContainer(){
        while(FAQContainer.firstChild)
            FAQContainer.removeChild(FAQContainer.firstChild);
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