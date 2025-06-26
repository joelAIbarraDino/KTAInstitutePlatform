(function(){

    const form = document.querySelector("#signin-form");

    app();

    function app(){
        validateCredentials();
    }

    function validateCredentials(){
        form.addEventListener('submit', async (e)=>{
            e.preventDefault();

            const inputName = document.querySelector("#name").value.trim();
            const inputEmail = document.querySelector("#email").value.trim();
            const inputPasword = document.querySelector("#password").value.trim();

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

            if(!inputPasword){
                Swal.fire({
                    icon: "error",
                    title: "Contraseña invalida",
                    text: "La contraseña es obligatoria",
                });
                return;
            }

            //consulto si son correctas las credenciales
            try {

                const formData = new FormData();
                
                formData.append("name", inputName);
                formData.append("email", inputEmail);
                formData.append("password", inputPasword);

                const url = `/auth/sign-in`;

                const request = await fetch(url, {
                    method:"POST",
                    body: formData
                });

                const response = await request.json();

                if(!response.ok){
                    Swal.fire({
                        icon: "error",
                        title: "Error al registrarse",
                        text: response.message,
                    });
                    return;
                }
                
                Swal.fire({
                    icon: "success",
                    title: "Registro exitoso",
                    text: "Puede iniciar sesión",
                }).then((result) =>{
                    if(result.isConfirmed){
                        location.href = '/login';
                    }
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