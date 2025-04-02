<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

        <div class="top-main">
            <h1 class="main__title">Cursos registrados</h1>
            <a class="btn nuevo" href="/admin/curso/create"><i class='bx bx-plus'></i> Nuevo curso</a>
        </div>

        <div class="records">

            <?php if(count($courses) > 0): ?>
                <?php foreach($courses as $course):?>
                    <div class="record">
                        <div class="record__col-main">
                            <a class="record__col-main-thumbnail" href="/curso/<?=$course->id_course?>">
                                <img src="/assets/thumbnails/<?=$course->thumbnail?>" alt="caratula de curso">
                            </a>
                        </div>

                        <div class="record__col-main-2">
                            <a href="/admin/curso/edit/<?=$course->id_course?>" class="record__col-main-2-title"><?=$course->name?></a>
                            <p class="record__col-main-2-category"><?=$course->category?></p>

                            <?php if(isset($course->discount)):?>
                                <div class="record__col-main-2-prices">
                                    <div class="record__col-main-2-prices-price disc">$<?=$course->price?> USD</div>
                                    <div class="record__col-main-2-prices-disc">$<?=$course->price * (1 - ($course->discount/100))?> USD</div>
                                </div>
                            <?php else:?>    
                                <div class="record__col-main-2-prices">
                                    <div class="record__col-main-2-prices-price">$<?=$course->price?> USD</div>
                                </div>
                            <?php endif;?>
                        </div>

                        <div class="record__col-info">
                            <p class="record__col-info-title">Creado el</p>
                            <p class="record__col-info-date"><?=$course->created_at?></p>
                        </div>

                        <div class="record__col-info">
                            <p class="record__col-info-title">Privacidad</p>
                            <p class="record__col-info-date"><?=$course->privacy ?></p>
                        </div>

                        <div class="record__col-info">
                            <p class="record__col-info-title">Inscritos</p>
                            <a href="/maestro/10" class="record__col-info-date--link"><?=$course->enrollment?></a>
                        </div>

                        <div class="record__col-info">
                            <p class="record__col-info-title">Acceso a contenido</p>
                            <p class="record__col-info-date"><?=$course->max_months_enroll ?> meses</p>
                        </div>

                        <div class="record__col-info">
                            <p class="record__col-info-title">Instructor</p>
                            <a href="/admin/maestro/<?=$course->id_teacher ?>" class="record__col-info-date--link"><?=$course->teacher ?></a>
                        </div>

                        <div class="record__col-action">
                            <button class="record__col-action-link" data-id="<?=$course->id_course?>">Eliminar</button>
                        </div>
                    </div>
                <?php endforeach;?>

            <?php else: ?>
                <div class="record empty">
                    <p>No hay cursos registrados</p>
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