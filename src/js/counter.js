function animateCounter(element, duration = 2000) {
  const target = +element.getAttribute("data-target");
  const caract = element.getAttribute("data-caract")??"";
  const start = 0;
  const startTime = performance.now();

  function update(currentTime) {
    const elapsed = currentTime - startTime;
    const progress = Math.min(elapsed / duration, 1);
    const currentValue = Math.floor(progress * (target - start) + start);

    element.textContent = `${currentValue.toLocaleString()}${caract}`; // formatea con comas

    if (progress < 1) {
      requestAnimationFrame(update);
    } else {
      element.textContent = `${currentValue.toLocaleString()}${caract}`; // asegurar valor final
    }
  }

  requestAnimationFrame(update);
}

// Aplicar a todos los contadores
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".counter").forEach(counter => {
    animateCounter(counter, 1000); // puedes ajustar duración
  });
});