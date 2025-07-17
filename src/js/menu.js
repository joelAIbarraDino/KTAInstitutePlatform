(function(){
    const menuBtn = document.querySelector("#btn-menu");
    const closeBtn = document.querySelector('#btn-close');
    const menu = document.querySelector("#menu");

    if(menuBtn){
        menuBtn.addEventListener('click', ()=>{
            menu.classList.toggle('nav-visble');
            document.querySelector('html').classList.toggle('no-scroll');
        });
    }

    if(closeBtn){
        closeBtn.addEventListener('click', ()=>{
            menu.classList.toggle('nav-visble');
            document.querySelector('html').classList.toggle('no-scroll');
        });
    }

})();
