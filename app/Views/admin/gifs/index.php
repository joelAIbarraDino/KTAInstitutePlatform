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
                <?php if(count($gifs) == 0):?>
                    <a href="/kta-admin/gif/create" class="dashboard-table__button"> <i class='bx bx-plus'></i> Nuevo </a>
                <?php  endif;?>
                </div>
            </div>
            
            <div class="dashboard-table__container">
                <table class="dashboard-table__table">
                    <thead class="dashboard-table__thead">
                        <tr>
                            <th>Gif</th>
                            <th class="actions-label">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="dashboard-table__tbody">

                        <?php if(count($gifs) > 0): ?>

                            <?php foreach($gifs as $gif): ?>

                                <tr>
                                    <td>
                                        <img src="/assets/gifs/<?=$gif->file_url?>" alt="gif">
                                    </td>
                                    <td class="dashboard-table__actions-cell">
                                        <a href="/kta-admin/gif/update/<?=$gif->id_gif?>" class="dashboard-table__action dashboard-table__action--edit"><i class='bx bx-edit'></i></a>
                                    </td>
                                </tr>                    
                            <?php endforeach;?>
                        <?php else: ?>

                            <tr>
                                <td colspan="2" class="dashboard-table__no-result">no hay registros</td>
                            </tr>     
                        <?php endif; ?>               
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
    $scripts = '
        <script src="/assets/js/menuDashboard.js"></script>
    ';

    Helpers::showSwalAlert();
?>