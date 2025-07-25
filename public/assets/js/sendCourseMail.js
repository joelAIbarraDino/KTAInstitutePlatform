async function  enviarCorreo(id_payment, id_student) {
    const button = document.querySelector("#button-sender");
    
    const datos = new FormData();
    datos.append('id_payment', id_payment);
    datos.append('id_student', id_student);
    
    try {
        const url = `/kta-admin/send_email/pago-cursos`;
        
        button.style.display = "none";
        document.body.style.cursor = 'wait';
        const consulta = await fetch(url, {
            method: 'POST',
            body: datos
        });

        const respuesta = await consulta.json();
        
        const resultado = respuesta.ok;
        
        if(resultado){
            Swal.fire({
                title: "¡enviado!",
                text: "se ha enviado un nuevo correo con exito",
                icon: "success"
            });
        }else{
            Swal.fire({
                title: "¡error!",
                text: "ha ocurrido un error al enviar el correo",
                icon: "error"
            });
        }

        button.style.display = "block";
        document.body.style.cursor = 'auto';
    } catch (error) {
        console.log(error);
    }
    

}
