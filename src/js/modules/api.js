async function API_delete(endpoint, id){
    
    if(!id || !endpoint) return;

    const url = `${endpoint}/${id}`;

    try{
        const response = await fetch(url,{
            method:'delete'
        });
    
        const result = await response.json();

        if(!result.ok){
            Swal.fire({
                title: `Error al eliminar registro`,
                text:result.msg,
                icon: "error",
            })
            return;
        }

    }catch(error){
        Swal.fire({
            title: `Error al eliminar registro`,
            text:result.msg,
            icon: "error",
        })
        return;
    }

    Swal.fire({
        title: `Registro eliminado con exito`,
        icon: "success",
    }).then(() =>{
        location.reload();
    });
}

async function API_post(endpoint, dataform) {

    if(!endpoint || !dataform)return;
    
    const result = null;

    try{
        const response = await fetch(endpoint,  {
            method:'post',
            body: dataform
        });
    
        result = await response.json();
        
    }catch(error){
        return null;
    }

    return result;
}

async function API_updateFile(endpoint, nameAttribute, file){
    
    if(!endpoint || !file)return;

    const formData = new FormData();
    formData.append(nameAttribute, file);

    const response = await fetch(endpoint,  {
        method:'post',
        body:formData
    });

    const result = await response.json();

    return result;
    
}

export {API_delete, API_post, API_updateFile};