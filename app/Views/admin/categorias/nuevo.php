<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <div class="top-main">
            <h1 class="top-main__title">Gestión de cursos</h1>
            <a class="btn nuevo" href="/kta-admin/categorias"><i class='bx bx-chevrons-left'></i> Regresar</a>
        </div>

        <form id="form-category" class="form tabs__container" enctype="multipart/form-data">
            <legend class="form__title">Nueva categoria</legend>
            
            <p class="form__instructions">Completa los campos para crear una nueva categoria</p>
            
            <div class="grid-elements">

                <div class="form__input col-12">
                    <label for="name"> Nombre (requerido)</label>
                    <input 
                        type="text"
                        name="name"
                        id="name"
                        class="field"
                        placeholder="Nombre del categoria"
                        
                    >
                    <span id="msg-name" class="form__input-msg"></span>
                </div>
            </div>

            <div class="submit-right">
                <input class="submit" type="submit" value="Crear categoria">
            </div>

        </form>
    </div>
</main>

<?php
    $scripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/newCategory.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>