<?php include_once __DIR__.'/../components/header.php'; ?>

<main class="cursos-principal">

    <div class="cursos-filtro">
        <h1 class="cursos-filtro__titulo" >Nuestros cursos</h1>
        <p class="cursos-filtro__desc" id="main-content">Empieza, cambia o avanza en tu carrera con KTA como guía.</p>

        <div class="cursos-filtro__categorias">
            <a class="cursos-filtro__categoria <?=!isset($category_url)?'cursos-filtro__categoria--active':''?>" href="/cursos" >Todos los cursos</a>
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
                        <?php include __DIR__.'/../components/courseCard.php'; ?>
                    <?php endif;?>
                <?php endforeach;?>
            <?php else:?>
                <p class="cursos-container__empty">No hay cursos de esta categoria</p>
            <?php endif;?>
            
        </div>
    </div>    
</main>

<?php include_once __DIR__.'/../components/footer.php'; ?>

<?php 
    $menuVersion = filemtime('assets/js/menu.js');
    $scripts ='
        <script src="/assets/js/menu.js?v='.$menuVersion.'"></script>
    ';
?>