import {API_delete} from '/assets/js/modules/api.js';
import {FormValidator} from '/assets/js/modules/validateForm.js';

const btnDelete = document.querySelectorAll(".dashboard-table__action--delete");
const newForm = document.querySelector(".new-form-teacher");

const alertaEliminar = (e) => {

    const id = e.target.dataset.id;
    
    Swal.fire({
        title: "¿esta seguro que quiere eliminar este registro?",
        text: "Este proceso no es reversible",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar"
        }).then((result) => {
        if (result.isConfirmed)
            API_delete('/api/maestro/delete', id);
        });
}

if(btnDelete)
    btnDelete.forEach(btn => btn.addEventListener('click', alertaEliminar));

if(newForm){
    document.addEventListener('DOMContentLoaded', () => {
        // Validador para el formulario de registro
        new FormValidator({
          formId: 'new-form-teacher',
          submitButtonId: 'new-teacher-btn',
          fields: {
            nombre: {
              type: 'text',
              required: true,
              minLength: 3
            },
            email: {
              type: 'email',
              required: true
            },
            password: {
              type: 'text',
              required: true,
              minLength: 8
            }
          },
          messages: {
            required: 'Campo requerido',
            email: 'Por favor ingresa un email válido'
          }
        });
      
      });
}



