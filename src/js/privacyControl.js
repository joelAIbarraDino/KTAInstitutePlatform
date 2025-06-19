(function(){
    
    const btnPrivacy = document.querySelector("#btn-status");
    const privacy = ['Editando', 'Privado', 'Público', 'Desactivado'];
    const id_course = getCourseID();
    
    app();

    //funcion principal
    function app(){
        btnPrivacy.addEventListener('click', function(){
            alertUpdatePrivacy();
        })
    }
    
    function alertUpdatePrivacy(){
        const currentPrivacy = btnPrivacy.dataset.status;

        if(currentPrivacy == privacy[0] || currentPrivacy == privacy[1]){
            // Avisa de eliminar módulo
            Swal.fire({
                title: "Estas cambiando la privacidad del curso",
                text: "¿Estas seguro que quieres cambiar la privacidad a Público?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, publicalo"
            }).then((result) => {
                if (result.isConfirmed) 
                    updatePrivacy(privacy[2], currentPrivacy);
            });

            return;
        }

        if(currentPrivacy == privacy[2]){
            // Avisa de eliminar módulo
            Swal.fire({
                title: "Estas cambiando la privacidad del curso",
                text: "¿Estas seguro que quieres cambiar la privacidad a Privado?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, ocultalo"
            }).then((result) => {
                if (result.isConfirmed) 
                    updatePrivacy(privacy[1], currentPrivacy);
            });
        }
        
    }

    async function updatePrivacy(newPrivacy, currentPrivacy){

        try {
            const url = `/api/curso/privacy/${id_course}`;

            const request = await fetch(url, {
                method: 'PATCH',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({privacy: newPrivacy})
            });

            const response = await request.json();

            if(!response.ok){
                Swal.fire({
                    icon: "error",
                    title: "Ha ocurrido un error",
                    text: response.message,
                });
                return;
            }

            Swal.fire({
                title: "Privacidad de curso actualizado",
                text: response.message,
                icon: "success",
            });

            updateButton(newPrivacy, currentPrivacy);

        } catch (error) {
            console.log(error);
        }
    }

    function updateButton(privacy, currentPrivacy){
        btnPrivacy.classList.remove(currentPrivacy);
        btnPrivacy.classList.add(privacy);
        btnPrivacy.dataset.status = privacy;

        btnPrivacy.innerHTML = `<i class="bx bx-show"></i> ${privacy}`
    }

    //obtiene el id del curso obtendio de la url
    function getCourseID(){
        const path = window.location.pathname;
        const parts = path.split('/');

        const ID = parts[parts.length -1];

        return ID;
    }


})();