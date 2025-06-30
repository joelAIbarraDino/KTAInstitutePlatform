(function(){

  const closeAsideBtn = document.querySelector("#aside__btn-close"); 
  const aside = document.querySelector("#aside");
  const asideContent = document.querySelector("#aside__content");
  const classContent = document.querySelector("#class");
  const tabs = document.querySelectorAll(".class__tab");
  const nightModeBtn = document.querySelector("#night-mode-btn");

  const modulesContainer = document.querySelector('.aside__modules');

  let currentStep = 1;
  let videoTerminado = false;

  let modules = [];
  let lessons = [];

  let currentLesson = 0;
  let player = new Plyr('#player');

  window.addEventListener("DOMContentLoaded", ()=>{
    app();
  });

  function app(){
    //carga contenido
    getContent();
    //cargar ventana al modo guardado
    pageColor();
    //boton de cerrar aside
    beginButtons();

  }

  async function getContent(){
    try {
      const id = getCourseID();
      const url = `/api/curso/enroll/${id}`;

      const request = await fetch(url);
      const response = await request.json();
      modules = response.modules;
      lessons = response.lessons;

      showModules();

      showLesson(modules[currentLesson], modules[currentLesson].lessons[currentLesson]);

    } catch (error) {
        console.log(error);
    }
  }

  function showModules(){
    clearModules();

    if(modules.length == 0)
      return;

    modules.forEach((module, index)=>{
      let newModule = createModule(module, index);
      modulesContainer.appendChild(newModule);
      beginModule(newModule);
    })

  }

  function createModule(module, index){
    const detailsElement = document.createElement('details');
    detailsElement.classList.add("content-module");

    const summaryElement = document.createElement('summary');
    summaryElement.classList.add("content-module__header");

    const sumaryTitle = document.createElement("div");
    sumaryTitle.classList.add("content-module__title");

    sumaryTitle.innerHTML = `
      <span>Módulo ${index + 1} - ${module.name}</span>
      <div class="content-module__progress-container">
          <p class="content-module__progress-percentage" >10%</p>
          <progress class="content-module__progress-bar" max="100" value="10"></progress>
      </div>
    `;

    const icon = document.createElement('i');
    icon.classList.add("bx", 'bx-chevron-down');

    summaryElement.appendChild(sumaryTitle);
    summaryElement.appendChild(icon);
  
    const contentModule = document.createElement('div');
    contentModule.classList.add('content-module__lessons');
    contentModule.id = "course-modules"

    const lessons = module.lessons;    
    clearLessons(contentModule);

    if(lessons.length == 0){
      const noClases = document.createElement('p');
      noClases.classList.add('module__no-class');
      noClases.textContent = 'Sin clases agregadas';

      contentModule.appendChild(noClases);

      detailsElement.appendChild(summaryElement);
      detailsElement.appendChild(contentModule);

      return detailsElement;
    }

    lessons.forEach(lesson =>{
      let newLesson = createLessionElement(lesson, module);
      contentModule.appendChild(newLesson);
    });

    detailsElement.appendChild(summaryElement);
    detailsElement.appendChild(contentModule);

    return detailsElement;
  }

  function createLessionElement(lesson, module){
    const lessonCont = document.createElement('div');
    lessonCont.classList.add('content-module__lesson');

    const name = document.createElement('p');
    name.classList.add("content-module__lesson-name");
    name.textContent = lesson.name;

    name.addEventListener('click', ()=>{
       showLesson(module, lesson);
    });

    const button = document.createElement('button');
    button.classList.add("content-module__lesson-checked");

    const icon = document.createElement('i');
    icon.classList.add("bx", 'bx-check-circle');

    button.appendChild(icon);

    lessonCont.appendChild(name);
    lessonCont.appendChild(button);

    return lessonCont;
  }

  function showLesson(module, lesson){
    const nameModule = document.querySelector('.class__module');
    const nameClass = document.querySelector('.class__name');
    const description = document.querySelector('.description');
    const buttonsContainer = document.querySelector('.class__controls-right');

    nameModule.innerHTML = `<span>Módulo:</span> ${module.name}`
    nameClass.innerHTML = lesson.name;

    
    const currentLesson = lessons.find(Object => Object.id_lesson == lesson.id_lesson);
    const currentModule = module;
    const currentIndex = lessons.indexOf(currentLesson);

    if(currentIndex === 0){
      buttonsContainer.innerHTML = `
        <button  data-course=${currentIndex +1} class="class__next-btn"><i class='bx bx-skip-next'></i></button>
      `;
    }else if(currentIndex > 0 && currentIndex < lessons.length -1){
      buttonsContainer.innerHTML = `
        <button data-course=${currentIndex - 1}  class="class__next-btn"><i class='bx bx-skip-previous' ></i></button>
        <button data-course=${currentIndex + 1}  class="class__next-btn"><i class='bx bx-skip-next'></i></button>
      `;
    }else{
      buttonsContainer.innerHTML = `
        <button data-course=${currentIndex - 1}  class="class__next-btn"><i class='bx bx-skip-previous' ></i></button>
      `;
    }

    const buttons = document.querySelectorAll('.class__next-btn');
    
    buttons.forEach(button =>{
      button.addEventListener('click', (e) =>{
        const index = e.target.closest('.class__next-btn').dataset.course;
        const lesson = lessons[index];
        
        const currentModule = modules.find(Object => Object.id_module == lesson.id_module)
        showLesson(currentModule, lessons[index]);

      })
    })

    description.innerHTML = lesson.description;

    player.source = {
        type: 'video',
        sources: [
            {
                src: lesson.id_video,
                provider: 'vimeo',
            },
        ],
    };

    actionPlayer();

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

  function clearModules(){
    while(modulesContainer.firstChild)
            modulesContainer.removeChild(modulesContainer.firstChild);
  }

  function clearLessons(content){
    while(content.firstChild)
            content.removeChild(content.firstChild);
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

  function getCourseID(){
    const path = window.location.pathname;
    const parts = path.split('/');

    const ID = parts[parts.length -1];

    return ID;
  } 

})();