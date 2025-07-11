<?php if(count($courses)> 0):?>
    
    <div class="kiosko" id="main-content">
        <h2 class="kiosko__titulo">Ultimos Cursos</h2>

        <div class="kiosko__content">
            
            <div class="kiosko__contenedor">

                <?php foreach($courses as $course):?>

                    <?php if($course->privacy == 'Público'):?>
                        <?php include __DIR__.'/courseCard.php';?>
                    <?php endif;?>
                <?php endforeach;?>
                
            </div>
            
            <div class="kiosko__controles">
                <button class="kiosko__boton kiosko__boton--anterior"><i class='bx bx-chevrons-left' ></i></button>
                <button class="kiosko__boton kiosko__boton--siguiente"><i class='bx bx-chevrons-right'></i></button>
            </div>
            
            <div class="kiosko__puntos"></div>
        </div>
    </div>

<?php else:?>

    <div class="kiosko empty" id="main-content">
        <h2 class="kiosko__titulo empty">Proximamente</h2>

        <p class="kiosko__title empty">Nuevos cursos para tí </p>
    </div>

<?php endif;?>