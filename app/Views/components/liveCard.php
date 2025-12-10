<div class="curso">
    <div class="curso__imagen-contenedor">
        <a href="/live/view/<?=$live->url?>">
            <img src="/assets/thumbnails/lives/<?=$live->thumbnail?>" alt="<?=$live->thumbnail?>" class="curso__imagen">
        </a>            
        <span class="curso__categoria"><?=$live->category?></span>
    </div>
    <div class="curso__contenido">
        <a href="/live/view/<?=$live->url?>"><h3 class="curso__nombre curso__nombre--student" data-section="live-<?=$live->id_live?>" data-label="name"><?=$live->name?></h3></a>
    </div>
</div>