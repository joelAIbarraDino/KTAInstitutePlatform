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
  let quiz = [];

  let currentLesson = null;
  let player;

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
      quiz = response.quiz;

      showModules();

      showLesson(modules[0], modules[0].lessons[0]);

    } catch (error) {
        console.log(error);
    }
  }

  function showModules(openModule = 0){
    let totalLessons = 0;
    let completedLessons = 0;

    clearModules();

    if(modules.length == 0)
      return;

    modules.forEach((module, index)=>{
      
      let newModule = createModule(module, index);
      modulesContainer.appendChild(newModule);
      beginModule(newModule);

      if(module.id_module == openModule){
        openAcordion(newModule);
      }

       module.lessons.forEach(lesson => {
        totalLessons++;
        if (lesson.progress && lesson.progress.completed) {
          completedLessons++;
        }
      });

    });

    const globalProgress = (completedLessons / totalLessons) * 100;

    if(globalProgress === 100){
      if(quiz.length == 0){
        let newDownload = createCertificateDownload();
        modulesContainer.appendChild(newDownload);
        beginModule(newDownload);
      }else{
        let newQuestion = createQuiz(quiz);
        modulesContainer.appendChild(newQuestion)
        beginModule(newQuestion);
      }
    }

  }

  function createModule(module, index){
    let noLessions = 0;
    let finishedLessions = 0;

    const detailsElement = document.createElement('details');
    detailsElement.classList.add("content-module");

    const summaryElement = document.createElement('summary');
    summaryElement.classList.add("content-module__header");

    const sumaryTitle = document.createElement("div");
    sumaryTitle.classList.add("content-module__title");

    const span = document.createElement('span');
    span.textContent = `Módulo ${index + 1} - ${module.name}`;

    // Crear contenedor de progreso
    const progressContainer = document.createElement('div');
    progressContainer.classList.add('content-module__progress-container');

    // Crear el <p> del porcentaje
    const percentageText = document.createElement('p');
    percentageText.classList.add('content-module__progress-percentage');
    percentageText.textContent = '0%';
    progressContainer.appendChild(percentageText);

    // Crear la barra de progreso
    const progressBar = document.createElement('progress');
    progressBar.classList.add('content-module__progress-bar');
    progressBar.setAttribute('max', '100');
    progressBar.setAttribute('value', '0');
    progressContainer.appendChild(progressBar);

    progressContainer.appendChild(percentageText);
    progressContainer.appendChild(progressBar);

    sumaryTitle.appendChild(span);
    sumaryTitle.appendChild(progressContainer);
    
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
      let newLesson = createLessionElement(lesson);
      contentModule.appendChild(newLesson);
      
      newLesson.addEventListener('click', (e)=>{
        if(!e.target.classList.contains("content-module__lesson"))
          return;
        
        showLesson(module, lesson);
      })
      
      if(lesson.progress.completed)finishedLessions++;
      
      noLessions++;
    });

    const percentage = (finishedLessions / noLessions) * 100;
    
    percentageText.textContent = `%${percentage.toFixed(0)}`;
    progressBar.value = percentage.toFixed(2);
    
    detailsElement.appendChild(summaryElement);
    detailsElement.appendChild(contentModule);
    
    return detailsElement;
  }

  function createQuiz(quiz){
    const detailsElement = document.createElement('details');
    detailsElement.classList.add("content-module");

    const summaryElement = document.createElement('summary');
    summaryElement.classList.add("content-module__header");

    const sumaryTitle = document.createElement("div");
    sumaryTitle.classList.add("content-module__title");

    sumaryTitle.innerHTML = `
      <span>Quiz - ${quiz.name}</span>
    `;

    const icon = document.createElement('i');
    icon.classList.add("bx", 'bx-chevron-down');

    summaryElement.appendChild(sumaryTitle);
    summaryElement.appendChild(icon);
  
    const contentModule = document.createElement('div');
    contentModule.classList.add('content-module__lessons');
    contentModule.id = "course-modules"

    const id = getCourseID();
    
    const quizLink = document.createElement('a');
    quizLink.href = `/quiz/attempts/${id}`;
    quizLink.classList.add('content-module__quiz-link');
    quizLink.textContent = 'Ir a intentos';

    contentModule.appendChild(quizLink);
  
    detailsElement.appendChild(summaryElement);
    detailsElement.appendChild(contentModule);

    return detailsElement;
  }

  function createLessionElement(lesson){
    const lessonCont = document.createElement('div');
    lessonCont.classList.add('content-module__lesson');

    const name = document.createElement('p');
    name.classList.add("content-module__lesson-name");
    name.textContent = lesson.name;

    const button = document.createElement('button');
    button.classList.add("content-module__lesson-checked");

    const icon = document.createElement('i');
    
    if(lesson.progress.length == 0 || !lesson.progress.completed){
      icon.classList.add("bx", 'bx-check-circle');
    }else if(lesson.progress.completed){
      icon.classList.add("bx", 'bxs-check-circle');
    }
    
    button.addEventListener('click', (e)=>{
      if(!e.target.classList.contains("bx", "bx-check-circle"))
          return;

      if(lesson.progress.length == 0)
        createProgress(lesson);
      else{
        lesson.progress.completed = lesson.progress.completed?0:1;
        updateProgress(lesson);
      }
    });

    button.appendChild(icon);

    lessonCont.appendChild(name);
    lessonCont.appendChild(button);

    return lessonCont;
  }

  function showLesson(module, lesson){
    const nameModule = document.querySelector('.class__module');
    const nameClass = document.querySelector('.class__name');
    const description = document.querySelector('.description');
    const materials = document.querySelector('#material-conteiner');
    const buttonsContainer = document.querySelector('.class__controls-right');

    nameModule.innerHTML = `<span>Módulo:</span> ${module.name}`
    nameClass.innerHTML = lesson.name;

    
    const currentLesson = lessons.find(Object => Object.id_lesson == lesson.id_lesson);
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
        showLesson(currentModule, lesson);

      })
    })
    //cargo leccion
    description.innerHTML = lesson.description;

    //cargo materiales
    clearContainer(materials);

    if(lesson.materials.length > 0){
      lesson.materials.forEach(material =>{
        let materialContent = createMaterial(material);
        materials.appendChild(materialContent);
      });
    }

    loadVideo(lesson);
  }

  function createMaterial(material) {
    const { id_material, name, type, url_file } = material;

    // Crear el contenedor principal
    const container = document.createElement('div');
    container.classList.add('material__element');

    // Crear el div del nombre del material
    const nameDiv = document.createElement('div');
    nameDiv.classList.add('material__name');
    nameDiv.innerHTML = `<i class="bx bxs-file-blank"></i> ${name}`;
    container.appendChild(nameDiv);

    // Crear el botón de descarga
    const downloadButton = document.createElement('button');
    downloadButton.classList.add('material__download');
    downloadButton.dataset.id = id_material;
    downloadButton.innerHTML = `Descargar <i class="bx bx-download"></i>`;

    // Agregar evento para descargar archivo
    downloadButton.addEventListener('click', () => {
        const link = document.createElement('a');
        link.href = `/materials/${url_file}`;
        link.download = name;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    });

    container.appendChild(downloadButton);

    return container;
  }


  function actionPlayer(){

    player.on('timeupdate', () => {
      const current = player.currentTime;
      const duration = player.duration;

      if (duration > 0) {
        const percent = (current / duration) * 100;
        
        if(percent > 90 && !videoTerminado){
          leccionCompleted(currentLesson);
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
              if (result.dismiss === Swal.DismissReason.timer || result.isConfirmed) {
                const currentCompleteLesson = lessons.find(Object => Object.id_lesson == currentLesson.id_lesson);
                let currentIndex = lessons.indexOf(currentCompleteLesson);

                if(currentIndex >= 0 && currentIndex < lessons.length -1){
                  currentIndex++;
                  const nextSimpleLesson = lessons[currentIndex];
                  const nextModule = modules.find(Object => Object.id_module == nextSimpleLesson.id_module)
                  const nextLesson = nextModule.lessons.find(Object => Object.id_lesson == nextSimpleLesson.id_lesson)
                  showLesson(nextModule, nextLesson);
                }
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

  async function createProgress(lesson){
    const {id_lesson, id_module} = lesson;
    
    try {
      const courseID = getCourseID();
      const url = `/api/progress/new/${courseID}`;

      //registro el modelo en la base de datos
      const formData = new FormData();
      formData.append("id_lesson", id_lesson);
      formData.append("completed", 1);
      

      const request = await fetch(url, {
        method: 'POST',
        body:formData
      });

      const response = await request.json();

      if(!response.ok){
        Swal.fire({
          icon: "error",
          title: "Ha ocurrido un error",
          text: "error al guardar el progreso, revise su conexion a internet",
        });

        showModules();
      }

      progress = {
        id_progress: response.id_progress,
        completed:1,
        id_enrollment:response.id_enrollment,
        id_lesson:id_lesson
      };

      modules = modules.map(module=>{
        if(module.id_module == id_module){
          module.lessons.map(lesson=>{
            if(lesson.id_lesson == id_lesson){
              lesson.progress = progress;
            }
            return lesson;
          });

        }

        return module;
      });
      showModules(id_module);

    } catch (error) {
      console.log(error)
    }
  }

  async function updateProgress(lesson){
    const {id_module} = lesson;
    const {id_lesson, id_progress, completed} = lesson.progress;
    const courseID = getCourseID();

    try {
      const url = `/api/progress/update/${id_progress}/${courseID}`;

      const request = await fetch(url, {
        method:"PATCH",
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          completed:completed
        })
      });

      const response = await request.json();

      if(!response.ok){
        Swal.fire({
          icon: "error",
          title: "Ha ocurrido un error",
          text: "error al actualizar el progreso, revise su conexion a internet",
        });

        showModules();
      }

      modules = modules.map(module=>{
        if(module.id_module == id_module){
          module.lessons.map(lesson=>{
            if(lesson.id_lesson == id_lesson){
              lesson.progress.completed = completed;
            }
            return lesson;
          });

        }

        return module;
      });

    showModules(id_module);

    } catch (error) {
      console.log(error);
    }
  }

  function openAcordion(modulo){
    const summary = modulo.querySelector("summary");
    const content = modulo.querySelector(".content-module__lessons");

    if (!summary || !content) return;

    modulo.setAttribute("open", "");
    const height = content.scrollHeight;
    content.style.height = height + "px";
  }

  function loadVideo(lesson){
    videoTerminado = false;
    currentLesson = lesson;

    if(!player){
      const playerElement = document.querySelector('#player');
      playerElement.setAttribute('data-plyr-embed-id', currentLesson.id_video);
      player = new Plyr('#player');
    }else{
      player.source = {
        type: 'video',
        sources: [{
          src: currentLesson.id_video,
          provider: 'vimeo'
        }]
      };
    }
    
    player.off('timeupdate'); 
    actionPlayer();
  }

  function leccionCompleted(lesson){
    if(lesson.progress.completed)
        return;

    const headerLeccion = document.querySelector(".class__info-container");

    const containerMessage = document.createElement("div");
    containerMessage.classList.add("class__completed-lesson");
    containerMessage.innerHTML = `<i class='bx bxs-party bx-tada' ></i>¡Lección terminada!`;
    headerLeccion.appendChild(containerMessage);

    setTimeout(() => {    
      headerLeccion.removeChild(containerMessage);
    }, 2500);

    if(lesson.progress.length == 0)
      createProgress(lesson);
    else{
      lesson.progress.completed = 1;
      updateProgress(lesson);
    }

    
  }

  function createCertificateDownload() {
    const detailsElement = document.createElement('details');
    detailsElement.classList.add("content-module");

    const summaryElement = document.createElement('summary');
    summaryElement.classList.add("content-module__header");

    const sumaryTitle = document.createElement("div");
    sumaryTitle.classList.add("content-module__title");

    sumaryTitle.innerHTML = `<span>Certificado - Descarga disponible</span>`;

    const icon = document.createElement('i');
    icon.classList.add("bx", 'bx-chevron-down');

    summaryElement.appendChild(sumaryTitle);
    summaryElement.appendChild(icon);

    const contentModule = document.createElement('div');
    contentModule.classList.add('content-module__lessons');
    contentModule.id = "course-modules";

    const id = getCourseID();

    const pdfLink = document.createElement('a');
    pdfLink.href = `/certificado-curso/${id}`;
    pdfLink.classList.add('content-module__quiz-link');
    pdfLink.textContent = 'Descargar certificado en PDF';
    pdfLink.target = '_blank'; // abrir en nueva pestaña si deseas

    contentModule.appendChild(pdfLink);

    detailsElement.appendChild(summaryElement);
    detailsElement.appendChild(contentModule);

    return detailsElement;
  }

  function getCourseID(){
    const path = window.location.pathname;
    const parts = path.split('/');

    const ID = parts[parts.length -1];

    return ID;
  } 

  function clearContainer(element){
      while(element.firstChild)
          element.removeChild(element.firstChild);
  }

})();