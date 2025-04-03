<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

        <div class="top-main">
            <h1 class="top-main__title">Categorias registradas</h1>
            <a class="btn nuevo" href="/admin/categoria/create"><i class='bx bx-plus'></i> Nueva categorias</a>
        </div>

        <div class="table-2 show-2">

            <?php if(count($categories) > 0): ?>

                <div class="header">
                    <p class="title-header" >Categoria</p>
                    <p class="title-header">Acciones</p>
                </div>

                <?php foreach($categories as $category):?>
                    <div class="row">
                        <div class="cell">
                            <div class="col-info">
                                <a class="col-info-date--link" href="/admin/categoria/update/<?=$category->id_category?>"><?=$category->name?></a>
                            </div>
                        </div>

                        <div class="cell">
                            <div class="col-action">
                                <button class="col-action-link delete-category" data-id="<?=$category->id_category?>">Eliminar</button>
                            </div>
                        </div>

                        
                    </div>
                <?php endforeach;?>

            <?php else: ?>
                <div class="empty">
                    <p class="text">No hay categorias registradas</p>
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
        <script src="/assets/js/deleteCategory.js"></script>
    ';
?>