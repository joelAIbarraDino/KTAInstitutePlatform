(function(){
    const page = document.querySelector("body");
    const menuBtn = document.querySelector(".menu-btn");
    const menuClose = document.querySelector(".btn-close");
    const menu = document.querySelector(".menu-mobile");

    menu.onclick = function(e){
        var target = e.target;
        if(target.classList.contains("menu-mobile")){
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
