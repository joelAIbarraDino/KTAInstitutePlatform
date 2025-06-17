(function(){
    
    const btnAdd = document.querySelector("#add_module_btn");
    const btnExit = document.querySelector("#btn-exit");
    const modulesContainer = document.querySelector("#modules-container");
    const moduleName = document.querySelector("#new_module_name");
    const courseID = getCourseID();

    let modules = [];
    
    app();

    //funcion principal
    function app(){
        getModules();
        newModule();
        validateInputs();
        setDraggableModules();
        btnExitMessage();
    }

    async function getModules(){
        try {
            const id = getCourseID();
            const url = `/api/modules/get/${id}`;

            const request = await fetch(url);
            const response = await request.json();
            modules = response.modules;

            showModules();

        } catch (error) {
            console.log(error);
        }
    }   

    function createModuleElement(module) {
        // Crear el contenedor <details>
        const details = document.createElement('details');
        details.classList.add('acordeon__modulo');
        details.dataset.id = `${module.id_module}`; 

        // Crear el <summary> (encabezado del acordeón)
        const summary = document.createElement('summary');
        summary.classList.add('module__header');

        // Parte izquierda: nombre del módulo
        const nameContainer = document.createElement('div');
        nameContainer.classList.add('module__header-name');

        const icon = document.createElement('i');
        icon.classList.add('bx', 'bx-menu');
        

        const inputOrder = document.createElement('input');
        inputOrder.type = 'text';
        inputOrder.classList.add('module__order');
        inputOrder.value = module.order_module;
        inputOrder.id = `order-module-${module.id_module}`;
        inputOrder.dataset.id=`${module.id_module}`;
        inputOrder.disabled = true;
        inputOrder.hidden = true;

        const inputName = document.createElement('input');
        inputName.type = 'text';
        inputName.placeholder = 'Nombre del módulo';
        inputName.classList.add('module__name');
        inputName.value = module.name;
        inputName.id = `name-module-${module.id_module}`;
        inputName.dataset.id=`${module.id_module}`;
        inputName.onkeydown = function (e){
            //capitalizo primera letra del nombre del modulo
            e.target.value = capitalize(e.target.value);

            //solo guarda cuando presionamos enter
            if(e.key != "Enter")
                return;

            //verifico si el nombre actual es diferente al valor ingresado
            if(!isModuleNameChanged(inputName))
                return;

            updateName({...module}, inputName.value);
        }

        nameContainer.appendChild(icon);
        nameContainer.appendChild(inputOrder);
        nameContainer.appendChild(inputName);

        // Parte derecha: acciones
        const actionsContainer = document.createElement('div');
        actionsContainer.classList.add('module__header-actions');

        const btnAgregar = document.createElement('button');
        btnAgregar.classList.add('module__btn', 'module__btn--agregar');
        btnAgregar.innerHTML = '<i class="bx bxs-add-to-queue"></i> Clase';
        btnAgregar.dataset.id = module.id_module;
        btnAgregar.onclick = function (){
            lessonModal({...module});
        }

        const iconDelete = document.createElement('i');
        iconDelete.classList.add('bx', 'bx-trash');

        const btnEliminar = document.createElement('button');
        btnEliminar.classList.add('module__btn', 'module__btn--eliminar');
        btnEliminar.dataset.id = module.id_module;
        btnEliminar.appendChild(iconDelete);
        btnEliminar.onclick = function (){
            alertDeleteModule({...module});   
        }


        const iconChevron = document.createElement('i');
        iconChevron.classList.add('bx', 'bx-chevron-down');

        actionsContainer.appendChild(btnAgregar);
        actionsContainer.appendChild(btnEliminar);
        actionsContainer.appendChild(iconChevron);

        summary.appendChild(nameContainer);
        summary.appendChild(actionsContainer);

        // Contenido interno del acordeón

        
        const contenido = document.createElement('div');
        contenido.classList.add('acordeon__contenido');
        contenido.id = `content-course-${module.id_module}`;
        

        const lessons = module.lessons;
        clearElementContainer(contenido);        

        if(lessons.length === 0){
            const noClases = document.createElement('p');
            noClases.classList.add('module__no-class');
            noClases.textContent = 'Sin clases agregadas';

            contenido.appendChild(noClases);

            // Insertar summary y contenido en el details
            details.appendChild(summary);
            details.appendChild(contenido);

            return details;
        }
        
        lessons.forEach(lesson =>{
            let newLesson = createLessionElement({...lesson}, {...module});
            contenido.appendChild(newLesson);
        });
        
        details.appendChild(summary);
        details.appendChild(contenido);

        return details;
    }

    function lessonModal(module, modeEdit = false, lesson = {}){
        const {id_module, name} = module;
        const modalWindow = document.createElement("div");
        modalWindow.classList.add("modal");

        // FORM
        const form = document.createElement("form");
        form.classList.add("form", "modal__form");
        form.enctype = "multipart/form-data";

        // LEGEND
        const legend = document.createElement("legend");
        legend.classList.add("form__title");
        legend.textContent = modeEdit ? `Editar lección de modulo "${name}"` : `Nueva lección en modulo "${name}"`;

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
        labelNombre.textContent = " Nombre (requerido)";

        const inputNombre = document.createElement("input");
        inputNombre.setAttribute("autocomplete", "off");
        inputNombre.type = "text";
        inputNombre.name = "name";
        inputNombre.id = "name";
        inputNombre.classList.add("field");
        inputNombre.placeholder = "Nombre de la lección";
        inputNombre.value = lesson.name || "";
        inputNombre.onkeydown =  function(e){
            //capitalizo primera letra del nombre de la clase
            e.target.value = capitalize(e.target.value);
        }

        const spanMsgName = document.createElement("span");
        spanMsgName.id = "msg-name";
        spanMsgName.classList.add("form__input-msg");

        divNombre.appendChild(labelNombre);
        divNombre.appendChild(inputNombre);
        divNombre.appendChild(spanMsgName);

        // Input: Descripción
        const divDescripcion = document.createElement("div");
        divDescripcion.classList.add("form__input", "col-12");

        const labelDescripcion = document.createElement("label");
        labelDescripcion.setAttribute("for", "description");
        labelDescripcion.textContent = "Descripción (requerido)";

        const textareaDescripcion = document.createElement("textarea");
        textareaDescripcion.classList.add("text-area");
        textareaDescripcion.name = "description";
        textareaDescripcion.id = "description";
        textareaDescripcion.placeholder = "Descripción de la clase";
        textareaDescripcion.textContent = lesson.description || "";

        const spanMsgDesc = document.createElement("span");
        spanMsgDesc.id = "msg-description";
        spanMsgDesc.classList.add("form__input-msg");

        divDescripcion.appendChild(labelDescripcion);
        divDescripcion.appendChild(textareaDescripcion);
        divDescripcion.appendChild(spanMsgDesc);

        // Input: Nombre
        const divIdVideo = document.createElement("div");
        divIdVideo.classList.add("form__input", "col-12");

        const labelIdVideo = document.createElement("label");
        labelIdVideo.setAttribute("for", "IdVideo");
        labelIdVideo.textContent = "Vimeo ID";

        const inputIdVideo = document.createElement("input");
        inputIdVideo.setAttribute("autocomplete", "off");
        inputIdVideo.type = "text";
        inputIdVideo.name = "IdVideo";
        inputIdVideo.id = "IdVideo";
        inputIdVideo.classList.add("field");
        inputIdVideo.placeholder = "ID de video alojado en la cuenta personal de Vimeo";
        inputIdVideo.value = lesson.id_video || "";

        const spanMsgIdVideo = document.createElement("span");
        spanMsgIdVideo.id = "msg-IdVideo";
        spanMsgIdVideo.classList.add("form__input-msg");

        divIdVideo.appendChild(labelIdVideo);
        divIdVideo.appendChild(inputIdVideo);
        divIdVideo.appendChild(spanMsgIdVideo);

        // Agregar inputs al grid
        grid.appendChild(divNombre);
        grid.appendChild(divIdVideo);
        grid.appendChild(divDescripcion);

        // Submit
        const divSubmit = document.createElement("div");
        divSubmit.classList.add("modal__controllers");

        const inputSubmit = document.createElement("input");
        inputSubmit.type = "submit";
        inputSubmit.classList.add("submit");
        inputSubmit.value = modeEdit ? "Actualizar lección" : "Crear curso";
        inputSubmit.addEventListener('click', function(){
            
            const newNameLesson = inputNombre.value.trim();
            const newDescription = textareaDescripcion.value.trim();
            const newIDVideo = inputIdVideo.value.trim();

            if(newNameLesson.length === 0){
                Swal.fire({
                    icon: "error",
                    title: "Nombre invalido",
                    text: "El nombre de la lección es obligatorio",
                });
                return;
            }
            
            if(newDescription.length === 0){
                Swal.fire({
                    icon: "error",
                    title: "Descripción invalido",
                    text: "La descripción de la lección es obligatoria",
                });
                return;
            }

            if(!Number.isInteger( Number(newIDVideo))){
                Swal.fire({
                    icon: "error",
                    title: "Vimeo ID invalido",
                    text: "El ID ingresado es invalido",
                });
                return;
            }

            const objectLesson = {
                name:newNameLesson,
                description:newDescription,
                id_video:newIDVideo,
                id_module:id_module
            };

            if(modeEdit){
                //updateLesson(module, lesson);
                console.log("actualizando modulo");
                return;
            }
            
            addLesson(objectLesson);
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

    async function addLesson(lesson){
        const {name, description, id_video, id_module} = lesson;

        try {

            //registro el modelo en la base de datos
            const formData = new FormData();
            formData.append("name", name);
            formData.append("description", description);
            formData.append("id_video", id_video);
            
            const url = `/api/lesson/create/${id_module}`;

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
            }, 550);

            //actualizamos DOM
            const newLesson = {
                id_lesson:response.id,
                name:name,
                id_video:id_video,
                order_lesson:response.order_lesson,
                id_module:id_module,
                material:[]
            }

            modules = modules.map(module => {
                if(module.id_module == id_module){
                    module.lessons = [...module.lessons, newLesson]
                }
                return module;
            });

            showModules();
            
        } catch (error) {
            console.log(error);
        }
    }

    function createLessionElement(lesson, module) {
        const {name, id_video, id_module} = lesson;
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
        nombre.textContent = name;

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

    function updateName(module, newName){
    
        module.name = newName;
        //actualizamos el nombre de la base de datos
        saveNewName(module);
    }

    async function saveNewName(module){
        const {id_module, name} = module;

        try {
            const url = `/api/module/name/${id_module}`;

            const request = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({name: name})
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

            Swal.fire({
                icon: "success",
                title: "Nombre actualizado con exito",
                text: response.message,
            });

            //sincronizo objeto modulos 
            modules = modules.map(module =>{
                if(module.id_module === id_module){
                    module.name = name;
                }

                return module;
            });
            showModules();

        } catch (error) {
            console.log(error);
        }
    }

    function alertDeleteModule(module){
        // Avisa de eliminar módulo
        Swal.fire({
            title: "Estas seguro que quieres eliminar este modulo",
            text: "Este proceso no se puede revertir",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminalo"
        }).then((result) => {
            if (result.isConfirmed) 
                deleteModule(module);
        });
    }

    async function deleteModule(module){
        const {id_module, order_module} = module;

        try {
            const url = `/api/module/delete/${id_module}`;

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

            Swal.fire({
                icon: "success",
                title: "Modulo eliminado con exito",
                text: response.message,
            });

            //sincronizo objeto modulos 
            modules = modules.filter(module => module.id_module != id_module)
                .map(module => {
                    if(module.order_module > order_module){
                        module.order_module = module.order_module - 1;
                    }
                    return module;
            });

            showModules();

        } catch (error) {
            console.log(error);
        }
    }

    function alertDeleteLesson(lesson){
        const {name} = lesson

        Swal.fire({
            title: "Estas seguro que quieres eliminar esta lección",
            text: "Este proceso no se puede revertir",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminalo"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: `Estas por eliminar la clase "${name}"`,
                    text: "¿Seguro que quiere eliminar la clase seleccionada?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, eliminalo"
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteLesson(lesson);
                    }       
                });
            }
                
        });
    }

    async function deleteLesson(lesson) {
        const {id_lesson, order_lesson, id_module} = lesson;

        try {
            const url = `/api/lesson/delete/${id_lesson}`;

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

            Swal.fire({
                icon: "success",
                title: "Lección eliminada con exito",
                text: response.message,
            });

            //sincronizo objeto modulos 
            modules = modules.map(module => {
                if(module.id_module == id_module){
                    const updatedLessons = module.lessons.filter(lesson => lesson.id_lesson != id_lesson)

                    module.lessons = updatedLessons.map(lesson =>{
                        if(lesson.order_lesson > order_lesson){
                            lesson.order_lesson = lesson.order_lesson - 1;
                        }
                        return lesson;
                    });
                }

                return module;
            });

            showModules();
            console.log(modules);

        } catch (error) {
            console.log(error);
        }
    }
    //valida si el nombre de los modulos ha cambiado
    function isModuleNameChanged(inputElement) {
        const module = modules.find(module => module.id_module == inputElement.dataset.id);
        const newName = inputElement.value.trim();

        if(newName.length === 0)return false;
        if (!module) return false;
        return module.name !== newName;
    }

    function showModules(){
        clearModulesContainer();

        if(modules.length === 0)
            return;
        
        modules.forEach(module =>{
            let newModule = createModuleElement(module);
            modulesContainer.appendChild(newModule);
            initAccordion(newModule);
        });
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

    function newModule(){
        // Agrega módulo al hacer clic
        btnAdd.addEventListener("click", function () {
            addModule();
        });

        // Agrega módulo al presionar Enter y evalua texto ingresado
        moduleName.addEventListener('keydown', e => {        
            //capitalizo primera letra del nombre del modulo
            e.target.value = capitalize(e.target.value);

            //si se presiona enter agrego un modulo
            if (e.key !== "Enter") return;

            addModule();
        });

    }

    function validateInputs(){
        //validar entrada
        moduleName.addEventListener('input', e => {
            //evito que se agrege espacio al input
            if(e.target.value.trim().length == 0)
                e.target.value = "";
        });
    }

    function setDraggableModules(){
        // Orden de módulos con arrastrar y soltar
        Sortable.create(modulesContainer, {
            animation: 150,
            handle: ".bx-menu",
            onEnd: () => {
                adjustOrder();
            }
        });
    }
    
    // Función para agregar un nuevo módulo
    async function addModule() {
        const moduleNameText = moduleName.value.trim();
        if (!moduleNameText) return;


        //registro el modelo en la base de datos
        const formData = new FormData();
        formData.append("name", moduleNameText);
        formData.append("id_course", courseID);
        
        const url = `/api/module/create/${courseID}`;

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


        //registro el nuevo modelo en mi objeto local
        const   moduleObject= {
            id_module: response.id,
            name: moduleNameText,
            order_module: response.order_module,
            id_course: courseID,
            lessons: []
        }
        
        modules = [...modules, moduleObject];
        
        showModules();
        moduleName.value = "";
        moduleName.focus(); 
    }

    // Actualiza el orden visual de los módulos
    function adjustOrder() {
        //obtengo todos los modulos que tengo en el DOM despues de arrastrar el elemento
        const modulesDOM = document.querySelectorAll(".module__order");
        
        modulesDOM.forEach(async (moduleDOM, index) =>{
            //obtengo el ID 
            const id = moduleDOM.dataset.id;
            const currentModule = modules.find(module => module.id_module == id);
            
            //solo objetos que hayan cambiado su posición se actualiza
            if(currentModule.order_module == index + 1)
                return;

            //actualizo el nuevo orden que quiero tener en el registro en memoria del modelo que estoy evaluando
            currentModule.order_module = index + 1;
            const response = await saveNewOrder(currentModule);

            if(!response.ok){
                Swal.fire({
                    icon: "error",
                    title: "Ha ocurrido un error",
                    text: response.message,
                });

                //reordeno objeto modules
                modules.sort((a, b) => a.order_module - b.order_module);
                //regenero el DOM con las nuevas posiciones guardas
                showModules();
                return;
            }

        });

        //reordeno objeto modules
        modules.sort((a, b) => a.order_module - b.order_module);
        //regenero el DOM con las nuevas posiciones guardas
        showModules();
    }

    async function saveNewOrder(module){
        const {id_module, order_module} = module;
        let result = [];

        try {
            const url = `/api/module/order_module/${id_module}`;

            const request = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({order_module: order_module})
            });

            const response = await request.json();
            
            //preparo objeto respuesta que regresare a la funcion anterior
            result = {
                ok: response.ok,
                message: response.message
            };

            //en caso de error, regreso lo que me reporto el servidor y no actualizo el objeto principal modulos
            if(!response.ok)
                return result;
            
            //sincronizo objeto modulos 
            modules = modules.map(module =>{
                if(module.id_module == id_module){
                    module.order_module = order_module;
                }

                return module;
            });

            //regreso respuesta de servidor con la confirmación de la actulizacion
            return result;

        } catch (error) {
            console.log(error);
        }
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
    function clearModulesContainer(){
        while(modulesContainer.firstChild)
            modulesContainer.removeChild(modulesContainer.firstChild);
    }

    function clearElementContainer(element){
        while(element.firstChild)
            element.removeChild(element.firstChild);
    }

})();