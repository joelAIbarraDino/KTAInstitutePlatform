(function(){

    const btnDelete = document.querySelectorAll(".record__col-action-link");
    const alertaEliminar = (e) => {
        const id = e.target.dataset.id;
        Swal.fire({
            title: "¿esta seguro que quiere eliminar este curso?",
            text: "Tambien se eliminara todo el contenido del curso y es inreversible",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, eliminar",
            cancelButtonText: "Cancelar"
          }).then((result) => {
            if (result.isConfirmed)
                eliminarCurso(id);
              
            
          });
    }

    btnDelete.forEach(btn => {
        btn.addEventListener('click', alertaEliminar);
    });

    async function eliminarCurso(id){

        if(!id) return;

        const url = `/api/curso/delete/${id}`;

        const response = await fetch(url,{
            method:'delete'
        });

        const result = await response.json();

        if(result.ok){
            Swal.fire({
                title: `curso eliminado con exito`,
                icon: "success",
            }).then(() =>{
                location.reload();
            });
        }else{
            Swal.fire({
                title: `curso ${id} eliminado`,
                text:"Intente mas tarde",
                icon: "error",
            })
        }
    }
  
  })();