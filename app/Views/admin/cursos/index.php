<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

        <div class="top-main">
            <h1 class="main__title">Cursos registrados</h1>
            <a class="btn nuevo" href="/admin/curso/create"><i class='bx bx-plus'></i> Nuevo curso</a>
        </div>

        <div class="table-8 show-3">

            <?php if(count($courses) > 0): ?>

                <div class="header">
                    <p class="title-header" >Caratula</p>
                    <p class="title-header">Nombre</p>
                    <p class="title-header hidden" >Creado el </p>
                    <p class="title-header hidden">Privacidad</p>
                    <p class="title-header hidden">Inscritos</p>
                    <p class="title-header hidden">Acceso a contenido</p>
                    <p class="title-header hidden">Maestro</p>
                    <p class="title-header">Acciones</p>
                </div>
                <?php foreach($courses as $course):?>
                    <div class="row">

                        <div>
                            <div class="col-main">
                                <a class="col-main-thumbnail" href="/curso/<?=$course->id_course?>">
                                    <img src="/assets/thumbnails/<?=$course->thumbnail?>" alt="caratula de curso">
                                </a>
                            </div>
                        </div>

                        <div>
                            <div class="col-main-2">
                                <a href="/admin/curso/edit/<?=$course->id_course?>" class="col-main-2-title"><?=$course->name?></a>
                                <p class="col-main-2-category"><?=$course->category?></p>

                                <?php if(isset($course->discount)):?>
                                    <div class="col-main-2-prices">
                                        <div class="col-main-2-prices-price disc">$<?=$course->price?> USD</div>
                                        <div class="col-main-2-prices-disc">$<?=$course->price * (1 - ($course->discount/100))?> USD</div>
                                    </div>
                                <?php else:?>    
                                    <div class="col-main-2-prices">
                                        <div class="col-main-2-prices-price">$<?=$course->price?> USD</div>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                        
                        <div class="hidden">
                            <div class="col-info">
                                <p class="col-info-date"><?=$course->created_at?></p>
                            </div>
                        </div>
                        
                        <div class="hidden">
                            <div class="col-info">
                                <p class="col-info-date"><?=$course->privacy ?></p>
                            </div>
                        </div>
                        
                        <div class="hidden">
                            <div class="col-info">
                                <a href="/maestro/10" class="col-info-date--link"><?=$course->enrollment?></a>
                            </div>
                        </div>
                        
                        <div class="hidden">
                            <div class="col-info">
                                <p class="col-info-date"><?=$course->max_months_enroll ?> meses</p>
                            </div>
                        </div>
                        
                        <div class="hidden">
                            <div class="col-info">
                                <a href="/admin/maestro/<?=$course->id_teacher ?>" class="col-info-date--link"><?=$course->teacher ?></a>
                            </div>
                        </div>
                        
                        <div>
                            <div class="col-action">
                                <button class="col-action-link delete-course" data-id="<?=$course->id_course?>">Eliminar</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>

            <?php else: ?>
                <div class="record empty">
                    <p>No hay cursos registrados</p>
                </div>
            <?php endif; ?>

        </div>

    </div>
</main>

<?php
    $scripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script src="/assets/js/deleteCourse.js"></script>
    ';
?>