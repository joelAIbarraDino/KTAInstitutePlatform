<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

        <div class="top-main">
            <h1 class="main__title">Categorias registradas</h1>
            <a class="btn nuevo" href="/admin/categoria/create"><i class='bx bx-plus'></i> Nueva categorias</a>
        </div>

        <div class="records">

            <?php if(count($categories) > 0): ?>
                <?php foreach($categories as $category):?>
                    <div class="record-flex">

                        <div class="record-flex__col-info">
                            <p class="record-flex__col-info-title">Categoria</p>
                            <p class="record-flex__col-info-date"><?=$category->name?></p>
                        </div>

                        <div class="record-flex__col-action">
                            <button class="record__col-action-link" data-id="<?=$category->id_category?>">Eliminar</button>
                        </div>
                    </div>
                <?php endforeach;?>

            <?php else: ?>
                <div class="record empty">
                    <p>No hay categorias registradas</p>
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
        <script src="/assets/js/deleteCourse.js"></script>
    ';
?>