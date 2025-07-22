<?php

namespace App\Controllers;

use App\Models\Quiz;
use DinoEngine\Http\Request;
use DinoEngine\Http\Response;
use Exception;

class QuizController{

    static function create(int $id):void{
        if(!Request::isPOST())
            Response::json(['ok'=>true,'message'=>"Método no soportado"], 404);

        try {
            $quiz = new Quiz;
            
            //sincronizamos datos enviados por js para la nueva clase
            $dataPost = Request::getPostData();
            $quiz->sincronize($dataPost);

            //validamos entrada de datos
            $quiz->validateAPI();

            //registramos modulo y devolvemos ID
            $id = $quiz->save();

            if(!$id)
                Response::json(['ok'=>false,'message'=>'Error al registrar el quiz, intente mas tarde']);

            Response::json([
                'ok'=>true,
                'id'=>$id,
                'message'=>'Quiz registrado con exito'
            ]);
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    static function update(int $id):void{
        if(!Request::isPUT())
            Response::json(['ok'=>true,'message'=>"Método no soportado"], 404);

        try {
            $quiz = Quiz::find($id);
            $dataSend = Request::getBody();

            $quiz->name = $dataSend['name'];
            $quiz->min_score = $dataSend['min_score'];
            $quiz->tutorial_id = $dataSend['tutorial_id'];
            $quiz->quiz_mode = $dataSend['quiz_mode'];
            $quiz->show_answers = $dataSend['show_answers'];
            $quiz->random_questions = $dataSend['random_questions'];
            $quiz->max_time = $dataSend['max_time'];
            $quiz->max_attempts = $dataSend['max_attempts'];
            $quiz->id_course = $dataSend['id_course'];

            $quiz->validateAPI();

            $rowAffected = $quiz->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar el quiz, intente mas tarde'], 404);

            Response::json(['ok'=>true,'message'=>'Quiz actualizado con exito']);
        } catch (Exception $e) {
            Response::json(['ok'=>false, 'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

}