(function(){
  const realFileInput = document.querySelector('.real-btn-file');
  const customButton = document.querySelector('.btn-file');
  const fileName = document.querySelector('.name-file');

  customButton.addEventListener('click', () => {
    realFileInput.click();
  });

  realFileInput.addEventListener('change', () => {
    if (realFileInput.files.length > 0) {
      fileName.textContent = realFileInput.files[0].name;
      fileName.classList.add("correct");
      fileName.classList.add("show");
    } else {
      fileName.textContent = 'No se ha seleccionado ningún archivo';
      fileName.classList.add("error");
    }
  });

})();