<?php include_once __DIR__.'/../components/header.php';?>

<div class="principal">

    <div class="ver-profesor">   
        <h1 class="ver-profesor__titulo">Conoce a tu instructor</h1>
        <div class="ver-profesor__container width-50">
            <img class="ver-profesor__foto" src="/assets/teachers/<?=$teacher->photo?>" alt="<?=$teacher->photo?>">

            <div class="ver-profesor__data">
                <div class="ver-profesor__name">
                    <?=$teacher->name?>
                    <div class="ver-profesor__speciality"><?=$teacher->speciality?></div>
                </div>

                <div class="ver-profesor__experience">
                    <?=$teacher->experience?> años de <span>experiencia</span>
                </div>

                <div class="ver-profesor__bio">
                    <?=$teacher->bio?>
                </div>
            </div>
        </div>

    </div>

    <div id="cursos-profesor" class="cursos-profesor">
        <h2 class="cursos-profesor__titulo">Cursos de <?=$teacher->name?></h2>
        <div class="cursos-profesor__container width-80">
            <?php foreach($courses as $course):?>
                <?php include __DIR__.'/../components/courseCard.php'; ?>
            <?php endforeach;?>
        </div>
    </div>
</div>

<?php include_once __DIR__.'/../components/footer.php';?>