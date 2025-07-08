<?php

namespace App\Controllers;

use App\Classes\CertificadoPDF;

use App\Models\AnswerStudent;
use App\Models\Attempt;
use App\Models\Enrollment;
use App\Models\OptionQuestion;
use App\Models\Question;
use App\Models\Quiz;
use DinoEngine\Helpers\Helpers;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use Exception;

class AttemptController{

    public static function responseQuiz(string $uuid, int $id):void{

        Response::render('/student/quiz/answer', [
            'nameApp'=>APP_NAME,
            'title'=>'Examen'
        ]);
    }

    public static function successQuiz(int $id):void{
        if(!isset($_SESSION))
            session_start();

        $attempt = Attempt::find($id);
        
        if(!$attempt)
            Response::redirect('/');
        
        if(!$attempt->is_approved)
            Response::redirect('/');

        $enrollment = Enrollment::where('id_enrollment', '=', $attempt->id_enrollment);
        
        if($enrollment->id_student != $_SESSION['student']['id_student'])
            Response::redirect('/');

        Response::render('/student/quiz/success', [
            'nameApp'=>APP_NAME,
            'title'=>'Resultados de examen',
            'id'=>$id
        ]);
    }

    public static function showDiploma(int $id):void{
        if(!isset($_SESSION))
            session_start();

        $attempt = Attempt::find($id);
        
        if(!$attempt)
            Response::redirect('/');
        
        if(!$attempt->is_approved)
            Response::redirect('/');

        $enrollment = Enrollment::where('id_enrollment', '=', $attempt->id_enrollment);

        if($enrollment->id_student != $_SESSION['student']['id_student'])
            Response::redirect('/');
        $attempt = Attempt::where('id_attempt', '=', $id);

        $logo = __DIR__."/../../public/assets/images/logoKTA.png";
        $fondo = __DIR__."/../../public/assets/images/backgroundCertificado.jpg";
        $certificado = new CertificadoPDF($_SESSION['student']['nombre'], $attempt->score, date('Y-m-d'), $logo, $fondo);

        $certificado->mostrar('certificado de '.$_SESSION['student']['nombre']);
    }

    public static function failedQuiz():void{

        Response::render('/student/quiz/error', [
            'nameApp'=>APP_NAME,
            'title'=>'Resultados de examen'
        ]);
    }

    public static function completedQuiz():void{
        Response::render('/student/quiz/completed', [
            'nameApp'=>APP_NAME,
            'title'=>'Resultados de examen'
        ]);
    }

