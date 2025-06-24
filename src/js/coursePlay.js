const closeAsideBtn = document.querySelector("#aside__btn-close"); 
const aside = document.querySelector("#aside");
const asideContent = document.querySelector("#aside__content");
const classContent = document.querySelector("#class");
const tabs = document.querySelectorAll(".class__tab");
const nightModeBtn = document.querySelector("#night-mode-btn");
const modules = document.querySelectorAll("details.content-module");

let currentStep = 1;
let videoTerminado = false;

const player = new Plyr('#player', {
  vimeo: {
    byline: false,
    portrait: false,
    title: false,
    speed: true,
    transparent: false,
    rel:0
  }
});

window.addEventListener("DOMContentLoaded", ()=>{
  app();
});

function app(){
  //cargar ventana al modo guardado
  pageColor();
  //acciones plyr.js
  actionPlayer();
  //boton de cerrar aside
  beginButtons();

  beginModules(modules);
}

function actionPlayer(){
  player.on('timeupdate', () => {
    const current = player.currentTime;
    const duration = player.duration;

    if (duration > 0) {
      const percent = (current / duration) * 100;
      
      if(percent > 90 && !videoTerminado){
          leccionCompleted();
          videoTerminado = true;
      }

      if(percent == 100 && videoTerminado){
        let timerInterval;

        Swal.fire({
          title: "¡Lección terminada!",
          html: "La siguiente ección empieza en <b>10</b> segundos",
          timer: 10000,
          timerProgressBar: true,
          showCloseButton: true,
          showCancelButton: true,
          focusConfirm: false,
          confirmButtonColor: '#CDA02D', 
          confirmButtonText: `<i class='bx bxs-hand-right' style='color:#fff'></i> ¡Vamos!`,
          cancelButtonColor: '#000000', 
          cancelButtonText: `Me quedo en la lección`,
          backdrop: `
            rgba(0, 0, 0, 0.6)
          `,
          didOpen: () => {
              const timer = Swal.getPopup().querySelector("b");
              timerInterval = setInterval(() => {
                  timer.textContent = `${Math.ceil(Swal.getTimerLeft() / 1000)}`; // Muestra segundos enteros
              }, 100);
          },
          willClose: () => {
              clearInterval(timerInterval);
          }

        }).then((result) => {
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log("cargando DOM de la siguiente clase");
            }
        });

      }
    }
  });
}

function beginButtons(){
  setTabs();
  setDarkModeBtn();
  setCloseAsideBtn();

}


function setTabs(){
  //cambiar tabs
  tabs.forEach(btn=>{
      btn.addEventListener('click', function(e){
          const newStep = e.target.dataset.step;

          const currentElement = document.querySelector(`#step-${currentStep}`);
          const newElement = document.querySelector(`#step-${newStep}`);
          
          const currentBtn = document.querySelector(`[data-step="${currentStep}"]`);
          const newBtn = document.querySelector(`[data-step="${newStep}"]`);

          currentElement.classList.remove("class__extra--active");
          newElement.classList.add("class__extra--active");
          
          currentStep = newStep;


          currentBtn.classList.remove("class__tab--active");
          newBtn.classList.add("class__tab--active");
      });
  });

}

function setDarkModeBtn(){
  //cambiar ventana a modo oscuro
  nightModeBtn.addEventListener("click", (e)=>{

    const classSelected = e.target.classList;
    console.log(e.target.classList);

    if(classSelected.contains("dark-mode") || classSelected.contains("bx-moon"))
      darkDOM(false);
    else
      darkDOM(true);

  });
}

function setCloseAsideBtn(){
  closeAsideBtn.addEventListener('click', ()=>{
    aside.classList.toggle("aside--close");
    classContent.classList.toggle("class--active");
    asideContent.classList.toggle("aside__content--close");
    closeAsideBtn.classList.toggle("aside__btn-close--rotate");
  });
}

function pageColor(){
  const colorMode = localStorage.getItem("darkMode");

  if(colorMode === 'true'){
    darkDOM(true);
  }else{
    darkDOM(false);
  }
}

function darkDOM(darkMode){

  const nightModeIcon = document.querySelector("#night-mode-icon");
  const classContainer = document.querySelector(".class");

  if(darkMode){
    nightModeBtn.classList.remove("light-mode");
    nightModeBtn.classList.add("dark-mode");
    
    nightModeIcon.classList.remove("bx-sun");
    nightModeIcon.classList.add("bx-moon");
    
    classContainer.classList.add("class-dark-mode");
    aside.classList.add("aside-dark-mode")

    localStorage.setItem("darkMode", true);
  }else{
    nightModeBtn.classList.add("light-mode");
    nightModeBtn.classList.remove("dark-mode");
  
    nightModeIcon.classList.add("bx-sun");
    nightModeIcon.classList.remove("bx-moon");
  
    classContainer.classList.remove("class-dark-mode");
    aside.classList.remove("aside-dark-mode")
  
    localStorage.setItem("darkMode", false);
  }
  

}

function beginModules(modulesElements){
  modulesElements.forEach(moduleElement =>{
    beginModule(moduleElement);
  });

}

function beginModule(moduleElement){
  const sumary = moduleElement.querySelector("summary");
  const content = moduleElement.querySelector(".content-module__lessons");

  sumary.addEventListener("click", (e)=>{
    e.preventDefault();

    const isOpen = moduleElement.hasAttribute("open");

    moduleElement.classList.add("animating");

    if(isOpen){
      const height = content.scrollHeight;
      content.style.height = height + "px";

      requestAnimationFrame(()=>{
        content.style.height = "0px";
      });

      setTimeout(() => {
        moduleElement.removeAttribute("open");
        moduleElement.classList.remove("animating");
      }, 500);

    }else{
      moduleElement.setAttribute("open", "");
      
      const height = content.scrollHeight;
      content.style.height = "0px";

      requestAnimationFrame(() => {
        content.style.height = height + "px";
      });

      setTimeout(() => {
        content.style.height = "auto";
        moduleElement.classList.remove("animating");
      }, 500);
    }

  });
}

function leccionCompleted(){
  const headerLeccion = document.querySelector(".class__info-container");

  const containerMessage = document.createElement("div");
  containerMessage.classList.add("class__completed-lesson");
  containerMessage.innerHTML = `<i class='bx bxs-party bx-tada' ></i>¡Lección terminada!`;
  headerLeccion.appendChild(containerMessage);

  setTimeout(() => {    
    headerLeccion.removeChild(containerMessage);
  }, 2500);

}