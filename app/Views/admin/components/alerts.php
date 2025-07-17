<?php
    foreach($alerts as $key=>$mensajes):
        foreach($mensajes as $mensaje):
?>
            <div class="alert <?=$key?>"><?=$mensaje?></div>
<?php 
        endforeach;
    endforeach;
?>