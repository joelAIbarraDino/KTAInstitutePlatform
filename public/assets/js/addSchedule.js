(function(){
    document.getElementById("add-schedule").addEventListener("click", function() {
        const container = document.getElementById("fechas");

        // Crear el contenedor del input
        const div = document.createElement("div");
        div.className = "form__input col-12";

        // Crear la etiqueta <label>
        const label = document.createElement("label");
        label.setAttribute("for", "discount_ends_date");
        label.textContent = "Fecha y hora del evento";

        // Crear el input datetime-local
        const input = document.createElement("input");
        input.type = "datetime-local";
        input.name = "schedules[]";
        input.className = "field";
        
        // Establecer el valor mínimo con la fecha actual (en formato YYYY-MM-DD)
        const today = new Date().toISOString().split("T")[0];
        input.min = today;

        // Añadir elementos al DOM
        div.appendChild(label);
        div.appendChild(input);
        container.appendChild(div);
    });

})();