import {API_delete} from '/assets/js/modules/api.js';

const btnDelete = document.querySelectorAll(".dashboard-table__action--delete");

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
            API_delete('/api/estudiante/delete', id);
        });
}

btnDelete.forEach(btn => {
    btn.addEventListener('click', alertaEliminar);
});

  