// Módulo para manejo de alertas
export function showSwalAlert(type, title, text) {
    return Swal.fire({
        icon: type,
        title: title,
        text: text
    });
}

export function showSwalConfirm(title, text, confirmText = 'Confirmar') {
    return Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: confirmText
    });
}

export function changeAlert(container, type, message = '') {
    container.className = '';
    container.classList.add('course-info__saved', `course-info__saved--${type}`);
    
    const icons = {
        success: 'bx bx-cloud-upload',
        inProcess: 'bx bxs-cloud-upload bx-flashing',
        error: 'bx bx-error-circle',
        warning: 'bx bx-error-circle',
        waiting: 'bx bx-cloud'
    };
    
    container.innerHTML = `<i class='${icons[type] || 'bx bx-check-circle'}'></i> ${message}`;
}

export function resetAlert(container) {
    setTimeout(() => {
        changeAlert(container, 'waiting');
    }, 5000);
}

export function btnExitMessage(btnExit){
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
