<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

        <div class="top-main">
            <h1 class="main__title">Cursos registrados</h1>
            <a class="btn nuevo" href="/admin/curso/new"><i class='bx bx-plus'></i> Nuevo curso</a>
        </div>

        <div class="records">
            <?php for($i = 0; $i < 10; $i++): ?>

            <div class="record">
                <div class="record__col-main">
                    <a class="record__col-main-thumbnail" href="/curso/10">
                        <img src="/assets/courses/cover.jpg" alt="cover de curso">
                    </a>
                </div>

                <div class="record__col-main-2">
                    <a href="/cursos/edit/10" class="record__col-main-2-title">Bookkeping E-commerece fdsfsda fasdf</a>
                    <p class="record__col-main-2-category">Finanzas</p>

                    <div class="record__col-main-2-prices">
                        <div class="record__col-main-2-prices-price">$200 USD</div>
                    </div>
                </div>

                <div class="record__col-info">
                    <p class="record__col-info-title">Creado el</p>
                    <p class="record__col-info-date">10 Nov 2025</p>
                </div>

                <div class="record__col-info">
                    <p class="record__col-info-title">Privacidad</p>
                    <p class="record__col-info-date">Borrador</p>
                </div>

                <div class="record__col-info">
                    <p class="record__col-info-title">Inscritos</p>
                    <a href="/maestro/10" class="record__col-info-date--link">10</a>
                </div>

                <div class="record__col-info">
                    <p class="record__col-info-title">Acceso a contenido</p>
                    <p class="record__col-info-date">6 meses</p>
                </div>

                <div class="record__col-info">
                    <p class="record__col-info-title">Instructor</p>
                    <a href="/maestro/10" class="record__col-info-date--link">Carlos Catarino</a>
                </div>
            </div>

            <div class="record">
                <div class="record__col-main">
                    <a class="record__col-main-thumbnail" href="/curso/10">
                        <img src="/assets/courses/cover.jpg" alt="cover de curso">
                    </a>
                </div>

                <div class="record__col-main-2">
                    <a href="/cursos/edit/10" class="record__col-main-2-title">Bookkeping E-commerece</a>
                    <p class="record__col-main-2-category">Finanzas</p>

                    <div class="record__col-main-2-prices">
                        <div class="record__col-main-2-prices-price disc">$200 USD</div>
                        <div class="record__col-main-2-prices-disc">$150 USD</div>
                    </div>
                </div>

                <div class="record__col-info">
                    <p class="record__col-info-title">Creado el</p>
                    <p class="record__col-info-date">10 Nov 2025</p>
                </div>

                <div class="record__col-info">
                    <p class="record__col-info-title">Privacidad</p>
                    <p class="record__col-info-date">Borrador</p>
                </div>

                <div class="record__col-info">
                    <p class="record__col-info-title">Inscritos</p>
                    <a href="/maestro/10" class="record__col-info-date--link">10</a>
                </div>

                <div class="record__col-info">
                    <p class="record__col-info-title">Acceso a contenido</p>
                    <p class="record__col-info-date">6 meses</p>
                </div>

                <div class="record__col-info">
                    <p class="record__col-info-title">Instructor</p>
                    <a href="/maestro/10" class="record__col-info-date--link">Carlos Catarino</a>
                </div>
            </div>

            <?php endfor ;?>
        </div>

    </div>
</main>

<?php
    $scripts = '
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>