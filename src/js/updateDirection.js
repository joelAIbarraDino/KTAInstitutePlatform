(function(){

    const form = document.querySelector("#form-profile-data");

    app();

    function app(){
        validateCredentials();
    }

    function validateCredentials(){
        form.addEventListener('submit', async (e)=>{
            e.preventDefault();

            const idStudent = document.querySelector("#id_student").value.trim();
            
            const inputStreet = document.querySelector("#street").value.trim();
            const inputnumberStreet = document.querySelector("#number_street").value.trim();
            const inputState = document.querySelector("#state").value.trim();
            const inputCP = document.querySelector("#cp").value.trim();

            if(!idStudent){
                Swal.fire({
                    icon: "error",
                    title: "ID invalido",
                    text: "El ID de estudiante es obligatorio",
                });
                return;
            }

            if(!inputStreet){
                Swal.fire({
                    icon: "error",
                    title: "Calle invalida",
                    text: "La calle es obligatorio",
                });
                return;
            }

            if(!inputnumberStreet){
                Swal.fire({
                    icon: "error",
                    title: "Numero invalido",
                    text: "El numero de calle es obligatorio",
                });
                return;
            }

            if(!inputState){
                Swal.fire({
                    icon: "error",
                    title: "Estado invalido",
                    text: "El estado es obligatorio",
                });
                return;
            }

            if(!inputCP){
                Swal.fire({
                    icon: "error",
                    title: "CP invalido",
                    text: "El CP es obligatorio",
                });
                return;
            }

            //consulto si son correctas las credenciales
            try {

                const url = `/api/student/direction/${idStudent}`;

                const request = await fetch(url, {
                    method:"PATCH",
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        street: inputStreet,
                        number_street: inputnumberStreet,
                        state: inputState,
                        cp: inputCP
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