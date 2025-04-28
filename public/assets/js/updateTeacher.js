import {showError, showSuccess, allFieldsCorrect} from '/assets/js/modules/validateForm.js';

// ============== CONFIGURACIÓN PRINCIPAL ==============
const state = {
    correctFieldsTeacher: {
        photo:false,
        name: false,
        email: false,
        speciality: false,
        experience: false,
        password: false,
        bio:false
    }
};

let teacher = {};
// ============== ELEMENTOS DEL DOM ==============
const DOM = {
    formTeacher: document.querySelector("#form-teacher"),
    fieldsTeacher: document.querySelectorAll('#form-teacher input,textarea'),
    fieldFilePhoto: document.querySelector("#photo"),
    fileName: document.querySelector('#msg-photo'),
    customFileButton: document.querySelector('#photo-btn'),
    realFileButtom : document.querySelector('#photo')
};

// ============== REGLAS DE VALIDACIÓN ==============
const fieldRulesCourse = {
    name: /^(?!\d)[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]+$/,
    email:  /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/,
    speciality: /^(?!\d)[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]+$/,
    experience: /^\d+$/,
    password: /^(?!\d)[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]+$/
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
    
    if(['name', 'email', 'speciality', 'experience', 'password'].includes(name))
        validateRegex(field);
    

    if(name === "bio")
        validateText(field, 100)
    
}

function validateTeacherFile(e) {
    const file = e.target.files[0];
    const maxSize = 5 * 1024 * 1024; // 5MB
    
    if (!file) {
        showError(DOM.fileName, 'No se ha seleccionado ningún archivo');
        state.correctFieldsTeacher.photo = false;
        return;
    }
    
    if (file.size > maxSize) {
        showError(DOM.fileName, 'El archivo es demasiado grande (máx. 5MB)');
        state.correctFieldsTeacher.photo = false;
        return;
    }
    
    if (!file.type.match('image.*')) {
        showError(DOM.fileName, 'Solo se permiten imágenes');
        state.correctFieldsTeacher.photo = false;
        return;
    }
    
    showSuccess(DOM.fileName, file.name);
    state.correctFieldsTeacher.photo = true;
}
// ============== HELPERS ==============
function getErrorMessage(fieldName) {
    const messages = {
        name: "Solo se admite texto en este campo",
        email: "Debe ingresar un correo valido",
        speciality: "Solo se admite texto en este campo",
        experience: "Solo se admite numeros en este campo",
        password: "Solo se admite texto en este campo"
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
        state.correctFieldsTeacher[name] = false;
    } else {
        showSuccess(labelMessage, "")
        state.correctFieldsTeacher[name] = true;
    }
}

function validateText(element, min){
    const name = element.name;
    const value = element.value.trim();
    const labelMessage = document.querySelector(`#msg-${name}`);
    if(value.length < min){
        showError(labelMessage, `El texto debe tener al menos ${min} caracteres`)
        state.correctFieldsTeacher[name] = false;
    }else{
        showSuccess(labelMessage, "")
        state.correctFieldsTeacher[name] = true;
    }
}

function fieldsToDataForm(){
    const formData = new FormData();
    const rawData = {};
        
    //captura los valores de los campos input excepot submit
    DOM.fieldsTeacher.forEach(field => {
        if(field.type != "submit")
            rawData[field.name] = field.value;
    });
    
    //convertir objeto en json para hacer la conversión
    teacher = JSON.parse(JSON.stringify(rawData, (key, value) => {
        // Conversión manual para campos numéricos
        if(['experience'].includes(key))
            return value ? parseFloat(value) : null;

        return value === "" ? null : value;
    }));
    
    Object.entries(teacher).forEach(([key, value]) =>{    
        formData.append(key, value);
    });

    return formData;
}

async function updateTeacher(id, data){
    const url = "/api/maestro/create";

    try{
        const response = await fetch(url, {
            method: 'POST',
            body: data
        });

        const result = await response.json();

        if(result.id){
            //muestro alerta de que se creo el curso
            Swal.fire({
                title: "Maestro registrado correctamente",
                icon: "success"
            }).then(() =>{
                location.href = "/maestros";
            });
            
        }else{
            //ocurrio un error al guardar los datos
            Swal.fire({
                title: "Error al registrar el maestro",
                text: "intente mas tarde",
                icon: "error"
            });
            //mostramos los mensajes en cada campo señalado por la api si es que hay
            if(result.alerts){
                Object.entries(result.alerts).forEach(([name, msg]) =>{    
                    const labelMessage = document.querySelector(`#msg-${name}`);
                    showError(labelMessage, msg);
                    state.correctFieldsTeacher[name] = false;
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
    DOM.fieldsTeacher.forEach(input => {
        input.addEventListener('keyup', validateField);
        input.addEventListener('blur', validateField);
    });

    DOM.customFileButton.addEventListener('click', () => {
        DOM.realFileButtom.click();
      });

    DOM.fieldFilePhoto.addEventListener('change', validateTeacherFile);
}

function setupFormSubmit() {
    DOM.formTeacher.addEventListener('submit', async function(e){
        e.preventDefault();
        
        if(allFieldsCorrect(state.correctFieldsTeacher)){                
            const data = fieldsToDataForm();
            updateTeacher(data);
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