(function(){

    const btnDelete = document.querySelectorAll(".dashboard-table__action--delete");
    const alertaEliminar = (e) => {
        const id = e.target.dataset.id;
        Swal.fire({
            title: "¿esta seguro que quiere eliminar esta membresia?",
            text: "Este proceso no es reversible",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar"
          }).then((result) => {
            if (result.isConfirmed)
                eliminarMembresia(id);
          });
    }

    btnDelete.forEach(btn => {
        btn.addEventListener('click', alertaEliminar);
    });

    async function eliminarMembresia(id){

        if(!id) return;

        const url = `/api/membresia/delete/${id}`;

        const response = await fetch(url,{
            method:'delete'
        });

        const result = await response.json();

        if(result.ok){
            Swal.fire({
                title: `Membresía eliminada con exito`,
                icon: "success",
            }).then(() =>{
                location.reload();
            });
        }else{
            Swal.fire({
                title: `error al eliminar la membresía`,
                text:"Esta membresía esta asignada a estudiantes",
                icon: "error",
            })
        }
    }
  
  })();