<?php

namespace App\Controllers;

use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

use App\Models\AnswerStudent;
use App\Models\Attempt;
use App\Models\Quiz;
use Exception;

class AnswerStudentController{

    public static function updateCorrectAnswer(int $id){
        if(!Request::isPATCH())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $dataSend = Request::getBody();

            $answerStudent = AnswerStudent::find($id);
            $attempt = Attempt::find($answerStudent->id_attempt);
            $quiz = Quiz::where('id_quiz', '=', $attempt->id_quiz);
            $answerStudent->is_correct = $dataSend['is_correct'];

            //guardamos los cambios
            $rowAffected = $answerStudent->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar la calificación de la respuesta, intente mas tarde'], 404);
            
            $answersStudent = AnswerStudent::belongsTo('id_attempt', $attempt->id_attempt);

            $maxPoints = count($answersStudent);
            $finalScore = 0;
            $isApproved = 0;
            $score = 0;

            foreach($answersStudent as $answerMemoryStudent)
                if($answerMemoryStudent->is_correct) $score++;
            
            $finalScore = ($score / $maxPoints) * 100;
            $isApproved = $finalScore >= $quiz->min_score?1:0;

            //actualizacion de intento y resultados de examen
            $attempt->score = $finalScore;
            $attempt->is_approved = $isApproved;

            $attempt->save();

            Response::json(['ok'=>true,'message'=>'Respuesta actualizada con exito']);
            
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()], 400);
        }    
    }

}