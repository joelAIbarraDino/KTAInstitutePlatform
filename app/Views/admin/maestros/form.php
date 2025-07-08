<div class="grid-elements">
    <div class="form__file col-4">
        <label for="photo-btn"> Foto de maestro (requerido)</label>
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
        <label for="name"> Nombre (requerido)</label>
        <input 
            type="text"
            name="name"
            id="name"
            class="field"
            placeholder="Nombre del maestro(a)"
            value="<?=$teacher->name??"" ?>"
            
        >
        <span id="msg-name" class="form__input-msg"></span>
    </div>

</div>

<div class="grid-elements">

    <div class="form__input col-6">
        <label for="speciality">Especialidad (requerido)</label>
        <input 
            type="text"
            name="speciality"
            id="speciality"
            class="field"
            placeholder="Area de experiencia"
            value="<?=$teacher->speciality??"" ?>"
            
        >
        <span id="msg-speciality" class="form__input-msg"></span>
    </div>

    <div class="form__input col-6">
        <label for="experience">Experiencia (requerido)</label>
        <div class="icon-left">
            <i class='bx bxs-graduation'></i>
            <input 
                type="text"
                name="experience"
                id="experience"
                class="field"
                placeholder="Tiempo en años de experiencia"
                value="<?=$teacher->experience??"" ?>"
            >
        </div>    
        <span id="msg-experience" class="form__input-msg"></span>
    </div>
    
</div>

<div class="grid-elements">
    <div class="form__input col-12">
        <label for="bio">Bio (requerido)</label>
        <textarea 
            name="bio" 
            id="bio"
            class="text-area"
            placeholder="Biografia y experiencia del maestro"
            
        ><?=$teacher->bio?></textarea>
        <span id="msg-bio" class="form__input-msg"></span>
    </div>
</div>