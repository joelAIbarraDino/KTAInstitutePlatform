<div class="grid-elements">
    <div class="form__file col-4">
        <label for="photo-btn"> Foto de membresia (requerido)</label>
        <input 
            type="file"
            name="photo"
            id="photo"
            accept="image/*"
            hidden
            class="real-btn-file"
        >
        <button type="button" class="form__file-btn btn-file">Seleccionar foto</button>
        <span class="form__input-msg name-file"></span>
    </div>
</div>

<div class="grid-elements">

    <div class="form__input col-12">
        <label for="type"> Nombre de membresía (requerido)</label>
        <input 
            type="text"
            name="type"
            id="type"
            class="field"
            placeholder="Nombre o nivel de la membresia"
            value="<?=$membership->type??"" ?>"
            
        >
    </div>

    <div class="form__input col-6">
        <label for="max_time_membership"> Acceso a membresia (requerido)</label>
        <input 
            type="number"
            name="max_time_membership"
            id="max_time_membership"
            class="field"
            placeholder="Acceso en meses para tener la membresia"
            value="<?=$membership->max_time_membership??"" ?>"
            
        >
    </div>

    <div class="form__input col-6">
        <label for="price">Precio (obligatorio)</label>
        <div class="icon-left">
            <i class='bx bx-dollar'></i>
            <input 
                type="text"
                name="price"
                id="price"
                class="field"
                placeholder="Precio del curso"
                value="<?=$membership->price?>"
            >
        </div>    
    </div>

</div>

<div class="grid-elements">
    <div class="form__input col-12">
        <label for="caract">Descripción de membresía</label>
        <div id="editor" style="height: 40rem;"></div>
        <input type="hidden" id="input-editor" name="caract" value="<?= htmlspecialchars($membership->caract, ENT_QUOTES) ?>">
    </div>
</div>

