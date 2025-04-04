<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

        <div class="top-main">
            <h1 class="top-main__title">Inscripciones registradas</h1>
        </div>

        <div class="table-6 show-4">

            <?php if(count($enrollment) > 0): ?>

                <div class="header">
                    <p class="title-header" >Estudiante</p>
                    <p class="title-header hidden">Fecha de incio</p>
                    <p class="title-header" >Curso inscrito</p>
                    <p class="title-header hidden">Monto pagado</p>
                    <p class="title-header">Estatus de pago</p>
                    <p class="title-header">Acciones</p>
                </div>
                <?php foreach($enrollment as $enroll):?>
                    <div class="row">

                        <div class="cell">
                            <a href="/estudiante/<?=$enroll->id_student?>" class="col-info-date--link"><?=$enroll->student?></a>
                        </div>

                        <div class="cell hidden">
                            <div class="col-info">
                                <p class="col-info-date"><?=$enroll->enrollment_at?></p>
                            </div>
                        </div>

                        <div class="cell">
                            <div class="col-main">
                                <a class="col-main-thumbnail" href="/curso/<?=$enroll->id_course?>">
                                    <img src="/assets/thumbnails/<?=$enroll->thumbnail?>" alt="caratula de curso">
                                </a>
                            </div>
                        </div>
                        
                        <div class="cell hidden">
                            <div class="col-info">
                                <p class="col-info-date"><?=$enroll->amount ?></p>
                            </div>
                        </div>
                        
                        <div class="cell hidden">
                            <div class="col-info">
                                <p class="col-info-date"><?=$enroll->status?></p>
                            </div>
                        </div>
                        
                        <div>
                            <div class="col-action">
                                <button class="col-action-link delete-course" data-id="<?=$enroll->id_enrollment?>">Eliminar</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>

            <?php else: ?>
                <div class="empty">
                    <p class="text">No hay inscripciones registradas</p>
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
        <script src="/assets/js/deleteCategory.js"></script>
    ';
?>