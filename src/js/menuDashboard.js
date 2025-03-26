(function(){
    const page = document.querySelector("body");
    const menuBtn = document.querySelector(".toolbar-left__btn");
    const menuClose = document.querySelector(".btn-close");
    const menu = document.querySelector(".toolbar-menu");

    menu.onclick = function(e){
        var target = e.target;
        if(target.classList.contains("toolbar-menu")){
            menu.classList.remove("active");
            page.classList.remove("no-scroll");
        }
    }

    menuBtn.onclick = function(){
        menu.classList.add("active");
        page.classList.add("no-scroll");
    }

    menuClose.onclick = function(){
        menu.classList.remove("active");
        page.classList.remove("no-scroll");
    }
})();
