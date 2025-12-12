<?php //include_once __DIR__.'/../../components/icons.php'?>

<div class="grid-elements">

    <div class="form__input col-12">
        <label for="name"> Nombre (requerido)</label>
        <input 
            type="text"
            name="name"
            id="name"
            class="field"
            placeholder="Nombre del categoria"
            value="<?=$category->name?>"      
        >
        <span id="msg-name" class="form__input-msg"></span>
    </div>
</div>