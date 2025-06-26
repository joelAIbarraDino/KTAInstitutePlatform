(function(){

    const form = document.querySelector("#login-form");

    app();

    function app(){
        validateCredentials();
    }

    function validateCredentials(){
        form.addEventListener('submit', async (e)=>{
            e.preventDefault();

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
                formData.append("email", inputEmail);
                formData.append("password", inputPasword);

                const url = `/auth/login-callback`;

                const request = await fetch(url, {
                    method:"POST",
                    body: formData
                });

                const response = await request.json();

                if(!response.ok){
                    Swal.fire({
                        icon: "error",
                        title: "Error al autenticarse",
                        text: response.message,
                    });
                    return;
                }
                
                //redirigimos a la pagina de cursos del estudiante
                location.href = response.redirect_url;
                
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