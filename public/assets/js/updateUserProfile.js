(function(){

    const form = document.querySelector("#form-profile-data");

    app();

    function app(){
        validateCredentials();
    }

    function validateCredentials(){
        form.addEventListener('submit', async (e)=>{
            e.preventDefault();

            const inputName = document.querySelector("#name").value.trim();
            const inputPhone = document.querySelector("#phone").value.trim();
            const idStudent = document.querySelector("#id_student").value.trim();

            if(!idStudent){
                Swal.fire({
                    icon: "error",
                    title: "ID invalido",
                    text: "El ID de estudiante es obligatorio",
                });
                return;
            }

            if(!inputName){
                Swal.fire({
                    icon: "error",
                    title: "Nombre invalido",
                    text: "El nombre es obligatorio",
                });
                return;
            }

            if(!inputPhone){
                Swal.fire({
                    icon: "error",
                    title: "Numero invalido",
                    text: "El numero de telefono es inválido",
                });
                return;
            }

            //consulto si son correctas las credenciales
            try {

                const url = `/api/student/profile/${idStudent}`;

                const request = await fetch(url, {
                    method:"PATCH",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: inputName,
                        phone: inputPhone
                    })
                });

                const response = await request.json();

                if(!response.ok){
                    Swal.fire({
                        icon: "error",
                        title: "Error al actualizar"
                    });
                    return;
                }
                
                Swal.fire({
                    icon: "success",
                    title: "Actualización exitosa"
                });
                
            } catch (error) {
                console.log(error);
            }

        })
    }

})();