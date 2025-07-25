<?php

use App\Classes\Helpers;

 include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

    <div class="dashboard-table">
            <div class="dashboard-table__header">
                <h2 class="dashboard-table__title">Pagos de lives</h2>
                <div class="dashboard-table__actions">
                </div>
            </div>
            
            <div class="dashboard-table__container">
                <table class="dashboard-table__table">
                    <thead class="dashboard-table__thead">
                        <tr>
                            <th>Creado el</th>
                            <th>Live</th>
                            <th>Nombre de estudiante</th>
                            <th>Email</th>
                            <th>Monto</th>
                            <th>Status</th>
                            <th>Metodo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="dashboard-table__tbody">

                        <?php if(count($pagos) > 0): ?>

                            <?php foreach($pagos as $pago): ?>
                                <tr>
                                    <td><?=$pago->created_at?></td>
                                    <td><?=$pago->live?></td>
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
                                    <td><?=ucfirst($pago->method)?></td>
                                    <td class="dashboard-table__actions-cell">
                                        <a href="/kta-admin/comprobante/<?=$pago->id_payment?>/<?=$pago->id_student?>" class="dashboard-table__action dashboard-table__action--extra"><i class='bx bxs-file-pdf'></i></a>
                                    </td>

                                </tr>                    
                            <?php endforeach;?>
                        <?php else: ?>

                            <tr>
                                <td colspan="7" class="dashboard-table__no-result">no hay registros</td>
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