function showError(element, message) {
    element.textContent = message;
    element.classList.add("error", "show");
    element.classList.remove("correct");
}

function showSuccess(element, message) {
    element.textContent = message;
    element.classList.add("correct", "show");
    element.classList.remove("error");
}

function allFieldsCorrect(validFields){
    let allCorrect = true;

    Object.entries(validFields).forEach(([key, value]) =>{                
        if(!value){
            const labelMessage = document.querySelector(`#msg-${key}`);
            showError(labelMessage, "este campo es obligatorio");
            allCorrect = false;
        }
    });

    return allCorrect;
}


export {showError, showSuccess, allFieldsCorrect};