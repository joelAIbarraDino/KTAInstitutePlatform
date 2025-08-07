<?php include_once __DIR__.'/../../components/fontFamilyCB.php'; ?>

<div class="grid-elements border">

    <div class="form__input col-12">
        <label for="text_banner"> Texto (requerido)</label>
        <input 
            type="text"
            name="text_banner"
            id="text_banner"
            class="field"
            placeholder="Titulo de slider"
            value="<?=$bannerAsesoria->text_banner ?>"
            
        >
        <span id="msg-name" class="form__input-msg"></span>
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
            value="<?=$bannerAsesoria->CTA?>"
            
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
                value="<?=$bannerAsesoria->link ?>"
            >
        </div>  
        <span id="msg-name" class="form__input-msg"></span>
    </div>

</div>