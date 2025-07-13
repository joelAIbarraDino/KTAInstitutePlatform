<?php include_once __DIR__.'/../../components/fontFamilyCB.php'; ?>

<div class="grid-elements border">

    <div class="form__input col-4">
        <label for="type_background">Tipo de fondo (obligatorio)</label>
            <select name="type_background" id="type_background" class="field" >
                <option value="" disabled selected>Seleccionar</option>
                <option value="picture" <?=$slidebar->type_background ==="picture"?"SELECTED":"" ?> >Imagen de fondo</option>
                <option value="video" <?=$slidebar->type_background ==="video"?"SELECTED":"" ?> > Video de fondo</option>
            </select>
    </div>

    <div id="input-image" class="form__file col-4 <?=$slidebar->type_background=="picture"?'':'no-show-input'?>">
        <label for="background"> Imagen de fondo (requerido)</label>
        <input 
            type="file"
            name="background"
            id="background"
            accept="image/*"
            hidden
            class="real-btn-file"
        >
        <button type="button" class="form__file-btn btn-file">Seleccionar foto</button>
        <span class="form__input-msg name-file"></span>
    </div>

    <div id="input-vimeo" class="form__input col-4 <?=$slidebar->type_background=="video"?'':'no-show-input'?>">
        <label for="id_video"> Vimeo ID(requerido)</label>
        <input 
            type="number"
            name="id_video"
            id="id_video"
            class="field"
            placeholder="ID de video en Vimeo"
            value="<?=$slidebar->id_video?>"
        >
        <span id="msg-name" class="form__input-msg"></span>
    </div>
</div>

<div class="grid-elements border">

    <div class="form__input col-8">
        <label for="title"> Titulo (requerido)</label>
        <input 
            type="text"
            name="title"
            id="title"
            class="field"
            placeholder="Titulo de slider"
            value="<?=$slidebar->title ?>"
            
        >
        <span id="msg-name" class="form__input-msg"></span>
    </div>

    <div class="form__input col-1">
        <label for="color_title"> Color</label>
        <input 
            type="color"
            name="color_title"
            id="color_title"
            class="field-color"
            value="<?=$slidebar->color_title?>"
        >
        <span id="msg-color_title" class="form__input-msg"></span>
    </div>

    <div class="form__input col-3">
        <label for="font_title"> Fuente (requerido)</label>
        <select name="font_title" id="font_title" class="field">
            <option value="" SELECTED DISABLED>Seleccione una fuente</option>
            <?php foreach ($fonts as $font => $label): ?>
                <?php
                    $selected = (isset($slidebar) && $slidebar->font_title === $font) ? 'selected' : '';
                    $style = "font-family: '{$font}';";
                ?>
                <option value="<?= $font ?>" style="<?= $style ?>" <?= $selected ?>><?= $label ?></option>
            <?php endforeach; ?>
        </select>
        <span id="msg-name" class="form__input-msg"></span>
    </div>
</div>

<div class="grid-elements border">

    <div class="form__input col-8">
        <label for="subtitle"> Subtitulo (requerido)</label>
        <input
            type="text"
            name="subtitle"
            id="subtitle"
            class="field"
            placeholder="Subtitulo de slider"
            value="<?=$slidebar->subtitle?>"
            
        >
        <span id="msg-email" class="form__input-msg"></span>
    </div>

    <div class="form__input col-1">
        <label for="color_subtitle"> Color</label>
        <input 
            type="color"
            name="color_subtitle"
            id="color_subtitle"
            class="field-color"
            value="<?=$slidebar->color_subtitle?>"
        >
        <span id="msg-color_subtitle" class="form__input-msg"></span>
    </div>

    <div class="form__input col-3">
        <label for="font_subtitle"> Fuente (requerido)</label>
        <select name="font_subtitle" id="font_subtitle" class="field">
            <option value="" SELECTED DISABLED>Seleccione una fuente</option>
            <?php foreach ($fonts as $font => $label): ?>
                <?php
                    $selected = (isset($slidebar) && $slidebar->font_subtitle === $font) ? 'selected' : '';
                    $style = "font-family: '{$font}';";
                ?>
                <option value="<?= $font ?>" style="<?= $style ?>" <?= $selected ?>><?= $label ?></option>
            <?php endforeach; ?>
        </select>
        <span id="msg-font_subtitle" class="form__input-msg"></span>
    </div>

</div>

<div class="grid-elements border">
    
    <div class="form__input col-6">
        <label for="CTA"> Call to Action</label>
        <input
            type="text"
            name="CTA"
            id="CTA"
            class="field"
            placeholder="el texto que aparecera en el boton del enlace"
            value="<?=$slidebar->CTA?>"
            
        >
        <span id="msg-email" class="form__input-msg"></span>
    </div>

    <div class="form__input col-6">
        <label for="link"> Enlace</label>
        <div class="icon-left">
            <i class='bx bx-link'></i>
            <input 
                type="text"
                name="link"
                id="link"
                class="field"
                placeholder="Enlace a otra pagina (opcionar)"
                value="<?=$slidebar->link ?>"
            >
        </div>  
        <span id="msg-name" class="form__input-msg"></span>
    </div>

</div>