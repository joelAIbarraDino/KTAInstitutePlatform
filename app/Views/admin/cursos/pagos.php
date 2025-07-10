<?php

use App\Classes\Helpers;

 include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

    <div class="dashboard-table">
            <div class="dashboard-table__header">
                <h2 class="dashboard-table__title">Pagos de cursos</h2>
                <div class="dashboard-table__actions">
                </div>
            </div>
            
            <div class="dashboard-table__container">
                <table class="dashboard-table__table">
                    <thead class="dashboard-table__thead">
                        <tr>
                            <th>Creado el</th>
                            <th>Curso</th>
                            <th>Nombre de estudiante</th>
                            <th>Email</th>
                            <th>Monto</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="dashboard-table__tbody">

                        <?php if(count($pagos) > 0): ?>

                            <?php foreach($pagos as $pago): ?>
                                <tr>
                                    <td><?=$pago->created_at?></td>
                                    <td><?=$pago->name?></td>
                                    <td><?=$pago->student?></td>
                                    <td><?=$pago->email?></td>
                                    <td>$ <?=$pago->amount.' '.$pago->currency?></td>
                                    <td>
                                        <?php if($pago->status == "pagado"):?>
                                            <span class="dashboard-table__status dashboard-table__status--active"><?=$pago->status ?></span>
                                        <?php else: ?>
                                            <span class="dashboard-table__status dashboard-table__status--inactive"><?=$pago->status ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>                    
                            <?php endforeach;?>
                        <?php else: ?>

                            <tr>
                                <td colspan="6" class="dashboard-table__no-result">no hay registros</td>
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