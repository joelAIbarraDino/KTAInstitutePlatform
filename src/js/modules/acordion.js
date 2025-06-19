// Módulo para manejo de acordeones
export function initAccordion(element) {
    const summary = element.querySelector("summary");
    const content = element.querySelector(".acordeon__contenido");

    if (!summary || !content) return;

    summary.addEventListener("click", (e) => {
        e.preventDefault();

        if (!e.target.classList.contains("module__header")) return;

        const isOpen = element.hasAttribute("open");
        element.classList.add("animating");

        if (isOpen) {
            const height = content.scrollHeight;
            content.style.height = height + "px";

            requestAnimationFrame(() => {
                content.style.height = "0px";
            });

            setTimeout(() => {
                element.removeAttribute("open");
                element.classList.remove("animating");
            }, 400);
        } else {
            element.setAttribute("open", "");
            const height = content.scrollHeight;
            content.style.height = "0px";

            requestAnimationFrame(() => {
                content.style.height = height + "px";
            });

            setTimeout(() => {
                content.style.height = "auto";
                element.classList.remove("animating");
            }, 400);
        }
    });
}