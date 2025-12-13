<?php
    use App\Classes\Helpers;

    $versionSearchCursos = filemtime('assets/js/BuscadorTabla.js');

    $topScripts ='
        <script src="/assets/js/BuscadorTabla.js?v='.$versionSearchCursos.'"></script>
    ';    
    include_once __DIR__.'/../../components/adminToolbar.php'; 
?>

<main class="main">
    <div class="main__container">

        <div class="dashboard-search">
            <label class="dashboard-search__label" for="search-input">Buscar:</label>
            
            <div class="dashboard-search__input-container">
                <input id="search-input" class="dashboard-search__input" type="text" placeholder="Ingrese nombre">
                <button id="search-btn" class="dashboard-search__enter"><i class='bx bx-subdirectory-left'></i></button>
            </div>
        </div>

        <div class="dashboard-table">
            <div class="dashboard-table__header">
                <h2 class="dashboard-table__title">Administradores</h2>
                <div class="dashboard-table__actions">
                <a href="/kta-admin/administrador/create" class="dashboard-table__button"> <i class='bx bx-plus'></i> Nuevo </a>
                </div>
            </div>
            
            <div class="dashboard-table__container">
                <table class="dashboard-table__table">
                    <thead class="dashboard-table__thead">
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th class="actions-label">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="dashboard-table__tbody" id="search-result">

                        <?php if(count($admins) > 0): ?>

                            <?php foreach($admins as $admin): ?>

                                <tr>
                                    <td><?=$admin->name?></td>
                                    <td><?=$admin->email?></td>
                                    <td class="dashboard-table__actions-cell">
                                        <a href="/kta-admin/administrador/update/<?=$admin->id_admin?>" class="dashboard-table__action dashboard-table__action--edit"><i class='bx bx-edit'></i></a>
                                        <button data-id="<?=$admin->id_admin?>" class="dashboard-table__action dashboard-table__action--delete"><i class='bx bx-trash'></i></button>
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
            
            <?=$paginacion?>

        </div>
    </div>
</main>

<script>
    const buscadorPagos = new BuscadorTabla({
        inputSelector: '#search-input',
        buttonSelector: '#search-btn',
        tableSelector: '#search-result',
        endpoint: '/api/admin/',
        columnas: 3,
        template: `
            <tr>
                <td>{{name}}</td>
                <td>{{email}}</td>
                <td class="dashboard-table__actions-cell">
                    <a href="/kta-admin/administrador/update/{{id_admin}}" class="dashboard-table__action dashboard-table__action--edit">
                    <i class='bx bx-edit'></i>
                    </a>
                    <button data-id="{{id_admin}}" class="dashboard-table__action dashboard-table__action--delete">
                    <i class='bx bx-trash'></i>
                    </button>
                </td>
            </tr>
        `,
        atributoBusqueda: function(valor) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(valor) ? 'email' : 'name';
        }
    });

</script>


<?php
    $scripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script type="module" src="/assets/js/deleteAdmin.js"></script>
    ';

    Helpers::showSwalAlert();
?>