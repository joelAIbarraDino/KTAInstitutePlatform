!function(){const s=document.querySelector("#btn-showPass");s.addEventListener("click",(function(o){const t=document.querySelector("#password");"password"===t.type?(t.type="text",s.classList.add("bx-low-vision"),s.classList.remove("bx-show")):(t.type="password",s.classList.remove("bx-low-vision"),s.classList.add("bx-show"))}))}();