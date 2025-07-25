<?php include_once __DIR__.'/../../components/header.php'; ?>

<main class="cursos-principal">
    <div class="cursos-banner" data-aos="fade">
        <div class="cursos-banner__container">
            <h2 data-aos="fade-up" class="cursos-banner__titulo" data-section="courses" data-label="title">Nuestros cursos</h2>
            <!-- <p class="cursos-banner__desc" id="main-content" data-section="courses" data-label="label">Empieza, cambia o avanza en tu carrera con KTA como guía.</p> -->
        </div>
    </div>

    <div class="cursos-filtro" data-aos="fade-up" data-aos-delay="50">
        <div class="cursos-filtro__categorias">
            <a class="cursos-filtro__categoria <?=!isset($category_url)?'cursos-filtro__categoria--active':''?>" href="/cursos" data-section="courses" data-label="all-courses">Todos los cursos</a>
            <?php foreach($categories as $category): ?>

                <?php if(isset($category_url)):?>
                    <a 
                        class="cursos-filtro__categoria  <?=$category_url == $category->id_category?'cursos-filtro__categoria--active':''?>"
                        href="/cursos/categoria/<?=$category->id_category?>"
                        ><?=$category->name?>
                    </a>

                <?php else:?>
                    <a 
                        class="cursos-filtro__categoria"
                        href="/cursos/categoria/<?=$category->id_category?>"
                        ><?=$category->name?>
                    </a>
                <?php endif;?>
                
            <?php endforeach ;?>
        </div>
    </div>

    <div class="cursos-container">
        
        <div class="cursos-container__grid">
            <?php if(!empty($courses)):?>
                <?php foreach($courses as $course):?>
                    <?php if($course->privacy == 'Público'):?>
                        <?php include __DIR__.'/../../components/courseCard.php'; ?>
                    <?php endif;?>
                <?php endforeach;?>
            <?php else:?>
                <p class="cursos-container__empty">No hay cursos de esta categoria</p>
            <?php endif;?>
            
        </div>
    </div>    
</main>

<?php include_once __DIR__.'/../../components/footer.php'; ?>

<?php 
    $menuVersion = filemtime('assets/js/menu.js');
    $scripts ='
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
    ';
?>