(function(){

    const cb = document.querySelector('#type_background')

    if(cb){
        cb.addEventListener('change', (e)=>{
            const value = e.target.value;

            if(value == "video"){
                document.querySelector('#input-image').classList.add('no-show-input');
                document.querySelector('#input-vimeo').classList.remove('no-show-input');
            }else if(value == "picture"){
                document.querySelector('#input-image').classList.remove('no-show-input');
                document.querySelector('#input-vimeo').classList.add('no-show-input');
            }

        });
    }

})();