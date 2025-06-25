<?php

namespace App\Classes;

class Helpers{

    static function saludo():string{
        $mensaje = null;
        $hora = date('G');
        
        if($hora >= 0 && $hora < 12)
            $mensaje = "Buenos dias";
        elseif($hora >=12 && $hora < 18)
            $mensaje = "Buenas tardes";
        elseif($hora >= 18 && $hora <= 23)
            $mensaje = "Buenas noches";

        return $mensaje;
    }

    static function setSwalAlert($icon, $title, $text, $timer = null) {
        if(!isset($_SESSION)) {
            session_start();
        }

        $_SESSION['swal'] = [
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
            'timer' => $timer
        ];
    }
    
    static function showSwalAlert() {
        if(!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION['swal'])) {
            echo '
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            ';
            echo "<script>
                Swal.fire({
                    icon: '{$_SESSION['swal']['icon']}',
                    title: '{$_SESSION['swal']['title']}',
                    text: '{$_SESSION['swal']['text']}',
                    ".($_SESSION['swal']['timer'] ? "timer: {$_SESSION['swal']['timer']}, showConfirmButton: false" : "")."
                });
            </script>";
            unset($_SESSION['swal']);
        }
    }

    static function obtenerIniciales($cadena):string {
    // Eliminar espacios en blanco adicionales
    $cadena = trim($cadena);
    
    // Separar la cadena en palabras
    $palabras = explode(' ', $cadena);
    
    // Verificar que haya al menos dos palabras
    if (count($palabras) < 2) {
        $iniciales = strtoupper($palabras[0][0] . '');
        return $iniciales;
    }
    
    // Obtener las iniciales de las dos primeras palabras
    $iniciales = strtoupper($palabras[0][0]) . strtoupper($palabras[1][0]);
    
    return $iniciales;
}
}