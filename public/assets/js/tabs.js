(function(){
    //elementos del tab
    const tabs = document.querySelectorAll(".btn_tab");
    let currentStep = 1;

    tabs.forEach(btn=>{
        btn.addEventListener('click', function(e){
            const newStep = e.target.dataset.step;

            const currentElement = document.querySelector(`#step-${currentStep}`);
            const newElement = document.querySelector(`#step-${newStep}`);
            
            const currentBtn = document.querySelector(`[data-step="${currentStep}"]`);
            const newBtn = document.querySelector(`[data-step="${newStep}"]`);

            currentElement.classList.remove("detalles-curso__content--active");
            newElement.classList.add("detalles-curso__content--active");
            
            currentStep = newStep;


            currentBtn.classList.remove("detalles-curso__tab--active");
            newBtn.classList.add("detalles-curso__tab--active");
        });
    });

})();