<?php

namespace App\Controllers;

use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

use App\Models\OptionQuestion;
use App\Models\Question;
use Exception;

class OptionQuestionController{

    public static function create(int $id){
        if(!Request::isPOST())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);
        
        try {
            $optionQuestion = new OptionQuestion;

            //sincronizamos datos enviados por js para nuevo modulo
            $dataPost = Request::getPostData();

            $optionQuestion->text_option = (string)$dataPost['text_option'];
            $optionQuestion->is_correct= $dataPost['is_correct'];
            $optionQuestion->id_question= $dataPost['id_question'];

            //obtenemos las respuestas registradas de la pregunta
            $answers = OptionQuestion::belongsTo('id_question', $dataPost['id_question'])??[];
            $question = Question::where('id_question', '=', $dataPost['id_question'])??[];

            if($question->type_question == "abierta")
                Response::json(['ok'=>false,'message'=>'El tipo de pregunta no permite opción multiple'], 400);

            if(count($answers) === 4)
                Response::json(['ok'=>false,'message'=>'Respuestas completas: solo se permiten 4 respuestas'], 400);

            //validamos entrada de datos
            $optionQuestion->validateAPI();

            //registramos modulo y devolvemos ID
            $id = $optionQuestion->save();

            if(!$id)
                Response::json(['ok'=>false,'message'=>'Error al registrar la pregunta, intente mas tarde']);

            Response::json([
                'ok'=>true,
                'id'=>$id,
                'message'=>'Respuesta registrada con exito'
            ]);                  
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function update(int $id){
        if(!Request::isPUT())
            Response::json(['ok'=>true,'message'=>"Método no soportado"], 404);

        try {
            $optionQuestion = OptionQuestion::find($id);
            $dataSend = Request::getBody();

            $optionQuestion->text_option = $dataSend['text_option'];
            $optionQuestion->is_correct = $dataSend['is_correct'];

            $optionQuestion->validateAPI();

            $rowAffected = $optionQuestion->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar la respuesta, intente mas tarde'], 404);

            if($optionQuestion->is_correct){
                //actualizo el orden en los siguientes pasos
                OptionQuestion::querySQL("UPDATE option_question set is_correct = 0 where id_question = :id_question AND id_option != :id_option", [
                    ':id_question'=>$optionQuestion->id_question,
                    ':id_option'=>$optionQuestion->id_option
                ]);
            }

            Response::json(['ok'=>true,'message'=>'Respuesta actualizada con exito']);
        } catch (Exception $e) {
            Response::json(['ok'=>false, 'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
        
    }

    public static function delete(int $id){
        if(!Request::isDELETE())
            Response::json(['ok'=>false,'message'=>"Método no soportado"]);

        try {
            $optionQuestion = OptionQuestion::find($id);

            $rowAffected = $optionQuestion->delete();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al eliminar la lección, intente mas tarde'], 404);

            Response::json(['ok'=>true,'message'=>'Respuesta eliminada con exito']);                  
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }
}