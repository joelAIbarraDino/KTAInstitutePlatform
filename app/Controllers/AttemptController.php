<?php

namespace App\Controllers;

use App\Models\Attempt;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use Exception;

class AttemptController{

    public static function delete(int $id):void{
        if(!Request::isDELETE())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            //busco el modulo que quiero eliminar
            $attempt = Attempt::find($id);

            //elimino el modulo
            $rowAffected = $attempt->delete();

            //en caso de que no se elimine cancelo el siguiente paso
            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al eliminar el intento, intente mas tarde'], 404);

            //regreso respuesta para ver que me regresa el querySQL
            Response::json(['ok'=>true,'message'=>"Intento eliminado con exito"]);
            
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

}
