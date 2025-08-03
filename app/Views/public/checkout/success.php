<?php

use App\Classes\Helpers;

 include_once __DIR__.'/../../components/header.php';?>

<main>
    <?php if($type_product == "course"):?>
        <div class="mensaje-compra-exitosa">    
            <h2 class="titulo">¡Gracias por tu compra, <?= Helpers::getFirstName($name) ?>!</h2>
            <p class="detalle">
                Has adquirido el curso: <span><?= $product->name ?></span>
            </p>
            <p class="detalle">
                Cuenta asociada al correo: <span><?= $email ?></span>
            </p>
        
            <div class="acciones">
                <a href="/login" class="boton">Ver mis compras</a>
                <a href="/" class="boton secundario">Volver al inicio</a>
            </div>
        </div>
    <?php elseif($type_product == "membership"):?>
        <div class="mensaje-compra-exitosa">    
            <h2 class="titulo">¡Gracias por tu compra, <?= Helpers::getFirstName($name) ?>!</h2>
            <p class="detalle">
                Has adquirido una membresia: <span><?= $product->type ?></span>
            </p>
            <p class="detalle">
                Cuenta asociada al correo: <span><?= $email ?></span>
            </p>
        
            <div class="acciones">
                <a href="/login" class="boton">Ver mis compras</a>
                <a href="/" class="boton secundario">Volver al inicio</a>
            </div>
        </div>
    <?php elseif($type_product == "live"):?>
        <div class="mensaje-compra-exitosa">    
            <h2 class="titulo">¡Gracias por tu compra, <?= Helpers::getFirstName($name) ?>!</h2>
            <p class="detalle">
                Has adquirido un acceso al live: <span><?= $product->name ?></span>
            </p>
            <p class="detalle">
                Cuenta asociada al correo: <span><?= $email ?></span>
            </p>
        
            <div class="acciones">
                <a href="/login" class="boton">Ver mis compras</a>
                <a href="/" class="boton secundario">Volver al inicio</a>
            </div>
        </div>
    <?php endif;?>

</main>

<?php include_once __DIR__.'/../../components/footer.php';?>

<?php 
    $scripts ='
        <script src="/assets/js/header.js"></script>
    ';
?>