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
            updatePrivacy(privacy[2], currentPrivacy);
            return;
        }

        if(currentPrivacy == privacy[2]){
            updatePrivacy(privacy[1], currentPrivacy);
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