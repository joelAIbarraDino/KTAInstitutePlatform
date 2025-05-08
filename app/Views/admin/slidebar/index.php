<?php
    use App\Classes\Helpers;
    include_once __DIR__.'/../../components/adminToolbar.php'; 
?>

<main class="main">
    <div class="main__container">
        <div class="dashboard-table">
            <div class="dashboard-table__header">
                <h2 class="dashboard-table__title">Slidebar</h2>
                <div class="dashboard-table__actions">
                <a href="/kta-admin/slidebar/create" class="dashboard-table__button"> <i class='bx bx-plus'></i> Nuevo </a>
                </div>
            </div>
            
            <div class="dashboard-table__container">
                <table class="dashboard-table__table">
                    <thead class="dashboard-table__thead">
                        <tr>
                            <th>Fondo</th>
                            <th>Titulo</th>
                            <th>Subtitulo</th>
                            <th class="actions-label">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="dashboard-table__tbody">

                        <?php if(count($slidebar) > 0): ?>

                            <?php foreach($slidebar as $slide): ?>

                                <tr>
                                    <td><img class="dashboard-table__photo--rectangule" src="/assets/slidebar/<?=$slide->background?>" alt="foto <?=$slide->background?>"></td>
                                    <td><?=$slide->title?></td>
                                    <td><?=$slide->subtitule?></td>
                                    <td class="dashboard-table__actions-cell">
                                        <a href="/admin/slidebar/update/<?=$slide->id_slidebar?>" class="dashboard-table__action dashboard-table__action--edit"><i class='bx bx-edit'></i></a>
                                        <button data-id="<?=$slide->id_slidebar?>" class="dashboard-table__action dashboard-table__action--delete"><i class='bx bx-trash'></i></button>
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
        <script type="module" src="/assets/js/deleteSlidebar.js"></script>
    ';

    Helpers::showSwalAlert();
?>