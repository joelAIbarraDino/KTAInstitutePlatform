(function(){
    // ============== CONFIGURACIÓN PRINCIPAL ==============
    const state = {
        correctFieldsCourse: {
            name: false
        }
    };

    let category = {};
    // ============== ELEMENTOS DEL DOM ==============
    const DOM = {
        formCourse: document.querySelector("#form-category"),
        fieldsCourse: document.querySelectorAll('#form-category input'),
    };

    // ============== REGLAS DE VALIDACIÓN ==============
    const fieldRulesCourse = {
        name: /^(?!\d)[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]+$/
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
        
        validateRegex(field);
        
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
            name: "Solo se admite texto en este campo"
        };
        return messages[fieldName] || "Campo inválido";
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
        
        //convertir objeto en json para hacer la conversión
        category = JSON.parse(JSON.stringify(rawData, (key, value) => {
            // Conversión manual para campos numéricos
            if(['max_months_enroll', 'price', 'discount', 'privacy', 'id_teacher', 'id_category'].includes(key))
                return value ? parseFloat(value) : null;

            return value === "" ? null : value;
        }));
        
        Object.entries(category).forEach(([key, value]) =>{    
            formData.append(key, value);
        });

        return formData;
    }
    
    async function createCourse(data){
        const url = "/api/categoria/create";

        try{
            const response = await fetch(url, {
                method: 'POST',
                body: data
            });

            const result = await response.json();

            if(result.id){
                //muestro alerta de que se creo el curso
                Swal.fire({
                    title: "Categoria creado correctamente",
                    icon: "success"
                }).then(() =>{
                    location.href = "/categorias";
                });
                
            }else{
                //ocurrio un error al guardar los datos
                Swal.fire({
                    title: "Error al crear categoria",
                    text: "intente mas tarde",
                    icon: "error"
                });
                //mostramos los mensajes en cada campo señalado por la api si es que hay
                if(result.alerts){
                    Object.entries(result.alerts).forEach(([name, msg]) =>{    
                        const labelMessage = document.querySelector(`#msg-${name}`);
                        showError(labelMessage, msg);
                        state.correctFieldsCourse[name] = false;
                    });
                }
            }
        }catch(e){
            console.log("Error: ", e);
        }
    }

    // ============== INICIALIZACIÓN ==============
    function init() {

        setupFormValidation();
        setupFormSubmit();
    }

    function setupFormValidation() {
        DOM.fieldsCourse.forEach(input => {
            input.addEventListener('keyup', validateField);
            input.addEventListener('blur', validateField);
        });
    }

    function setupFormSubmit() {
        DOM.formCourse.addEventListener('submit', async function(e){
            e.preventDefault();
            
            if(allFieldsCorrect()){                
                const data = fieldsToDataForm();
                createCourse(data);
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
