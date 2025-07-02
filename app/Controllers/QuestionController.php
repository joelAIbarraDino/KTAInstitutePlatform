<?php

namespace App\Controllers;

use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

use App\Models\Question;
use Exception;

class QuestionController{

    public static function create(int $id){
        if(!Request::isPOST())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);
        
        try {
            $question = new Question;

            //sincronizamos datos enviados por js para nuevo modulo
            $dataPost = Request::getPostData();
            $question->sincronize($dataPost);

            //validamos entrada de datos
            $question->validateAPI();

            //registramos modulo y devolvemos ID
            $id = $question->save();

            if(!$id)
                Response::json(['ok'=>false,'message'=>'Error al registrar la pregunta, intente mas tarde']);

            Response::json([
                'ok'=>true,
                'id'=>$id,
                'message'=>'Pregunta registrada con exito'
            ]);                  
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function updateQuestion(int $id){
        if(!Request::isPATCH())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $question = Question::find($id);
            $dataSend = Request::getBody();
            $question->question = $dataSend['question'];

            $question->validateAPI();

            //guardamos los cambios
            $rowAffected = $question->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar el nombre, intente mas tarde'], 404);

            
            Response::json(['ok'=>true,'message'=>'Nombre actualizado con exito']);
            
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()], 400);
        }    
    }

    public static function updateTypeQuestion(int $id){
        if(!Request::isPATCH())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $question = Question::find($id);
            $dataSend = Request::getBody();
            $question->type_question = $dataSend['type_question'];

            $question->validateAPI();

            //guardamos los cambios
            $rowAffected = $question->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar el tipo de pregunta, intente mas tarde'], 404);
            
            Response::json(['ok'=>true,'message'=>'Tipo de pregunta actualizado con exito']);
            
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()], 400);
        }    
    }

    public static function delete(int $id){
        if(!Request::isDELETE())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            //busco el modulo que quiero eliminar
            $question = Question::find($id);

            $rowAffected = $question->delete();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al eliminar la pregunta, intente mas tarde'], 404);

            //regreso respuesta para ver que me regresa el querySQL
            Response::json(['ok'=>true,'message'=>'Pregunta eliminada con exito']);
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

}