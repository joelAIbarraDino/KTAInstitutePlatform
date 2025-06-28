// Función para inicializar el acordeón en un módulo específico
export function initAccordion(modulo) {
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
export function capitalize(str){
    return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
}

//obtiene el id del curso obtendio de la url
export function getCourseID(){
    const path = window.location.pathname;
    const parts = path.split('/');

    const ID = parts[parts.length -1];

    return ID;
}

//limpia contenedor de modulos
export function clearQuizContainer(){
    while(quizContainer.firstChild)
        quizContainer.removeChild(quizContainer.firstChild);
}

export function clearElementContainer(element){
    while(element.firstChild)
        element.removeChild(element.firstChild);
}

export function changeAlert(type, message = ""){
    
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

export function resetAlert(){
    setTimeout(() => {
        changeAlert('waiting')
    }, 5000);
}