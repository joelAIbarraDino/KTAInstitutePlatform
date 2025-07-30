<?php

namespace App\Controllers;

use App\Models\Material;
use DinoEngine\Http\Request;
use DinoEngine\Http\Response;
use Exception;

class MaterialController{

    public static function create():void{
        if(!Request::isPOST())
            Response::json(['ok'=>true,'message'=>"Método no soportado"], 404);

        try{
            $material = new Material;
            $material->type = "file";

            $dataPost = Request::getPostData();
            $file = $_FILES['file'];

            $material->sincronize($dataPost);
            $material->validateAPI();
            $material->validateFile($_FILES);

            $material->uploadFile($file);
            $id = $material->save();

            if(!$id)
                Response::json(['ok'=>false,'message'=>'Error al registrar el material, intente mas tarde']);

            Response::json([
                'ok'=>true,
                'id'=>$id,
                'url_file'=>$material->url_file,
                'message'=>'Material registrado con exito'
            ]);

        }catch(Exception $e){
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function delete($id):void{
        
        if(Request::isDELETE()){
            try {
                $course = Material::find($id);

                if(!$course)
                    Response::json(['ok'=>false]);

                //guardo el nombre de la imagen antes de eliminar del DB
                $file = $course->url_file;
                $rows = $course->delete();

                if($rows == 0)
                    Response::json(['ok'=>false]);

                //se elimina la foto del servidor
                unlink(DIR_MATERIAL.'/'.$file);

                Response::json(['ok'=>true]);
            } catch (Exception) {
                Response::json(['ok'=>false]);
            }

        }
    }

}