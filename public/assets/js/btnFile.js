(function(){
  const realFileInput = document.querySelector('#thumbnail');
  const customButton = document.querySelector('#thumbnail-btn');
  const fileName = document.querySelector('.form__file-msg');

  customButton.addEventListener('click', () => {
    realFileInput.click();
  });

  realFileInput.addEventListener('change', () => {
    if (realFileInput.files.length > 0) {
      fileName.textContent = realFileInput.files[0].name;
      fileName.classList.add("correct");
    } else {
      fileName.textContent = 'No se ha seleccionado ningún archivo';
      fileName.classList.add("error");
    }
  });

})();