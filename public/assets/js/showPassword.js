(function(){

    showPassword();

    function showPassword(){
        const btnShow = document.querySelector('#btn-showPass');
        
        btnShow.addEventListener('click', function(e){
            const passwordInput = document.querySelector('#password');

            if(passwordInput.type === "password"){
                passwordInput.type = "text";
                btnShow.classList.add("bx-low-vision");
                btnShow.classList.remove("bx-show");

            }else{
                passwordInput.type = "password";
                btnShow.classList.remove("bx-low-vision");
                btnShow.classList.add("bx-show");
            }
            
        });

    }
    

    
})();
