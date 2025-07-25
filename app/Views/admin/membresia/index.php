<?php
    use App\Classes\Helpers;
    include_once __DIR__.'/../../components/adminToolbar.php'; 
?>

<main class="main">
    <div class="main__container">
        <div class="dashboard-table">
            <div class="dashboard-table__header">
                <h2 class="dashboard-table__title">Membresias</h2>
                <div class="dashboard-table__actions">
                    <a href="/kta-admin/membresia/create" class="dashboard-table__button"> <i class='bx bx-plus'></i> Nuevo </a>
                </div>
            </div>
            
            <div class="dashboard-table__container">
                <table class="dashboard-table__table">
                    <thead class="dashboard-table__thead">
                        <tr>
                            <th>Tipo de membresia</th>
                            <th>Acceso a membresia</th>
                            <th>Precio</th>
                            <th class="actions-label">Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody class="dashboard-table__tbody">

                        <?php if(count($memberships) > 0): ?>

                            <?php foreach($memberships as $membership): ?>

                                <tr>
                                    <td><span class="dashboard-table__status dashboard-table__status--info"><?=$membership->type?></span></td>
                                    <td><?=$membership->max_time_membership?></td>
                                    <td><?=$membership->price?></td>
                                    <td class="dashboard-table__actions-cell">
                                        <a href="/kta-admin/membership-course/<?=$membership->id_membership ?>" class="dashboard-table__action dashboard-table__action--extra"><i class='bx bxs-widget'></i></i></a>
                                        <a href="/kta-admin/membresia/update/<?=$membership->id_membership?>" class="dashboard-table__action dashboard-table__action--edit"><i class='bx bx-edit'></i></a>
                                        <button data-id="<?=$membership->id_membership?>" class="dashboard-table__action dashboard-table__action--delete"><i class='bx bx-trash'></i></button>
                                    </td>

                                </tr>                    
                            <?php endforeach;?>
                        <?php else: ?>

                            <tr>
                                <td colspan="5" class="dashboard-table__no-result">no hay registros</td>
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
        <script type="module" src="/assets/js/deleteMembership.js"></script>
    ';

    Helpers::showSwalAlert();
?>