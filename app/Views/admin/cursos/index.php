<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

    <div class="dashboard-table">
            <div class="dashboard-table__header">
                <h2 class="dashboard-table__title">Cursos</h2>
                <div class="dashboard-table__actions">
                <a href="/admin/curso/create" class="dashboard-table__button"> <i class='bx bx-plus'></i> Nuevo </a>
                </div>
            </div>
            
            <div class="dashboard-table__container">
                <table class="dashboard-table__table">
                    <thead class="dashboard-table__thead">
                        <tr>
                            <th>Caratula</th>
                            <th>Nombre</th>
                            <th>Creado el </th>
                            <th>Privacidad</th>
                            <th>Inscritos</th>
                            <th>Acceso a contenido</th>
                            <th>Maestro</th>
                            <th class="actions-label">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="dashboard-table__tbody">

                        <?php if(count($courses) > 0): ?>

                            <?php foreach($courses as $course): ?>

                                <tr>
                                    <td><img class="dashboard-table__photo--rectangule" src="/assets/thumbnails/<?=$course->thumbnail?>" alt="foto <?=$course->thumbnail?>"></td>
                                    <td><?=$course->name?></td>
                                    <td><?=$course->created_at?></td>
                                    <td><span class="dashboard-table__status dashboard-table__status--info"><?=$course->privacy ?></span></td>
                                    <td><?=$course->enrollment?></td>
                                    <td><span class="dashboard-table__status dashboard-table__status--pending"><?=$course->max_months_enroll ?> meses</span></td>
                                    <td><?=$course->teacher ?></td>
                                    <td class="dashboard-table__actions-cell">
                                        <a href="/admin/curso/update/<?=$course->id_teacher ?>" class="dashboard-table__action dashboard-table__action--edit"><i class='bx bx-edit'></i></a>
                                        <button data-id="<?=$course->id_teacher?>" class="dashboard-table__action dashboard-table__action--delete"><i class='bx bx-trash'></i></button>
                                    </td>
                                </tr>                    
                            <?php endforeach;?>
                        <?php else: ?>

                            <tr>
                                <td colspan="8" class="dashboard-table__no-result">no hay registros</td>
                            </tr>     
                        <?php endif; ?>               
                    </tbody>
                </table>
            </div>
            
            <div class="dashboard-table__footer">
                <div class="dashboard-table__pagination">
                <button class="dashboard-table__page-button">
                    <i class='bx bx-chevron-left'></i>
                </button>
                <span class="dashboard-table__page-info">Página 1 de 5</span>
                <button class="dashboard-table__page-button">
                    <i class='bx bx-chevron-right'></i>
                </button>
                </div>
            </div>
            </div>

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