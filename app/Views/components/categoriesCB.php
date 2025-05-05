<?php foreach($categories as $category): ?>
    <?php if(isset($course)):?>
        <option value="<?=$category->id_category?>" <?=$course->id_category === $category->id_category?"SELECTED":"" ?> ><?=$category->name?></option>
    <?php else:?>
        <option value="<?=$category->id_category?>"><?=$category->name?></option>
    <?php endif;?>
<?php endforeach; ?>