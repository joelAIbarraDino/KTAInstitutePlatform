<div class="grid-elements">

    <div class="form__input col-6">
        <label for="name"> Nombre (requerido)</label>
        <input 
            type="text"
            name="name"
            id="name"
            class="field"
            placeholder="Nombre del administrador(a)"
            value="<?=$admin->name??"" ?>"
            
        >
        <span id="msg-name" class="form__input-msg"></span>
    </div>

    <div class="form__input col-6">
        <label for="email"> Email (requerido)</label>
        <input 
            type="email"
            name="email"
            id="email"
            class="field"
            placeholder="Nombre del categoria"
            value="<?=$admin->email??"" ?>"
            
        >
        <span id="msg-email" class="form__input-msg"></span>
    </div>

</div>

<div class="grid-elements">

    <div class="form__input col-6">
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