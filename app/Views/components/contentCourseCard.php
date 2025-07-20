<div class="course-info tabs__container">
    <img src="/assets/thumbnails/courses/<?=$course->thumbnail?>" alt="<?=$course->thumbnail?>" class="course-info__thumbnails">
    <div class="course-info__content">
        <h2 class="course-info__name"><?=$course->name?></h2>
        
        <button id="btn-status" class="course-info__status <?=$course->privacy?>" data-id="<?=$course->id_course?>" data-status="<?=$course->privacy?>"><i class='bx bx-show'></i> <?=$course->privacy ?></button>
    </div>
</div>