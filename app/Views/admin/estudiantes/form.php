<div class="grid-elements border">

    <div class="form__input col-12">
        <label for="name"> Nombre (requerido)</label>
        <input 
            type="text"
            name="name"
            id="name"
            class="field"
            placeholder="Nombre del estudiante"
            value="<?=$student->name??"" ?>"
            
        >
        <span id="msg-name" class="form__input-msg"></span>
    </div>

    <div class="form__input col-6">
        <label for="email"> Email (requerido)</label>
        <div class="icon-left">
            <i class='bx bx-envelope'></i>
            <input 
                type="email"
                name="email"
                id="email"
                class="field"
                placeholder="Correo electronico de estudiante"
                value="<?=$student->email??"" ?>"
                
            >
        </div>
        <span id="msg-email" class="form__input-msg"></span>
    </div>

    <div class="form__input col-6">
        <label for="phone"> Teléfono (requerido)</label>
        <div class="icon-left">
            <i class='bx bx-phone'></i>
            <input 
                type="phone"
                name="phone"
                id="phone"
                class="field"
                placeholder="Teléfono del estudiante"
                value="<?=$student->phone??"" ?>"
                
            >
        </div>
    </div>

</div>

<div class="grid-elements border">
    <div class="form__input col-12">
        <label for="password">Contraseña (requerido)</label>
    
        <div class="icon-right">
            <input 
                type="password"
                name="password"
                id="password"
                class="field"
                placeholder="Ingrese una contraseña"
            >
            <i id="btn-showPass" class='bx bx-show is-btn'></i>
        </div>    
        <span id="msg-password" class="form__input-msg"></span>
    </div>
</div>

<div class="grid-elements border">
    <div class="form__input col-12">
        <label for="street">Calle</label>
        <input 
            type="text"
            name="street"
            id="street"
            class="field"
            placeholder="Calle de dirección"
            value="<?=$student->street??"" ?>"
        >
    </div>

    <div class="form__input col-4">
        <label for="number_street">Numero</label>
        <input 
            type="text"
            name="number_street"
            id="number_street"
            class="field"
            placeholder="Numero de la calle"
            value="<?=$student->number_street??"" ?>"
        >
    </div>

    <div class="form__input col-4">
        <label for="state">Estado</label>
        <input 
            type="text"
            name="state"
            id="state"
            class="field"
            placeholder="Estado"
            value="<?=$student->state??"" ?>"
        >
    </div>

    <div class="form__input col-4">
        <label for="cp">Codigo Postal</label>
        <input 
            type="text"
            name="cp"
            id="cp"
            class="field"
            placeholder="Codigo Postal"
            value="<?=$student->cp??"" ?>"
        >
    </div>
    
</div>
