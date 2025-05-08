<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

        <div class="top-main">
            <h1 class="top-main__title">Gestión de cursos</h1>
            <a class="btn nuevo" href="/kta-admin/cursos"><i class='bx bx-chevrons-left'></i> Regresar</a>
        </div>

        <form class="form form-admin" enctype="multipart/form-data" method="POST">
            <legend class="form__title">Nuevo curso</legend>
            
            <p class="form__instructions">Completa los campos requeridos para crear un nuevo curso</p>
            
            <?php include_once __DIR__.'/../../components/alerts.php'; ?>

            <?php include_once __DIR__.'/form.php'; ?>
            
            <div class="submit-right">
                <input class="submit" type="submit" value="Crear curso">
            </div>

        </form>

    </div>
</main>

<?php
    $scripts = '
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/btnFile.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const agregarBtn = document.getElementById("agregar_modulo");
        const modulesContainer = document.getElementById("modules");
        const nameInput = document.getElementById("module_name");

        agregarBtn.addEventListener("click", function () {
            const name = nameInput.value.trim();

            if (!name) return;
            
            const moduleDiv = document.createElement("div");
            moduleDiv.classList.add("grid-elements", "module-form__module");

            moduleDiv.innerHTML = `
                <div class="form__input col-11">
                    <label> Nombre de módulo</label>
                    <input 
                        type="text"
                        name="module_name[]"
                        class="field"
                        value="${name}"
                    >
                </div>

                <div class="form__input col-1">
                    <button class="module-form__botton module-form__botton--delete delete-module" type="button">
                        <i class='bx bx-x'></i>
                    </button>
                </div>
            `;

            modulesContainer.appendChild(moduleDiv);
            nameInput.value = "";

        });

        modulesContainer.addEventListener("click", function (e) {
            if (e.target.closest(".delete-module")) {
                e.target.closest(".module-form__module").remove();
            }
        });

        Sortable.create(modulesContainer, {
            animation: 150,
            handle: ".module-form__module",
        });
    });
</script>

