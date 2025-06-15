<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <div class="top-main">
            <h1 class="top-main__title">Gestión de cursos</h1>
            <button class="btn nuevo" id="btn-exit"><i class='bx bx-save'></i> Salir</button>
        </div>

        <div class="form tabs__container">
            <legend class="form__title">Contenido de curso</legend>
            <p class="form__instructions">Agrega los modulos y clases que tendra el nuevo curso</p>

            <div class="form__input new-module__form">
                <input 
                    type="text" 
                    id="new_module_name" 
                    placeholder="Nombre del módulo" 
                    class="field" 
                />
                
                <button id="add_module_btn" type="button" class="new-module__btn"><i class='bx bx-subdirectory-left'></i></button>
            </div>
            
            <legend>Mueva los modulos al orden deseado</legend>
            
            <div id="modules-container" class="modules">
                <details class="acordeon__modulo" data-id="82">
                    <summary class="module__header">
                        <div class="module__header-name">
                            <i class="bx bx-menu"></i>
                            <input type="text" class="module__order" id="order-module-82" data-id="82" disabled="" hidden="">
                            <input type="text" placeholder="Nombre del módulo" class="module__name" id="name-module-82" data-id="82">
                        </div>
                        
                        <div class="module__header-actions">
                            <button class="module__btn module__btn--agregar" data-id="82">+ Clase</button>
                            <button class="module__btn module__btn--eliminar" data-id="82"><i class="bx bx-trash"></i></button>
                            <i class="bx bx-chevron-down"></i>
                        </div>
                    </summary>
                    
                    <div class="acordeon__contenido"></div>
                
                </details>
            </div>

        </div>

    </div>
</main>

<?php
    $scripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script src="/assets/js/courseContent.js"></script>
    ';
?>
