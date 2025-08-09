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

    <!-- <div class="form__input col-6">
        <label for="id_teacher">Icono(obligatorio)</label>
            <select name="id_teacher" id="id_teacher" class="field" >
                <option value="" disabled selected>Seleccionar icono</option>
                <?php foreach($icons as $icono): ?>
                    <option value="<?=$icono?>" >
                        <i class="bx <?=$icono?>"></i>ffasdfas
                    </option>
                <?php endforeach;?>
                
            </select>
            <span id="msg-id_teacher" class="form__input-msg"></span>
    </div> -->
</div>