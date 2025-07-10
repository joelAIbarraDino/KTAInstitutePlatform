<?php

use App\Classes\Helpers;

 include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

    <div class="dashboard-table">
            <div class="dashboard-table__header">
                <h2 class="dashboard-table__title">Membresias registradas</h2>
                <div class="dashboard-table__actions">
                </div>
            </div>
            
            <div class="dashboard-table__container">
                <table class="dashboard-table__table">
                    <thead class="dashboard-table__thead">
                        <tr>                            
                            <th>Nivel de membresía</th>
                            <th>Nombre de estudiante</th>
                            <th>Email</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de termino</th>
                            <th>Activo</th>
                        </tr>
                    </thead>
                    <tbody class="dashboard-table__tbody">

                        <?php if(count($membresias) > 0): ?>

                            <?php foreach($membresias as $membresia): ?>
                                <tr>
                                    <td><?=$membresia->type?></td>
                                    <td><?=$membresia->student?></td>
                                    <td><?=$membresia->email?></td>
                                    <td><?=date('m / d / Y', strtotime($membresia->created_at)) ?></td>
                                    <td><?=date('m / d / Y', strtotime('+'.$membresia->max_time_membership.' month', strtotime($membresia->created_at)) )?></td>
                                    <td>
                                        <?=date('m / d / Y') < date('m / d / Y', strtotime('+'.$membresia->max_time_membership.' month', strtotime($membresia->created_at)) )?
                                            '<span class="dashboard-table__status dashboard-table__status--active">Activo</span>':
                                            '<span class="dashboard-table__status dashboard-table__status--inactive">Caducado</span>'
                                        ?>
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
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>