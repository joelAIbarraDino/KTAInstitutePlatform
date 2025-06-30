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
            const inputEmail = document.querySelector("#email").value.trim();
            const idStudent = document.querySelector("#id_student").value.trim();

            if(!idStudent){
                Swal.fire({
                    icon: "error",
                    title: "ID invalido",
                    text: "El ID de estudiante es obligatorio",
                });
                return;
            }

            if(!validarEmail(inputEmail)){
                Swal.fire({
                    icon: "error",
                    title: "Correo invalido",
                    text: "El correo ingresado no es correcto",
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

            //consulto si son correctas las credenciales
            try {

                const url = `/api/student/update/${idStudent}`;

                const request = await fetch(url, {
                    method:"PATCH",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: inputName,
                        email: inputEmail,
                    })
                });

                const response = await request.json();

                if(!response.ok){
                    Swal.fire({
                        icon: "error",
                        title: "Error al actualizar",
                        text: response.message,
                    });
                    return;
                }
                
                Swal.fire({
                    icon: "success",
                    title: "Actualización exitosa",
                    text: response.message,
                });
                
            } catch (error) {
                console.log(error);
            }

        })
    }

    function validarEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

})();