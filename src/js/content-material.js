(function(){
    const form = document.querySelector("#form-material");
    const nameInput = document.querySelector("#name_file");
    const lesson = document.querySelector("#lesson");
    const file = document.querySelector("#file_material");
    const fileName = document.querySelector('.name-file');
    const materialContainer = document.querySelector("#modules-container");

    let materials =[];

    app();

    function app(){
        getMaterials();
        setForm();
    }


    function setForm(){

        form.addEventListener('submit', (e) =>{
            e.preventDefault();

            const nameFile = nameInput.value;
            const lessonValue = lesson.value;
            const fileValue = file.files[0];

            if(!nameFile){
                Swal.fire({
                    icon: "error",
                    title: "Nombre invalido",
                    text: "Debe ingresar el nombre del archivo",
                });
                return;
            }

            if(!lessonValue){
                Swal.fire({
                    icon: "error",
                    title: "Leccion invalida",
                    text: "Debe seleccionar a que leccion pertenece el material",
                });
                return;
            }

            if(!fileValue){
                Swal.fire({
                    icon: "error",
                    title: "Archivo invalido",
                    text: "Debe subir un archivo",
                });
                return;
            }

            addMaterial(nameFile, lessonValue, fileValue);
        });

    }

    async function getMaterials(){
        try {
            const id = getCourseID();
            const url = `/api/materials/${id}`;

            const request = await fetch(url);
            const response = await request.json();
            materials = response.materials;

            showMaterials();

        } catch (error) {
            console.log(error);
        }
    }

    async function addMaterial(nameFile, lessonValue, fileValue){
        const url = `/api/material/create`;
        
        const formData = new FormData();
        formData.append('name', nameFile);
        formData.append('id_lesson', lessonValue);
        formData.append('file', fileValue);

        try {
            const request = await fetch(url, {
                method: 'POST',
                body: formData
            });

            const response = await request.json();

            if(!response.ok){
                Swal.fire({
                    icon: "error",
                    title: "Ocurrio un error",
                    text: response.message,
                });
                form.reset();
                fileName.textContent = "";
                return;
            }

            Swal.fire({
                icon: "success",
                title: "Exito",
                text: "Exito al registrar material",
            });

            form.reset();
            fileName.textContent = "";

            const materialObject = {
                id_material: response.id,
                name: nameFile,
                type:"file",
                url_file:response.url_file,
                id_lesson:lessonValue
            };

            materials = [...materials, materialObject];
            showMaterials();
            form.reset();
            fileName.textContent = "";

        } catch (error) {
            console.log(error)
        }
    }

    async function deleteMaterial(material) {
        const {id_material} = material;

        try {
            const url = `/api/material/delete/${id_material}`;

            const request = await fetch(url, {
                method: 'DELETE'
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

            Swal.fire({
                icon: "success",
                title: "Lección eliminada con exito",
                text: response.message,
            });

            materials = materials.filter(material => material.id_material != id_material);
            showMaterials();

        } catch (error) {
            console.log(error);
        }
    }

    function showMaterials(){
        clearMaterialContainer();

        if(materials.length === 0)
            return;

        materials.forEach(material =>{
            let materialElement = createElement(material);
            materialContainer.appendChild(materialElement);
        });

    }

    function createElement(material){
        const divMaterial = document.createElement("div");
        divMaterial.classList.add("material__element");

        const nameMaterial = document.createElement("p");
        nameMaterial.textContent = material.name || "";

        const deleteButton = document.createElement("button");
        deleteButton.type ="button";
        deleteButton.classList.add("module__btn", "module__btn--eliminar");
        deleteButton.innerHTML = "<i class='bx bx-trash'></i>";
        deleteButton.onclick = function (){
            Swal.fire({
                title: "Estas seguro que quieres eliminar este material",
                text: "Este proceso no se puede revertir",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminalo"
            }).then((result) => {
                if (result.isConfirmed) 
                    deleteMaterial(material);
            });
        }

        divMaterial.appendChild(nameMaterial);
        divMaterial.appendChild(deleteButton);

        return divMaterial;
    }

    function getCourseID(){
        const path = window.location.pathname;
        const parts = path.split('/');

        const ID = parts[parts.length -1];

        return ID;
    }

    function clearMaterialContainer(){
        while(materialContainer.firstChild)
            materialContainer.removeChild(materialContainer.firstChild);
    }


})();