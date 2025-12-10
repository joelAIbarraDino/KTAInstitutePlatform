<div class="curso">
    <div class="curso__imagen-contenedor">
        <a href="/curso/view/<?=$course->url?>">
            <img src="/assets/thumbnails/courses/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>" class="curso__imagen">
        </a>
        <span class="curso__categoria"><?=$course->category?></span>
    </div>
    <div class="curso__contenido">
        <a href="/curso/view/<?=$course->url?>"><h3 class="curso__nombre curso__nombre--student" data-section="course-<?=$course->id_course?>" data-label="name"><?=$course->name?></h3></a>
    </div>
</div>