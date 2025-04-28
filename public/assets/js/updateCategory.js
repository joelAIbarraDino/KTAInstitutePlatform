import {showError, showSuccess, allFieldsCorrect} from '/assets/js/modules/validateForm.js';

 // ============== CONFIGURACIÓN PRINCIPAL ==============
 const state = {
    correctFieldsCourse: {
        name: true
    }
};

let category = {};
const partes = location.href.split('/')
const id = partes[partes.length -1];
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
        showSuccess(labelMessage, "");
        state.correctFieldsCourse[name] = true;
    }
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

async function  updateCourse(id, data) {
    const url = `/api/categoria/update/${id}`;

    try{
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });

        const result = await response.json();

        if(result.row === 1){
            //muestro alerta de que se creo el curso
            Swal.fire({
                title: "Categoria actualizada correctamente",
                icon: "success"
            }).then(() =>{
                location.href = "/categorias";
            });;
        }else if(result.find){
            //ocurrio un error al guardar los datos
            Swal.fire({
                title: "Error al actualizar la categoria",
                text: "intente mas tarde",
                icon: "warning"
            });

            //mostramos los mensajes en cada campo señalado por la api si es que hay
            if(result.alerts){
                Object.entries(result.alerts).forEach(([name, msg]) =>{   
                    const labelMessage = document.querySelector(`#msg-${name}`);
                    showError(labelMessage, msg);
                    state.correctFieldsCourse[name] = false;
                });
            }
        }else{
            //no se encontro el curso
            Swal.fire({
                title: "Curso no encontrado",
                text: "revise que el curso sigue registrado",
                icon: "error"
            }).then(() =>{
                location.href = "/categorias";
            });;
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
        
        if(allFieldsCorrect(state.correctFieldsCourse)){                
            const data = fieldsToDataForm();
            updateCourse(id, data);
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
