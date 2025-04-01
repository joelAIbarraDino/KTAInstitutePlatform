(function(){
    // ============== CONFIGURACIÓN PRINCIPAL ==============
    const state = {
        step: 1,
        maxReachedStep: 1,
        correctFieldsCourse: {
            thumbnail: false,
            name: false,
            watchword: false,
            max_months_enroll: false,
            price: false,
            discount: true,
            discount_ends: true,
            description: false,
            privacy: false,
            id_teacher: false,
            id_category: false
        }
    };

    let course = {};
    // ============== ELEMENTOS DEL DOM ==============
    const DOM = {
        thumbnailBtn: document.querySelector('#thumbnail-btn'),
        fileName: document.querySelector('#msg-thumbnail'),
        formCourse: document.querySelector("#form-course"),
        fieldsCourse: document.querySelectorAll('#form-course input,textarea'),
        CBCourse: document.querySelectorAll('#form-course select'),
        fieldFileCourse: document.querySelector("#thumbnail"),
        tabs: document.querySelectorAll('#tabs button'),
        customFileButton: document.querySelector('#thumbnail-btn'),
        realFileButtom : document.querySelector('#thumbnail')
    };

    // ============== REGLAS DE VALIDACIÓN ==============
    const regexRules = {
        textRule: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
        positiveIntRule: /^\d+$/,
        floatRule: /^(\d+)(\.\d{1,2})*$/,
        dateRule: /^\d{4}-\d{2}-\d{2}$/,
        percentRule: /^(100(\.0{1,2})?|\d{1,2}(\.\d{1,2})?|0(\.\d{1,2})?)%?$/i
    };

    const fieldRulesCourse = {
        name: regexRules.textRule,
        watchword: regexRules.textRule,
        description: regexRules.percentRule,
        max_months_enroll: regexRules.positiveIntRule,
        price: regexRules.floatRule,
        discount: regexRules.floatRule,
        discount_ends: regexRules.dateRule
    };

    // ============== FUNCIONES DE VALIDACIÓN ==============
    function validateField(e) {
        const field = e.target;
        const name = field.name;
        const value = field.value.trim();

        //evita ingresar espacios en blanco
        if(value.length === 0){
            field.value = "";
        }

        if(['name', 'watchword', 'max_months_enroll', 'price'].contains(name)){
            validateRegex(field);
            return;
        }  

        if(['privacy', 'id_teacher', 'id_category'].contains(name)){
            validateCB(field);
            return;
        }  

        if(name === "discount"){
            validateDiscount();
            return;
        }

        if(name === "discount_ends"){
            validateDate();
            return;
        }

        if(name === "description"){
            validateText(field, 300);
            return;
        }
        
    }

    function validateCourseFile(e) {
        const file = e.target.files[0];
        const maxSize = 5 * 1024 * 1024; // 5MB
        
        if (!file) {
            showError(DOM.fileName, 'No se ha seleccionado ningún archivo');
            state.correctFieldsCourse.thumbnail = false;
            return;
        }
        
        if (file.size > maxSize) {
            showError(DOM.fileName, 'El archivo es demasiado grande (máx. 5MB)');
            state.correctFieldsCourse.thumbnail = false;
            return;
        }
        
        if (!file.type.match('image.*')) {
            showError(DOM.fileName, 'Solo se permiten imágenes');
            state.correctFieldsCourse.thumbnail = false;
            return;
        }
        
        showSuccess(DOM.fileName, file.name);
        state.correctFieldsCourse.thumbnail = true;
    }

    // ============== MANEJO DE PESTAÑAS ==============
    function handleTabs() {
        DOM.tabs.forEach(tab => {
            tab.addEventListener('click', function(e){
                if(e.target.classList.contains("tabs__tab--disable")) return;
                
                const newStep = parseInt(e.target.dataset.step);
                if(newStep <= state.maxReachedStep && newStep != state.step) {
                    state.step = newStep;
                    showSection();
                }
            });
        });
    }

    function unlockNextStep() {
        const nextStep = state.step + 1;
        if(nextStep > state.maxReachedStep) {
            state.maxReachedStep = nextStep;
            const nextTab = document.querySelector(`[data-step="${nextStep}"]`);
            nextTab.classList.remove("tabs__tab--disable");
        }
    }

    // ============== HELPERS ==============
    function showError(element, message) {
        element.textContent = message;
        element.classList.add("error", "show");
        element.classList.remove("correct");
    }

    function showSuccess(element, message = "") {
        element.textContent = message;
        element.classList.add("correct", "show");
        element.classList.remove("error");
    }

    function getErrorMessage(fieldName) {
        const messages = {
            name: "Solo se admite texto en este campo",
            watchword: "Solo se admite texto en este campo",
            max_months_enroll: "Solo se admite números enteros",
            price: "Solo se admite formato decimal (ej: 19.99)",
            discount: "Solo se admite porcentaje válido (0-100)"
        };
        return messages[fieldName] || "Campo inválido";
    }

    function showSection() {
        // 1. Ocultar sección actual
        const currentSection = document.querySelector('.tabs__section.active');
        if (currentSection) {
            currentSection.classList.remove('active');
            
            // Animación de salida (opcional)
            currentSection.style.transition = 'opacity 0.3s ease';
            currentSection.style.opacity = '0';
            setTimeout(() => {
                currentSection.style.display = 'none';
            }, 300);
        }
    
        // 2. Desactivar pestaña actual
        const currentTab = document.querySelector('.tabs__tab--active');
        if (currentTab) {
            currentTab.classList.remove('tabs__tab--active');
        }
    
        // 3. Mostrar nueva sección
        const newSection = document.querySelector(`#step-${state.step}`);
        if (newSection) {
            newSection.style.display = 'block';
            // Forzar reflow para que funcione la animación
            void newSection.offsetWidth;
            newSection.classList.add('active');
            newSection.style.transition = 'opacity 0.3s ease';
            newSection.style.opacity = '1';
            
            // Enfocar el primer campo input de la sección
            const firstInput = newSection.querySelector('input, select, textarea');
            if (firstInput) {
                firstInput.focus();
            }
        }
    
        // 4. Activar nueva pestaña
        const newTab = document.querySelector(`[data-step="${state.step}"]`);
        if (newTab) {
            newTab.classList.add('tabs__tab--active');
            
            // Scroll suave a la pestaña (para móviles)
            newTab.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'center'
            });
        }
    }

    function validateDiscount(){
        const field = document.querySelector("#discount");

        if(field.value != ""){
            validateRegex(field);
        }
        else{
            document.querySelector("#discount_ends").value = "";
            const labelMessage = document.querySelector(`#msg-${field.name}`);
            showSuccess(labelMessage);
            state.correctFieldsCourse[field.name] = true;
        }
        validateDate();
    }

    function validateDate(){
        const fieldDisscount = document.querySelector("#discount");
        const dateDisscount = document.querySelector("#discount_ends");
        const nameDate = dateDisscount.name;
        const nameDiscount = fieldDisscount.name;

        //si el campo de descuento esta lleno y la fecha no seleccionada
        if(fieldDisscount.value != "" && dateDisscount.value == ""){
            const labelMessage = document.querySelector(`#msg-${nameDate}`);
            showError(labelMessage, "la fecha de fin de promoción es obligatorio");
            state.correctFieldsCourse[nameDate] = false;
        //si la fecha esta selecionada y el campo de descuento no tiene valor
        }else if(dateDisscount.value != "" && fieldDisscount.value == ""){
            const labelMessage = document.querySelector(`#msg-${nameDiscount}`);
            showError(labelMessage, "el descuento es obligatorio");
            state.correctFieldsCourse[nameDiscount] = false;
        //en caso de que ni el descuento y fecha tenga valor
        }else{
            const labelMessage = document.querySelector(`#msg-${nameDate}`);
            showSuccess(labelMessage);
            state.correctFieldsCourse[nameDate] = true;
            state.correctFieldsCourse[nameDiscount] = true;
        }
    }

    function validateText(element, min){
        const name = element.name;
        const value = element.value.trim();
        const labelMessage = document.querySelector(`#msg-${name}`);
        if(value.length < min){
            showError(labelMessage, `El texto debe tener al menos ${min} caracteres`)
            state.correctFieldsCourse[name] = false;
        }else{
            showSuccess(labelMessage, "")
            state.correctFieldsCourse[name] = true;
        }
    }

    function validateCB(element){

        const name = element.name;
        const value = element.value.trim();
        const labelMessage = document.querySelector(`#msg-${name}`);

        if(value === ""){
            showError(labelMessage, "Debe seleccionar una opción");
            state.correctFieldsCourse[name] = false;
        }else{
            showSuccess(labelMessage, "")
            state.correctFieldsCourse[name] = true;
        }
    }

    function validateRegex(element){
        
        const name = element.name;
        const rule = fieldRulesCourse[name];
        const value = element.value.trim();
        const labelMessage = document.querySelector(`#msg-${name}`);
        
        if(rule && !rule.test(value)){
            showError(labelMessage, getErrorMessage(name));
            state.correctFieldsCourse[name] = false;
        } else {
            showSuccess(labelMessage, "")
            state.correctFieldsCourse[name] = true;
        }
    }

    function allFieldsCorrect(){
        let allCorrect = true;

        Object.entries(state.correctFieldsCourse).forEach(([key, value]) =>{                
            if(!value){
                const labelMessage = document.querySelector(`#msg-${key}`);
                showError(labelMessage, "este campo es obligatorio");
                allCorrect = false;
            }
        });

        return allCorrect;
    }

    function fieldsToDataForm(){
        const formData = new FormData();
        const rawData = {};
            
        //captura los valores de los campos input excepot submit
        DOM.fieldsCourse.forEach(field => {
            if(field.type != "submit")
                rawData[field.name] = field.value;
        });
        
        //captura los valores de los select
        DOM.CBCourse.forEach(field =>{
            rawData[field.name] = field.value;
        });

        //convertir objeto en json para hacer la conversión
        course = JSON.parse(JSON.stringify(rawData, (key, value) => {
            // Conversión manual para campos numéricos
            if(['max_months_enroll', 'price', 'discount', 'privacy', 'id_teacher', 'id_category'].includes(key))
                return value ? parseFloat(value) : null;

            return value === "" ? null : value;
        }));
        
        //se asigna el nombre del archivo
        course['thumbnail'] = DOM.fieldFileCourse.files[0] || null;

        Object.entries(course).forEach(([key, value]) =>{    
            formData.append(key, value);
        });

        return formData;
    }
    
    // ============== INICIALIZACIÓN ==============
    function init() {

        handleTabs();
        setupFormValidation();
        setupFormSubmit();
    }

    function setupFormValidation() {
        DOM.fieldsCourse.forEach(input => {
            input.addEventListener('keyup', validateField);
            input.addEventListener('blur', validateField);
        });

        DOM.CBCourse.forEach(select => {
            select.addEventListener('change', validateField);
        });

        DOM.customFileButton.addEventListener('click', () => {
            DOM.realFileButtom.click();
          });

        DOM.fieldFileCourse.addEventListener('change', validateCourseFile);
    }

    function setupFormSubmit() {
        DOM.formCourse.addEventListener('submit', async function(e){
            e.preventDefault();
            
            if(allFieldsCorrect()){                
                const data = fieldsToDataForm();

                try{
                    const response = await fetch('/admin/curso/new', {
                        method: 'POST',
                        body: data
                    });
    
                    const result = await response.json();

                    if(result.correct){
                        Swal.fire({
                            title: "Curso creado correctamente",
                            icon: "success"
                        });
                        unlockNextStep();
                    }else{
                        Swal.fire({
                            title: "Error al crear curso",
                            text: "intente mas tarde",
                            icon: "error"
                        });
                    }
                }catch(e){
                    console.log("Error: ", e);
                }
            }else{
                Swal.fire({
                    title: "Campos incompletos",
                    text: "Debe completar los campos marcados para crear el curso",
                    icon: "warning"
                });
            }
        });
    }

    // ============== EJECUCIÓN ==============
    init();
})();
