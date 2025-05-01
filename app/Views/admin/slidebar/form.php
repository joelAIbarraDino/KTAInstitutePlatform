<div class="grid-elements">
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

<div class="grid-elements">

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

    <div class="form__input col-11">
        <label for="subtitule"> Subtitulo (requerido)</label>
        <input
            type="text"
            name="subtitule"
            id="subtitule"
            class="field"
            placeholder="Nombre del categoria"
            value="<?=$slidebar->subtitule?>"
            
        >
        <span id="msg-email" class="form__input-msg"></span>
    </div>

    <div class="form__input col-1">
        <label for="color_subtitule"> Color</label>
        <input 
            type="color"
            name="color_subtitule"
            id="color_subtitule"
            class="field-color"
            value="<?=$slidebar->color_subtitule?>"
        >
        <span id="msg-color_subtitule" class="form__input-msg"></span>
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