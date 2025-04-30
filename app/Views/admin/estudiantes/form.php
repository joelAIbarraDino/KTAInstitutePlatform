<div class="grid-elements">

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
        <label for="phone"> Telefono (requerido)</label>

        <div class="icon-left">
            <i class='bx bxs-phone' ></i>
            <input 
                type="tel"
                name="phone"
                id="phone"
                class="field"
                placeholder="Telefono de estudiante"
                value="<?=$student->phone??"" ?>"
            >

        </div>
        <span id="msg-phone" class="form__input-msg"></span>
    </div>

    <div class="form__input col-6">
        <label for="birthday"> Fecha de nacimiento (requerido)</label>

        <div class="icon-left">
            <i class='bx bxs-party'></i>
            <input 
                type="date"
                name="birthday"
                id="birthday"
                class="field"
                placeholder="Fecha de nacimiento"
                value="<?=$student->birthday??"" ?>"
                max="<?=date("Y-m-d")?>"
            >
        </div>
        <span id="msg-birthday" class="form__input-msg"></span>
    </div>

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