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

// Esperar a que el contenedor entre en vista
const observer = new IntersectionObserver((entries, observer) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const counters = entry.target.querySelectorAll('.counter');
      counters.forEach(counter => animateCounter(counter, 1500));
      observer.unobserve(entry.target); // solo una vez
    }
  });
}, {
  threshold: 0.4, // empieza cuando 40% del contenedor es visible
});

// Apuntar al contenedor principal
document.addEventListener("DOMContentLoaded", () => {
  const container = document.querySelector(".estadisticas");
  if (container) observer.observe(container);
});