    public static function getQuiz(int $id):void{
                if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $attempt = Attempt::where('id_attempt', '=', $id);
            $quiz = Quiz::where('id_quiz', '=', $attempt->id_quiz)??[];

            //si no tengo registrado
            if(!$quiz){
                Response::json([
                    'quiz'=>[],
                    'questions'=>[]
                ]);
            }

            $questionAnswers = [];
            $questions = [];
            $answers = [];
            $finalAnswers = [];
            //obtenemos las preguntas del quiz
            $questions = Question::belongsTo('id_quiz', $quiz->id_quiz)??[];

            foreach($questions as $question){

                //obtenemos las respuestas de la pregunta
                $answers = OptionQuestion::belongsTo('id_question', $question->id_question)??[];

                //elimino el atributo de si es correcto o no la respuesta
                foreach($answers as $answer){
                    $finalAnswers[] = [
                        'id_option'=>$answer->id_option,
                        'text_option'=>$answer->text_option,
                        'id_question'=>$answer->id_question
                    ];
                    
                }

                $questionAnswers[] = [
                    'id_question'=>$question->id_question,
                    'question'=>$question->question,
                    'type_question'=>$question->type_question,
                    'id_quiz'=>$question->id_quiz,
                    'answers'=>$finalAnswers
                ];

                $answers = [];
                $finalAnswers = [];
            }

            Response::json([
                'quiz'=>$quiz,
                'questions'=>$questionAnswers
            ]);
 
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function saveAnswerStudent(int $id):void{

        try{
            //datos recibidos y consulta de registros necesarios
            $attempt = Attempt::find($id);
            $postData = Request::getBody();
            
            //consulta para obtener quiz para evaluar si la respuesta es correcta o no
            $quiz = Quiz::where('id_quiz', '=', $attempt->id_quiz);
            $questions = Question::belongsTo('id_quiz', $quiz->id_quiz)??[];
            $answersStudent = $postData['answers'];

            //datos para actualizar en attempt
            $tiempoUsadoSeg = $postData['timeUsed']??0;
            $maxPoints = count($questions);
            $finalScore = 0;
            $isApproved = 0;
            $withOpenQuestions = false;
            $score = 0;

            foreach($questions as $question){
                
                $answerStudent = $answersStudent[$question->id_question]??null;

                if($answerStudent && $question->type_question == "multiple"){
                    
                    $respuestaSeleccionada = OptionQuestion::where('id_option', '=', $answerStudent[0]);
                    if($respuestaSeleccionada->is_correct) $score++;

                    $newAnswerStudent = new AnswerStudent;

                    $newAnswerStudent->id_attempt =$attempt->id_attempt;
                    $newAnswerStudent->type_question = $question->type_question;
                    $newAnswerStudent->question = $question->question;
                    $newAnswerStudent->answer = $respuestaSeleccionada->text_option;
                    $newAnswerStudent->is_correct = $respuestaSeleccionada->is_correct;

                    $newAnswerStudent->save();

                }elseif($answerStudent && $question->type_question == "abierta"){

                    $newAnswerStudent = new AnswerStudent;

                    $newAnswerStudent->id_attempt =$attempt->id_attempt;
                    $newAnswerStudent->type_question = $question->type_question;
                    $newAnswerStudent->question = $question->question;
                    $newAnswerStudent->answer = $answerStudent['text'];
                    $newAnswerStudent->is_correct = 0;

                    $newAnswerStudent->save();
                    $withOpenQuestions = true;

                }else{
                    $newAnswerStudent = new AnswerStudent;

                    $newAnswerStudent->id_attempt =$attempt->id_attempt;
                    $newAnswerStudent->type_question = $question->type_question;
                    $newAnswerStudent->question = $question->question;
                    $newAnswerStudent->answer = null;
                    $newAnswerStudent->is_correct = 0;

                    $newAnswerStudent->save();
                }
            }

            $finalScore = ($score / $maxPoints) * 100;
            $isApproved = $finalScore >= $quiz->min_score?1:0;

            //actualizacion de intento y resultados de examen
            $attempt->time = $tiempoUsadoSeg / 60;
            $attempt->score = $finalScore;
            $attempt->is_approved = $isApproved;


            $attempt->save();
           
            Response::json([
                'ok' => true,
                'message' => 'Respuestas guardadas',
                'approved' => $isApproved?true:false,
                'openQuestions' => $withOpenQuestions
            ]);

        }catch(Exception $e){
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }

    }

    public static function createAttempt(string $uuid):void{
        if(!Request::isPOST())
            Response::json(['ok'=>true,'message'=>"Método no soportado"], 404);
        
        try{
            $enroll = Enrollment::where('url', '=', $uuid);
            $quiz = Quiz::where('id_course', '=', $enroll->id_course);
            $attempts = Attempt::belongsTo('id_enrollment', $enroll->id_enrollment)??[];

            if(count($attempts) == $quiz->max_attempts)
                Response::json(['ok'=>false,'message'=>'Ya no tiene mas intentos para realizar el quiz']);

            $attempt = new Attempt;

            $attempt->id_enrollment = $enroll->id_enrollment;
            $attempt->id_quiz = $quiz->id_quiz;
            $attempt->time = 0;
            $attempt->is_approved = 0;

            $attempt->validateAPI();

            $id = $attempt->save();

            if(!$id)
                Response::json(['ok'=>false,'message'=>'Error al crear intento, intente mas tarde']);

            Response::json([
                'ok'=>true,
                'id'=>$id,
                'message'=>'Intento creado con exito'
            ]);

        }catch(Exception $e){
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function cancelAttempt(int $id):void{
        
        if(!Request::isDELETE())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try{
            $attempt = Attempt::find($id);

            $rowAffected = $attempt->delete();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al cancelar intento'], 404);


        }catch(Exception $e){
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

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
