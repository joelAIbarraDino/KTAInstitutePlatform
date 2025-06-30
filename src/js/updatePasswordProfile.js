(function(){

    const form = document.querySelector("#form-profile-data");

    app();

    function app(){
        validateCredentials();
    }

    function validateCredentials(){
        form.addEventListener('submit', async (e)=>{
            e.preventDefault();

            const inputPassword = document.querySelector("#password").value.trim();
            const idStudent = document.querySelector("#id_student").value.trim();

            if(!idStudent){
                Swal.fire({
                    icon: "error",
                    title: "ID invalido",
                    text: "El ID de estudiante es obligatorio",
                });
                return;
            }

            if(!inputPassword){
                Swal.fire({
                    icon: "error",
                    title: "Contraseña invalida",
                    text: "La contraseña ingresada es invalida",
                });
                return;
            }

            //consulto si son correctas las credenciales
            try {

                const url = `/api/student/password/${idStudent}`;

                const request = await fetch(url, {
                    method:"PATCH",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        password: inputPassword
                    })
                });

                const response = await request.json();

                if(!response.ok){
                    Swal.fire({
                        icon: "error",
                        title: "Error al actualizar",
                        text: response.message,
                    }).then(() =>{
                        document.querySelector("#id_student").value = "";
                    });
                    return;
                }
                
                
                Swal.fire({
                    icon: "success",
                    title: "Actualización exitosa",
                    text: response.message,
                }).then(() =>{
                    document.querySelector("#id_student").value = "";
                })
                

            } catch (error) {
                console.log(error);
            }

        })
    }

})();