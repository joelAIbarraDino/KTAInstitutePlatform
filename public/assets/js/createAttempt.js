(function(){

    const attemptBtn = document.querySelector('#new-attempt');

    window.addEventListener("DOMContentLoaded", ()=>{
        app();
    });

    function app(){
        createAttempt();
    }

    function createAttempt(){
        attemptBtn.addEventListener('click', ()=>{
            Swal.fire({
                title: "Iniciando quiz",
                text: "¿Estas seguro de que quieres iniciar el quiz?",
                icon: "info",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: 'Todavia no',
                confirmButtonText: "Si, Empecemos"
            }).then((result) => {
                if (result.isConfirmed) 
                    newAtempt();
            });

        });
    }
    
    async function newAtempt(){
        try{
            const id = getCourseID();
            const url = `/attempts/create/${id}`;

            const request = await fetch(url, {
                method:'POST'
            })            

            const response = await request.json();

            if(!response.ok){
                Swal.fire({
                    title: "Error",
                    text: response.message,
                    icon: "error"
                })
                return;
            }

            window.location = `/quiz/answer/${id}/${response.id}`;

        }catch(error){
            console.log(error);
        }
    }

    function getCourseID(){
        const path = window.location.pathname;
        const parts = path.split('/');

        const ID = parts[parts.length -1];

        return ID;
    } 

})();