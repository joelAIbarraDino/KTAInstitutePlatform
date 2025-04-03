<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

        <div class="top-main">
            <h1 class="main__title">Inscripciones registradas</h1>
        </div>

        <div class="table-4 show-2">

            <div class="header">
                <p class="title-header" >Titulo 1</p>
                <p class="title-header hidden">Titulo 2</p>
                <p class="title-header" >titulo 3</p>
                <p class="title-header hidden">titulo 4</p>
            </div>

            <div class="row">

                <div class="">
                    <p class="info-title" >Titulo 1</p>
                </div>

                <div class="hidden">
                    <p class="info-title">Titulo 2</p>
                </div>

                <div class="hidden">
                    <p class="info-title" >titulo 3</p>
                </div>

                <div class="">
                    <p class="info-title">titulo 4</p>
                </div>
            </div>

            <div class="row">

                <div class="">
                    <p class="info-title" >Titulo 1</p>
                </div>

                <div class="hidden">
                    <p class="info-title">Titulo 2</p>
                </div>

                <div class="hidden">
                    <p class="info-title" >titulo 3</p>
                </div>

                <div class="">
                    <p class="info-title">titulo 4</p>
                </div>
            </div>

            <div class="row">

                <div class="">
                    <p class="info-title" >Titulo 1</p>
                </div>

                <div class="hidden">
                    <p class="info-title">Titulo 2</p>
                </div>

                <div class="hidden">
                    <p class="info-title" >titulo 3</p>
                </div>

                <div class="">
                    <p class="info-title">titulo 4</p>
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
        <script src="/assets/js/deleteCategory.js"></script>
    ';
?>