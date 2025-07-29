<?php include_once __DIR__.'/../../components/header.php'; ?>

<main class="cursos-principal">
    <section class="cursos-banner" data-aos="fade">
        <div class="cursos-banner__container">
            <h2 data-aos="fade-up" class="cursos-banner__titulo" data-section="lives" data-label="title">Nuestros cursos en línea</h2>
            <!-- <p class="cursos-banner__desc" id="main-content" data-section="courses" data-label="label">Empieza, cambia o avanza en tu carrera con KTA como guía.</p> -->
        </div>
    </section>
    
    <section class="cursos-filtro" data-aos="fade-up" data-aos-delay="50">

        <div class="cursos-filtro__categorias">
            <a class="cursos-filtro__categoria <?=!isset($category_url)?'cursos-filtro__categoria--active':''?>" href="/lives" data-section="courses" data-label="all-courses">Todos los cursos</a>
            <?php foreach($categories as $category): ?>

                <?php if(isset($category_url)):?>
                    <a 
                        class="cursos-filtro__categoria  <?=$category_url == $category->id_category?'cursos-filtro__categoria--active':''?>"
                        href="/lives/categoria/<?=$category->id_category?>"
                        ><?=$category->name?>
                    </a>

                <?php else:?>
                    <a 
                        class="cursos-filtro__categoria"
                        href="/lives/categoria/<?=$category->id_category?>"
                        ><?=$category->name?>
                    </a>
                <?php endif;?>
                
            <?php endforeach ;?>
        </div>
    </section>

    <section class="cursos-container" data-aos="fade">
        
        <div class="cursos-container__grid">
            <?php if(!empty($lives)):?>
                <?php foreach($lives as $live):?>
                    <?php if($live->privacy == 'Público'):?>
                        <?php include __DIR__.'/../../components/liveCard.php'; ?>
                    <?php endif;?>
                <?php endforeach;?>
            <?php else:?>
                <p class="cursos-container__empty">No hay cursos en vivo de esta categoria</p>
            <?php endif;?>
            
        </div>
    </section>
    
    <section class="curso-banner-asesoria">
        <p class="curso-banner-asesoria__texto" data-section="courses" data-label="banner-title">¿No sabes cuál elegir? Agenda una asesoría gratuita aquí 👇</p>
        <a href="https://calendly.com/ktainstitute/asesoria-30-minutos">
            <div class="curso-banner-asesoria__button" data-section="courses" data-label="banner-cta">¡Quiero una asesoria!</div>
        </a>
    </section>
</main>

<?php include_once __DIR__.'/../../components/footer.php'; ?>

<?php 
    $menuVersion = filemtime('assets/js/menu.js');
    $scripts ='
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
    ';
?>