<?php
    use App\Classes\Helpers;

    include_once __DIR__.'/../../components/adminToolbar.php'; 
?>

<main class="main">
    <div class="main__container">

    <div class="dashboard-table">
            <div class="dashboard-table__header">
                <h2 class="dashboard-table__title">Cursos en vivo</h2>
                <div class="dashboard-table__actions">
                <a href="/kta-admin/live/create" class="dashboard-table__button"> <i class='bx bx-plus'></i> Nuevo </a>
                </div>
            </div>
            
            <div class="dashboard-table__container">
                <table class="dashboard-table__table">
                    <thead class="dashboard-table__thead">
                        <tr>
                            <th>Caratula</th>
                            <th>Nombre</th>
                            <th>Privacidad</th>
                            <th>Inscritos</th>
                            <th>Acceso a contenido</th>
                            <th>Horario(s) de evento</th>
                            <th>Maestro</th>
                            <th class="actions-label">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="dashboard-table__tbody">

                        <?php if(count($lives) > 0): ?>

                            <?php foreach($lives as $live): ?>
                                <tr>
                                    <td><a href="/live/view/<?=$live->url?>"  target="_blank"><img class="dashboard-table__photo--square" src="/assets/thumbnails/courses/<?=$live->thumbnail?>" alt="foto <?=$live->thumbnail?>"></a></td>
                                    <td><?=$live->name?></td>
                                    <td><span class="dashboard-table__status dashboard-table__status--info"><?=$live->privacy ?></span></td>
                                    <td><?=$live->enrollment?></td>
                                    <td><span class="dashboard-table__status dashboard-table__status--pending"><?=$live->max_months_enroll ?> meses</span></td>
                                    <td class="dashboard-table__link"><a href="/kta-admin/maestro/update/<?=$live->id_teacher?>"><?=$live->teacher ?></a></td>
                                    <td>
                                        <?php $fechas = json_decode($live->dates_times);
                                        foreach($fechas as $key=>$fecha):?>
                                            <?php $fechaFormateada = new DateTime($fecha); ?>
                                            Día <?= ($key+1).'- ' ?><?= $fechaFormateada->format('d / m / Y H:i') ?></br>
                                        <?php endforeach;?>
                                    </td>
                                    <td class="dashboard-table__actions-cell">
                                        <a href="/kta-admin/course-content/<?=$live->id_course ?>" class="dashboard-table__action dashboard-table__action--extra"><i class='bx bxs-widget'></i></i></a>
                                        <a href="/kta-admin/live/update/<?=$live->id_course ?>" class="dashboard-table__action dashboard-table__action--edit"><i class='bx bx-edit'></i></a>
                                        <button data-id="<?=$live->id_course?>" class="dashboard-table__action dashboard-table__action--delete"><i class='bx bx-trash'></i></button>
                                    </td>
                                </tr>                    
                            <?php endforeach;?>
                        <?php else: ?>

                            <tr>
                                <td colspan="9" class="dashboard-table__no-result">no hay registros</td>
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

    Helpers::showSwalAlert();
?>