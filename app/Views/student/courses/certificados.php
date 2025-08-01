<?php 
    $topScripts ='
        <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    ';

    include_once __DIR__.'/../../components/estudentToolbar.php'; 
?>

<main class="background-profile">
    <section class="courses-container">
        <h3 class="last-courses__title"data-aos="fade-down">Mis certificados</h3>
        <hr class="linea-personalizada" data-aos="fade">

        <div class="certificados" data-aos="fade-up">
            <?php foreach($certificados as $certificado):?>
                <div class="certificado-card">
                    <div class="certificado-card__left">
                        <img class="certificado-card__img" src="/assets/thumbnails/courses/<?=$certificado['thumbnail']?>" alt="<?=$certificado['thumbnail']?>">
                        <div class="certificado-card__data">
                            <p class="certificado-card__name"><?=$certificado['name_course']?></p>
                            <p class="certificado-card__date"><span>Fecha de expedición:</span> <?= date('Y/m/d', strtotime($certificado['date']))?></p>
                            <p class="certificado-card__method"><span>Aprobado por:</span> <?=$certificado['method']?></p>
                        </div>
                    </div>

                    <div class="certificado-card__right">
                        <a href="/certificado-curso/<?=$certificado['url']?>" target="_blank"> <div class="certificado-card__button"><i class='bx bx-download'></i> Descargar certificado</div></a>
                    </div>
                </div>

            <?php endforeach;?>                

        </div>

    </section>
    
</main>

<?php include_once __DIR__.'/../../components/footer.php'; ?>

<?php 
    $scripts ='
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>