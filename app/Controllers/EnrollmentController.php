<?php

namespace App\Controllers;

use DinoEngine\Http\Request;
use DinoEngine\Http\Response;

use App\Models\OptionQuestion;
use App\Models\AnswerStudent;
use App\Models\Enrollment;
use App\Models\Material;
use App\Models\Question;
use App\Models\Attempt;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Course;

use Ramsey\Uuid\Uuid;
use App\Models\Quiz;
use DinoEngine\Helpers\Helpers;
use Exception;

class EnrollmentController{

    public static function index(string $uuid):void{
    
        Response::render('/student/aula/virtualAula', [
            'nameApp'=>APP_NAME,
            'title'=>'Curso'
        ]);
    }

    public static function attempts(string $uuid):void{
        
        $enroll = Enrollment::where('url', '=', $uuid);
        $idEnroll = $enroll->id_enrollment;
        
        $attempts  = Attempt::belongsTo('id_enrollment', $idEnroll)??[];
        $quiz = Quiz::where('id_course', '=', $enroll->id_course);

        Response::render('/student/aula/attempts', [
            'nameApp'=>APP_NAME,
            'title'=>'Intentos de examen',
            'attempts'=>$attempts,
            'quiz'=>$quiz,
            'url'=>$uuid
        ]);
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
            $attempt->id_quizz = $quiz->id_quiz;
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

    public static function getStudentContent(string $uuid):void{
        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        $enroll = Enrollment::where('url', '=', $uuid);

        $id = $enroll->id_course;

        try {
            $modules = Module::belongsTo('id_course', $id, "order_module", 'ASC')??[];
            $quiz = Quiz::where('id_course', '=', $id);
            $modulesLessons = [];
            $lessonsMaterial = [];
            $arrayLessons = [];

            foreach($modules as $module){
                
                $lessons = Lesson::belongsTo('id_module', $module->id_module, "order_lesson", 'ASC')??[];

                foreach($lessons as $lesson){
                    
                    $material = Material::belongsTo('id_lesson', $lesson->id_lesson)??[];
                    
                    $lessonsMaterial[] = [
                        'id_lesson'=>$lesson->id_lesson,
                        'name'=>$lesson->name,
                        'description'=>$lesson->description,
                        'id_video'=>$lesson->id_video,
                        'order_lesson'=>$lesson->order_lesson,
                        'id_module'=>$lesson->id_module,
                        'material'=>$material
                    ];
                    $arrayLessons[] = $lesson;
                }

                $modulesLessons[] = [
                    'id_module'=>$module->id_module,
                    'name'=>$module->name,
                    'order_module'=>$module->order_module,
                    'id_course'=>$module->id_course,
                    'lessons'=>$lessonsMaterial
                ];
                
                $lessonsMaterial = [];
            }

            Response::json([
                'modules'=>$modulesLessons,
                'lessons'=>$arrayLessons,
                'quiz'=>$quiz
                
            ]);      
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function createEnrollment(string $id){
        if(!isset($_SESSION))
            session_start();
        
        
        $course = Course::where('url', '=', $id);

        $newEnrollment = new Enrollment;


        $newEnrollment->url = Uuid::uuid4();
        $newEnrollment->id_course = $course->id_course;
        $newEnrollment->id_student = $_SESSION['student']['id_student'];
        $newEnrollment->id_payment = null;

        $rows = $newEnrollment->save();

        if($rows){
            Response::redirect('/curso/watch/'.$newEnrollment->url);
        }
    }

    public static function responseQuiz(string $uuid, int $id):void{

        Response::render('/student/aula/quizAnswer', [
            'nameApp'=>APP_NAME,
            'title'=>'Examen'
        ]);
    }

    public static function getQuiz(int $id):void{
                if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $attempt = Attempt::where('id_attempt', '=', $id);
            $quiz = Quiz::where('id_quiz', '=', $attempt->id_quizz)??[];

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
            $quiz = Quiz::where('id_quiz', '=', $attempt->id_quizz);
            $questions = Question::belongsTo('id_quiz', $quiz->id_quiz)??[];
            $answersStudent = $postData['answers'];

            //datos para actualizar en attempt
            $tiempoUsadoSeg = $postData['timeUsed']??0;
            $maxPoints = count($questions);
            $finalScore = 0;
            $isApproved = 0;
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

                }else{
                    $newAnswerStudent = new AnswerStudent;

                    $newAnswerStudent->id_attempt =$attempt->id_attempt;
                    $newAnswerStudent->type_question = $question->type_question;
                    $newAnswerStudent->question = $question->question;
                    $newAnswerStudent->answer = 'Pregunta no responida';
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
                'message' => 'Respuestas guardadas'
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
}