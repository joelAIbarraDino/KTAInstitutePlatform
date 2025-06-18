<?php

namespace App\Controllers;

use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\FAQ;
use Exception;

class FaqController{

    public static function create(int $id){
        if(!Request::isPOST())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);
        
        try {
            $faq = new FAQ;

            //sincronizamos datos enviados por js para nuevo modulo
            $dataPost = Request::getPostData();
            $faq->sincronize($dataPost);

            //validamos entrada de datos
            $faq->validateAPI();

            //registramos modulo y devolvemos ID
            $id = $faq->save();

            if(!$id)
                Response::json(['ok'=>false,'message'=>'Error al registrar el FAQ, intente mas tarde'], 404);

            Response::json([
                'ok'=>true,
                'id'=>$id,
                'message'=>'FAQ registrado con exito'
            ]);                  
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()], 400);
        }
    }

    public static function updateQuestion(int $id){
        if(!Request::isPATCH())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $faq = FAQ::find($id);
            $dataSend = Request::getBody();
            $faq->question = $dataSend['question'];

            $faq->validateAPI();

            //guardamos los cambios
            $rowAffected = $faq->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar la pregunta, intente mas tarde'], 404);

            Response::json(['ok'=>true,'message'=>'Pregunta actualizada con exito']);
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()], 400);
        }    
    }

    public static function updateAnswer(int $id){
        if(!Request::isPATCH())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $module = FAQ::find($id);
            $dataSend = Request::getBody();

            $module->answer = $dataSend['answer'];

            $module->validateAPI();

            //guardamos los cambios
            $rowAffected = $module->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar la respuesta de la pregunta, intente mas tarde'], 404);

            Response::json(['ok'=>true,'message'=>'Respuesta actualizada con exito']);
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()], 400);
        }
    }

    public static function delete(int $id){
        if(!Request::isDELETE())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            //busco el modulo que quiero eliminar
            $faq = FAQ::find($id);

            //elimino el modulo
            $rowAffected = $faq->delete();

            //en caso de que no se elimine cancelo el siguiente paso
            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al eliminar la FAQ, intente mas tarde'], 404);

            //regreso respuesta para ver que me regresa el querySQL
            Response::json(['ok'=>true,'message'=>"FAQ eliminada con exito"]);
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()], 400);
        }
    }

}