(function(){

    let step = 1;

    const formCourse = document.querySelector("#form-course");
    const inputsCourse = document.querySelectorAll('#form-course input,textarea');
    const comboBox = document.querySelectorAll('#form-course select');
    
    const textRule = /^[a-zA-ZÀ-ÿ\s]{1,40}$/;
    const positiveIntRule = /^\d+$/;
    const floatRule = /^(\d+)(\.\d{1,2})*$/;
    const longTextRule =/^[a-zA-ZÀ-ÿ\s]+$/;
    const dateRule =/^\d{4}-\d{2}-\d{2}$/;
    const percentRule = /^(100(\.0{1,2})?|\d{1,2}(\.\d{1,2})?|0(\.\d{1,2})?)%?$/i;

    const requiredRules= {
        name:textRule,
        watchword:textRule,
        desc:percentRule,
        max_months_enroll:positiveIntRule,
        price:floatRule,
        discount:floatRule,
        discount_ends:dateRule,
    };

    const correctFields = {
        name:false,
        watchword:false,
        price:false,
        discount:false,
        desc:false,
        max_months_enroll:false
    }

    const validateInput = (e) => {
        const element = e.target;
        const input = element.value;
        const name = e.target.name;
        const regex = requiredRules[name];
        const msgElement = document.querySelector(`#msg-${name}`);

        if(element.hasAttribute("required") || input != ""){
            validateField(input, regex, name, msgElement);
        }

        if(name === "desc"){
            if(input.length < 80){
                msgElement.classList.add("show", "error");
                msgElement.textContent = "la descripcion debe tener al menos 80 caracteres";
                correctFields[name] = false;
            }
        }

        if(name === "discount"){
            const date = document.querySelector("#discount_ends");
            const msgElementDate = document.querySelector(`#msg-${date.name}`);

            if(input != ""){
                validateField(input, regex, name, msgElement);
                validateDate(date.value, requiredRules[date.name], date.name, msgElementDate);
            }else{
                msgElementDate.classList.remove("show", "error");
                msgElementDate.textContent = "";
                correctFields[date.name] = true;
            }
        }

        if(name === "discount_ends"){
            validateField(input, regex, name, msgElement);
        }

    }
    
    const validateCB = (e) => {
        console.log("valor cambiado")
        const element = e.target;
        const input = element.value;
        const name = e.target.name;
        const msgElement = document.querySelector(`#msg-${name}`);
        
        if(input ==="" && element.hasAttribute("required")){
            msgElement.classList.add("show", "error");
            msgElement.textContent = "Valor ingresado invalido";
            correctFields[name] = false;
        }else{
            msgElement.classList.remove("show", "error");
            msgElement.textContent = "";
            correctFields[name] = true;
        }
    }

    tabs();
    formCourseValidate();

    function tabs(){
        const tabs = document.querySelectorAll('#tabs button');

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e){
                
                //solo actualiza el paso a botones activados
                if(e.target.classList.contains("tabs__tab--disable"))
                    return;

                step = parseInt(e.target.dataset.step);

                showSection();
            });
        });

    }
    
    function showSection(){

        //oculto la seccion actual
        const activeSection = document.querySelector(".tabs__section.active");
        activeSection.classList.remove("active");

        //desactivo el tab de la seccion actual
        const activeTab = document.querySelector(".tabs__tab--active");
        activeTab.classList.remove("tabs__tab--active");

        //mostrar la nueva seccion
        const nextSection = document.querySelector(`#step-${step}`);
        nextSection.classList.add("active");

        //activo el tab de la nueva seccion
        const nextTab = document.querySelector(`[data-step="${step}"]`);
        nextTab.classList.add("tabs__tab--active");

    }

    function formCourseValidate(){
        inputsCourseForms();
    }

    function inputsCourseForms(){

        inputsCourse.forEach(input =>{
            input.addEventListener('keyup', validateInput);
            input.addEventListener('blur', validateInput);
        });

        comboBox.forEach(input =>{
            input.addEventListener('change', validateCB);
        });
    }

    function validateDate(input, regex, name, msgElement){
        if(!regex.test(input)){
            msgElement.classList.add("show", "error");
            msgElement.textContent = "fin de promocion requerido";
            correctFields[name] = false;
        }else{
            msgElement.classList.remove("show", "error");
            msgElement.textContent = "";
            correctFields[name] = true;
        }    
    }

    function validateField(input, regex, name, msgElement){
        if(!regex.test(input)){
            msgElement.classList.add("show", "error");
            msgElement.textContent = "Valor ingresado invalido";
            correctFields[name] = false;
        }else{
            msgElement.classList.remove("show", "error");
            msgElement.textContent = "";
            correctFields[name] = true;
        }    
    }
    
})();


