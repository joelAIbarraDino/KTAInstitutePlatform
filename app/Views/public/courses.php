<?php include_once __DIR__.'/../components/header.php'; ?>

<div class="principal cursos-principal">

    <div class="cursos-filtro width-80">
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
        
        <div class="cursos-container__grid width-80">
            <?php foreach($courses as $course):?>
                
                <?php include __DIR__.'/../components/courseCard.php'; ?>

            <?php endforeach;?>
        </div>
    </div>

    
</div>

<?php include_once __DIR__.'/../components/footer.php'; ?>

<?php 
    $scripts ='
        <script src="/assets/js/header.js"></script>
    ';
?>