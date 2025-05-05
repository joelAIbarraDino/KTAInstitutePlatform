<?php foreach($teachers as $teacher): ?>
    <?php if(isset($course)):?>
        <option value="<?=$teacher->id_teacher?>"  <?=$course->id_teacher === $teacher->id_teacher?"SELECTED":"" ?> ><?=$teacher->name?></option>
    <?php else:?>
        <option value="<?=$teacher->id_teacher?>"><?=$teacher->name?></option>
    <?php endif;?>
<?php endforeach; ?>
