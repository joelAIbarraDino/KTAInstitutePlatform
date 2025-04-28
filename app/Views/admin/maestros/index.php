<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

        <div class="top-main">
            <h1 class="top-main__title">Maestros registrados</h1>
            <a class="btn nuevo" href="/admin/maestro/create"><i class='bx bx-plus'></i> Nuevo maestro</a>
        </div>

        <div class="table-6 show-4">

            <?php if(count($teachers) > 0): ?>

                <div class="header">
                    <p class="title-header" >Foto</p>
                    <p class="title-header">Nombre</p>
                    <p class="title-header hidden" >Email</p>
                    <p class="title-header hidden">Especialidad</p>
                    <p class="title-header hidden">Experiencia</p>
                    <p class="title-header">Acciones</p>
                </div>
                <?php foreach($teachers as $teacher):?>
                    <div class="row">

                        <div class="cell">
                            <div class="col-main">
                                <img src="/assets/teachers/<?=$teacher->photo?>" alt="caratula de curso">
                            </div>
                        </div>

                        <div class="cell">
                            <div class="col-info">
                                <a class="col-info-date--link" href="/admin/maestro/update/<?=$teacher->id_teacher?>"><?=$teacher->name?></a>
                            </div>
                        </div>

                        <div class="cell hidden">
                            <div class="col-info">
                                <p class="col-info-date"><?=$teacher->email?></p>
                            </div>
                        </div>

                        <div class="cell hidden">
                            <div class="col-info">
                                <p class="col-info-date"><?=$teacher->speciality ?></p>
                            </div>
                        </div>
                        
                        <div class="cell hidden">
                            <div class="col-info">
                                <p class="col-info-date"><?=$teacher->experience?> años</p>
                            </div>
                        </div>
                        
                        <div class="cell">
                            <div class="col-action">
                                <button class="col-action-link delete-teacher" data-id="<?=$teacher->id_teacher?>">Eliminar</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>

            <?php else: ?>
                <div class="empty">
                    <p class="text">No hay maestros registrados</p>
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
        <script type="module" src="/assets/js/deleteTeacher.js"></script>
    ';
?>