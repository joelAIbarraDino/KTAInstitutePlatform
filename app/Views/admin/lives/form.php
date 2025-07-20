<div class="grid-elements border">
        
    <div class="form__file col-6">
        <label for="background"> Fondo del curso en vivo (requerido)</label>
        <input 
            type="file"
            name="background"
            id="background"
            accept="image/*"
            hidden
            class="real-btn-file"
        >
        <button type="button" class="form__file-btn  btn-file">Seleccionar el fondo del curso en vivo</button>
    </div>

    <div class="form__file col-6">
        <label for="thumbnail"> Caratula de curso en vivo (requerido)</label>
        <input 
            type="file"
            name="thumbnail"
            id="thumbnail"
            accept="image/*"
            hidden
            class="real-btn-file-2"
        >
        <button type="button" class="form__file-btn  btn-file-2">Seleccionar caratula de curso en vivo</button>
    </div>

</div>

<div class="grid-elements border">

    <div class="form__input col-12">
        <label for="name"> Nombre (requerido)</label>
        <input 
            type="text"
            name="name"
            id="name"
            class="field"
            placeholder="Nombre del live"
            value="<?=$live->name?>"
            
        >
    </div>

</div>

<div class="grid-elements border">

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
                value="<?=$live->price?>"
            >
        </div>    
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
                placeholder="procentaje de descuento del live (opcional)"
                value="<?=$live->discount??''?>"
            >
            <i>%</i>
        </div>
    </div>

    <div class="form__input col-4">
        <label for="discount_ends_date">Fin de promocion</label>
            <input 
                type="date"
                name="discount_ends_date"
                id="discount_ends_date"
                class="field"
                min = <?=date('Y-m-d')?>
                value="<?=$live->discount_ends_date?>"
            >
    </div>

    <div class="form__input col-4">
        <label for="discount_ends_time">Hora de fin de promocion</label>
            <input 
                type="time"
                name="discount_ends_time"
                id="discount_ends_time"
                class="field"
                value="<?=$live->discount_ends_time?>"
            >
    </div>

</div>

<div class="grid-elements border">
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
        <label for="description">Descripción corta (minimo 80 caracteres)</label>
        <textarea 
            name="description" 
            id="description"
            class="text-area"
            placeholder="Descripción corta del curso en vivo, que se aprendera y que puede hacer despues de tomar este curso"
            
        ><?=$live->description?></textarea>
        <span id="msg-description" class="form__input-msg"></span>
    </div>
</div>

<div class="grid-elements border">
    <div class="form__input col-12">
        <label for="description">Caracteristicas del curso en vivo</label>
        
        <div id="editor" style="height: 40rem;"></div>
        <input type="hidden" id="input-editor" name="details" value="<?= htmlspecialchars($live->details, ENT_QUOTES) ?>">
        
    </div>
</div>

<div class="submit-left mb-2">
    <button id="add-schedule" class="submit" type="button"> <i class='bx bx-calendar-plus'></i> Agregar día de live</button>
</div>

<div class="grid-elements border" id="fechas">

    <?php if(empty($fechas)):?>
        <div class="form__input col-12">
            <label for="discount_ends_date">Fecha y hora del evento</label>
                <input 
                    type="datetime-local"
                    name="schedules[]"
                    class="field"
                    min = <?=date('Y-m-d')?>
                >
        </div>
    <?php else:?>
        <?php foreach($fechas as $fecha):?>
            <div class="form__input col-12">
                <label for="discount_ends_date">Fecha y hora del evento</label>
                    <input 
                        type="datetime-local"
                        name="schedules[]"
                        class="field"
                        min = <?=date('Y-m-d')?>
                        value ="<?=$fecha?>"
                    >
            </div>
        <?php endforeach;?>
    <?php endif;?>

    
</div>
