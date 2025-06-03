<?php include_once __DIR__.'/../../components/fontFamilyCB.php'; ?>

<div class="grid-elements border">
    <div class="form__file col-4">
        <label for="photo-btn"> Background de slider (requerido)</label>
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
</div>

<div class="grid-elements border">
    <div class="form__input col-11">
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

    <div class="form__input col-6">
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

    <div class="form__input col-6">
        <label for="size_title"> Tamaño de fuente (requerido)</label>
        <select name="size_title" id="size_title" class="field">
            <option value="" SELECTED DISABLED>Seleccione tamaño de titulo</option>
            <?php for ($size = 1; $size <= 10; $size++): ?>
                <?php 
                    $value = $size;
                    $selected = (isset($slidebar) && $slidebar->size_title == $size) ? 'SELECTED' : '';
                ?>
                <option value="<?= $value ?>" <?= $selected ?>><?= $size * 10?> px</option>
            <?php endfor; ?>
        </select>
        <span id="msg-font_title" class="form__input-msg"></span>
    </div>
</div>

<div class="grid-elements border">

    <div class="form__input col-11">
        <label for="subtitule"> Subtitulo (requerido)</label>
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
            id="color_subtiule"
            class="field-color"
            value="<?=$slidebar->color_subtitle?>"
        >
        <span id="msg-color_subtitle" class="form__input-msg"></span>
    </div>

    <div class="form__input col-6">
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

    <div class="form__input col-6">
        <label for="size_subtitle"> Tamaño de fuente (requerido)</label>

        <select name="size_subtitle" id="size_subtitle" class="field">
            <option value="" SELECTED DISABLED>Seleccione tamaño de subtitulo</option>
            
            <?php for ($size = 1; $size <= 10; $size++): ?>
                <?php 
                    $value = $size;
                    $selected = (isset($slidebar) && $slidebar->size_subtitle == $size) ? 'SELECTED' : '';
                ?>
                <option value="<?= $value ?>" <?= $selected ?> ><?= $size * 10 ?> px</option>
            <?php endfor; ?>

        </select>

        <span id="msg-font_subtitle" class="form__input-msg"></span>
    </div>

</div>

<div class="grid-elements border">

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

</div>