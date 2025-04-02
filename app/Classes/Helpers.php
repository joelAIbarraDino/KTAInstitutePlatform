<?php

namespace App\Classes;

use DinoEngine\Helpers\Helpers as HelpersHelpers;

class Helpers{

    static function saludo():string{
        $mensaje = null;
        $hora = date('G');
        
        if($hora > 0 && $hora < 12)
            $mensaje = "Buenos dias";
        elseif($hora >=12 && $hora < 18)
            $mensaje = "Buenas tardes";
        elseif($hora >= 18 && $hora <= 23)
            $mensaje = "Buenas noches";

        return $mensaje;
    }
}