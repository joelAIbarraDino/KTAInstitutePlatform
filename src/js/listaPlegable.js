(function(){
  document.querySelectorAll("details.acordeon__modulo").forEach((modulo) => {
    const summary = modulo.querySelector("summary");
    const content = modulo.querySelector(".acordeon__contenido");

    summary.addEventListener("click", (e) => {
      e.preventDefault(); // Evita el comportamiento nativo
      
      const isOpen = modulo.hasAttribute("open");

      modulo.classList.add("animating");

      if (isOpen) {
        const height = content.scrollHeight;
        content.style.height = height + "px";

        requestAnimationFrame(() => {
          content.style.height = "0px";
        });

        setTimeout(() => {
          modulo.removeAttribute("open");
          modulo.classList.remove("animating");
        }, 400);
      } else {
        modulo.setAttribute("open", "");
        const height = content.scrollHeight;
        content.style.height = "0px";

        requestAnimationFrame(() => {
          content.style.height = height + "px";
        });

        setTimeout(() => {
          content.style.height = "auto";
          modulo.classList.remove("animating");
        }, 400);
      }
    });
  });
})();