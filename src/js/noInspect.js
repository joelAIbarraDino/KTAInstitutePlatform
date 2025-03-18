(function(){
    document.addEventListener('contextmenu', event => event.preventDefault());
    
    document.addEventListener("copy", function(event){
        event.clipboardData.setData("text/plain", "No se permite copiar en esta página web");
        event.preventDefault();
    }, false);
})();
