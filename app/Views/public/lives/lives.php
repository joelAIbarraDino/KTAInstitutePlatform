<?php include_once __DIR__.'/../../components/header.php'; ?>

<main class="cursos-principal">
    <section class="cursos-banner" data-aos="fade">
        <div class="cursos-banner__container">
            <h2 data-aos="fade-up" class="cursos-banner__titulo" data-section="lives" data-label="title">Nuestros cursos en vivo</h2>
        </div>
    </section>

    <?php if(!isset($category_url)):?>
        <section class="categorias">
            <div class="categorias__grid-3" data-aos="fade-up">
                
                <?php foreach($categories as $category ): ?>
                    <a href="/lives/categoria/<?=$category->id_category?>">
                        <div class="categoria">
                            <i class="categoria__icono bx <?=$category->icon?>"></i>

                            <p class="categoria__name"><?=$category->name?></p>
                            
                            <div class="categoria__logo-container">
                                <img class="categoria__logo" src="/assets/images/logoKTA.png" alt="">
                            </div>
                        </div>
                    </a>
                <?php endforeach;?>
            </div>

        </section>
    <?php endif;?>
    
    <?php if (isset($category_url)):?>
        <section class="cursos-container" data-aos="fade">        
            <div class="cursos-container__grid">
                <?php if(!empty($courses)):?>
                    <?php foreach($courses as $course):?>
                        <?php include __DIR__.'/../../components/courseCard.php'; ?>
                    <?php endforeach;?>
                <?php else:?>
                    <p class="cursos-container__empty">No hay cursos en vivo de esta categoria</p>
                <?php endif;?>
                
            </div>
        </section>
    <?php endif;?>

    <?php include_once __DIR__.'/../../components/bannerAsesorias.php'; ?>
</main>

<?php include_once __DIR__.'/../../components/footer.php'; ?>

<?php 
    $menuVersion = filemtime('assets/js/menu.js');
    $scripts ='
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
    ';
?>