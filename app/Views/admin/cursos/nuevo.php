<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <div class="top-main">
            <h1 class="main__title">Gestión de cursos</h1>
            <a class="btn nuevo" href="javascript:history.back()"><i class='bx bx-chevrons-left'></i> Regresar</a>
        </div>

        <div class="tabs" id="tabs">
            <button data-step="1" class="tabs__tab tabs__tab--active">Curso</button>
            <button data-step="2" class="tabs__tab tabs__tab--disable">Contenido</button>
            <button data-step="3" class="tabs__tab tabs__tab--disable">Cuestionario</button>
        </div>

        <section id="step-1" class="tabs__section active">
            <div class="tabs__container">
                <form id="form-course" class="form" enctype="multipart/form-data">
                    <legend class="form__title">Nuevo curso</legend>
                    
                    <p class="form__instructions">Completa los campos requeridos para crear un nuevo curso</p>
                    
                    <div class="grid-elements">
                        <div class="form__file col-3">
                            <label for="thumbnail-btn"> Caratula de curso (requerido)</label>
                            <input 
                                type="file"
                                name="thumbnail"
                                id="thumbnail"
                                accept="image/*"
                                hidden
                            >
                            <button type="button" id="thumbnail-btn" class="form__file-btn">Seleccionar caratula</button>
                            <span id="msg-thumbnail" class="form__input-msg"></span>
                        </div>
                    </div>

                    <div class="grid-elements">

                        <div class="form__input col-6">
                            <label for="name"> Nombre (requerido)</label>
                            <input 
                                type="text"
                                name="name"
                                id="name"
                                class="field"
                                placeholder="Nombre del curso"
                                
                            >
                            <span id="msg-name" class="form__input-msg"></span>
                        </div>

                        <div class="form__input col-6">
                            <label for="watchword"> Lema (requerido)</label>
                            <input 
                                type="text"
                                name="watchword"
                                id="watchword"
                                class="field"
                                placeholder="Frase llamativa del curso que aparecera debajo del nombre del curso"
                                
                            >
                            <span id="msg-watchword" class="form__input-msg"></span>
                        </div>
                    </div>
                    
                    <div class="grid-elements">
                        <div class="form__input col-3">
                            <label for="max_months_enroll">Acceso a material</label>
                            <div class="icon-left">
                                <i class='bx bx-calendar-check'></i>
                                <input 
                                    type="text"
                                    name="max_months_enroll"
                                    id="max_months_enroll"
                                    class="field"
                                    placeholder="Tiempo en meses para ver el material (opcional)"
                                >
                            </div>    
                            <span id="msg-max_months_enroll" class="form__input-msg"></span>
                        </div>

                        <div class="form__input col-3">
                            <label for="price">Precio (obligatorio)</label>
                            <div class="icon-left">
                                <i class='bx bx-dollar'></i>
                                <input 
                                    type="text"
                                    name="price"
                                    id="price"
                                    class="field"
                                    placeholder="Precio del curso"
                                    
                                >
                            </div>    
                            <span id="msg-price" class="form__input-msg"></span>
                        </div>
                        
                        <div class="form__input col-3">
                            <label for="discount">Descuento</label>
                            <div class="icon-right">
                                <input 
                                    type="text"
                                    name="discount"
                                    id="discount"
                                    class="field"
                                    placeholder="procentaje de descuento del curso (opcional)"
                                >
                                <i>%</i>
                            </div>
                            <span id="msg-discount" class="form__input-msg"></span>
                        </div>

                        <div class="form__input col-3">
                            <label for="discount_ends">Fin de promocion</label>
                                <input 
                                    type="date"
                                    name="discount_ends"
                                    id="discount_ends"
                                    class="field"
                                    min = <?=date('Y-m-d')?>
                                >                
                                <span id="msg-discount_ends" class="form__input-msg"></span>
                        </div>
                    </div>

                    <div class="form__input">
                        <label for="description">Descripción (minimo 80 caracteres)</label>
                        <textarea 
                            name="description" 
                            id="description"
                            class="text-area"
                            placeholder="Descripción detallada del curso, que se aprendera y que puede hacer despues de tomar este curso"
                            
                        ></textarea>
                        <span id="msg-description" class="form__input-msg"></span>
                    </div>

                    <div class="grid-elements">
                        
                        <div class="form__input  col-4">
                            <label for="privacy">Estado de publicación(obligatorio)</label>
                                <select name="privacy" id="privacy" class="field" >
                                    <option value="" disabled selected>Selecciona estado de publicación</option>
                                    <?php include_once __DIR__.'/../../components/statusPublicCB.php' ?>
                                </select>
                                <span id="msg-privacy" class="form__input-msg"></span>
                        </div>

                        <div class="form__input col-4">
                            <label for="id_teacher">Maestro(obligatorio)</label>
                                <select name="id_teacher" id="id_teacher" class="field" >
                                    <option value="" disabled selected>Seleccionar maestro</option>
                                    <?php include_once __DIR__.'/../../components/teacherCB.php' ?>
                                </select>
                                <span id="msg-id_teacher" class="form__input-msg"></span>
                        </div>

                        <div class="form__input col-4">
                            <label for="id_category">Categoría(obligatorio)</label>
                                <select name="id_category" id="id_category" class="field" >
                                    <option value="" disabled selected>Seleccionar</option>
                                    <?php include_once __DIR__.'/../../components/categories.php' ?>
                                </select>
                                <span id="msg-id_category" class="form__input-msg"></span>
                        </div>
                    </div>

                    <div class="submit-right">
                        <input class="submit" type="submit" value="Crear curso">
                    </div>

                </form>
            </div>
        </section>

        <section id="step-2" class="tabs__section">
            <div class="tabs__container">
                <form class="form" enctype="multipart/form-data">
                    <legend class="form__title">Modulos del curso</legend>
                    
                    <p class="form__instructions">Completa los campos requeridos para crear un nuevo curso</p>
                
                </form>
            </div>
        </section>

        <section id="step-3" class="tabs__section">
            <div class="tabs__container">
                <form class="form" enctype="multipart/form-data">
                    <legend class="form__title">Contenido del curso</legend>
                    
                    <p class="form__instructions">Completa los campos requeridos para crear un nuevo curso</p>
                
                </form>
            </div>
        </section>
    </div>
</main>

<?php
    $scripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/newCourse.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>