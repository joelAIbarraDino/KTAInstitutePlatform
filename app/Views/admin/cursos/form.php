<div class="grid-elements border">
        
    <div class="form__file col-4">
        <label for="thumbnail-btn"> Caratula de curso (requerido)</label>
        <input 
            type="file"
            name="thumbnail"
            id="thumbnail"
            accept="image/*"
            hidden
            class="real-btn-file"
        >
        <button type="button" class="form__file-btn  btn-file">Seleccionar caratula de curso</button>
        <span class="form__input-msg name-file"></span>
    </div>

</div>

<div class="grid-elements border">

    <div class="form__input col-6">
        <label for="name"> Nombre (requerido)</label>
        <input 
            type="text"
            name="name"
            id="name"
            class="field"
            placeholder="Nombre del curso"
            value="<?=$course->name?>"
            
        >
        <span id="msg-name" class="form__input-msg"></span>
    </div>

    <div class="form__input col-6">
        <label for="watchword"> Lema (requerido)</label>
        <input 
            type="text"
            name="watchword"
            id="watchword"
            class="field"
            placeholder="Frase llamativa del curso que aparecera debajo del nombre del curso"
            value="<?=$course->watchword?>"
        >
        <span id="msg-watchword" class="form__input-msg"></span>
    </div>
</div>

<div class="grid-elements border">

    <div class="form__input col-6">
        <label for="max_months_enroll">Acceso a material (meses)</label>
        <div class="icon-left">
            <i class='bx bx-calendar-check'></i>
            <input 
                type="text"
                name="max_months_enroll"
                id="max_months_enroll"
                class="field"
                placeholder="Meses para ver el material"
                value="<?=$course->max_months_enroll?>"
            >
        </div>    
        <span id="msg-max_months_enroll" class="form__input-msg"></span>
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
                value="<?=$course->price?>"
            >
        </div>    
        <span id="msg-price" class="form__input-msg"></span>
    </div>
    

</div>

<div class="grid-elements border">

    <div class="form__input col-4">
        <label for="discount">Descuento</label>
        <div class="icon-right">
            <input 
                type="text"
                name="discount"
                id="discount"
                class="field"
                placeholder="procentaje de descuento del curso (opcional)"
                value="<?=$course->discount??''?>"
            >
            <i>%</i>
        </div>
        <span id="msg-discount" class="form__input-msg"></span>
    </div>

    <div class="form__input col-4">
        <label for="discount_ends_date">Fin de promocion</label>
            <input 
                type="date"
                name="discount_ends_date"
                id="discount_ends_date"
                class="field"
                min = <?=date('Y-m-d')?>
                value="<?=$course->discount_ends_date?>"
            >                
            <span id="msg-discount_ends_date" class="form__input-msg"></span>
    </div>

    <div class="form__input col-4">
        <label for="discount_ends_time">Hora de fin de promocion</label>
            <input 
                type="time"
                name="discount_ends_time"
                id="discount_ends_time"
                class="field"
                value="<?=$course->discount_ends_time?>"
            >                
            <span id="msg-discount_ends_time" class="form__input-msg"></span>
    </div>

</div>

<div class="grid-elements border">
    
    <div class="form__input col-6">
        <label for="id_teacher">Maestro(obligatorio)</label>
            <select name="id_teacher" id="id_teacher" class="field" >
                <option value="" disabled selected>Seleccionar maestro</option>
                <?php include_once __DIR__.'/../../components/teacherCB.php' ?>
            </select>
            <span id="msg-id_teacher" class="form__input-msg"></span>
    </div>

    <div class="form__input col-6">
        <label for="id_category">Categoría(obligatorio)</label>
            <select name="id_category" id="id_category" class="field" >
                <option value="" disabled selected>Seleccionar</option>
                <?php include_once __DIR__.'/../../components/categoriesCB.php' ?>
            </select>
            <span id="msg-id_category" class="form__input-msg"></span>
    </div>
</div>

<div class="grid-elements border">
    <div class="form__input col-12">
        <label for="description">Descripción (minimo 80 caracteres)</label>
        <textarea 
            name="description" 
            id="description"
            class="text-area"
            placeholder="Descripción detallada del curso, que se aprendera y que puede hacer despues de tomar este curso"
            
        ><?=$course->description?></textarea>
        <span id="msg-description" class="form__input-msg"></span>
    </div>
</div>


