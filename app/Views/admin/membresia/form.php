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
