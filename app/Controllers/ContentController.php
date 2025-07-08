<?php

namespace App\Controllers;

use App\Models\AnswerStudent;
use App\Models\Attempt;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

use App\Models\OptionQuestion;
use App\Models\Question;
use App\Models\Material;
use App\Models\Course;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\Quiz;
use App\Models\FAQ;
use Exception;

class ContentController{

    public static function testVimeo(){
        $videoId = '1067268542';
        $accessToken = $_ENV['TOKEN_ACCESS_VIMEO'];

        $ch = curl_init();
        $url = "https://api.vimeo.com/videos/{$videoId}";

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$accessToken}",
                "Accept: application/vnd.vimeo.*+json;version=3.4"
            ]
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if(curl_errno($ch))
            Response::json([
                'success' => false,
                'error' => curl_error($ch),
                'code' => $httpCode
            ]);
        
        $exists = false;
        $owned = false;

        switch ($httpCode) {
            case 200:
                $exists = true;
                $owned = true;
                $data = json_decode($response, true);
                break;

            case 403:
                $exists = true;
                $owned = false;
                $data = null;
                break;

            case 404:
                $exists = false;
                $owned = false;
                $data = null;
                break;

            default:
                $data = json_decode($response, true);
                break;
        }

        Response::json([
            'success' => $httpCode === 200,
            'exists' => $exists,
            'owned_by_account' => $owned,
            'code' => $httpCode,
            'data' => $data
        ]);
    
    }

    public static function content(int $id):void{

        $course = Course::find($id);

        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        Response::render('/admin/contenido-curso/course-content', [
            'nameApp'=> APP_NAME,
            'title'=>'Contenido de curso',
            'course'=>$course
        ]);
    }

    public static function getContent(int $id):void{
        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $modules = Module::belongsTo('id_course', $id, "order_module", 'ASC')??[];
            $modulesLessons = [];
            $lessonsMaterial = [];

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
            ]);      
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function faq(int $id):void{

        $course = Course::find($id);

        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        Response::render('/admin/contenido-curso/faq', [
            'nameApp'=> APP_NAME,
            'title'=>'Preguntas frecuentes',
            'course'=>$course
        ]);
    }

    public static function getFAQ(int $id):void{
        if(!Request::isGET())
            Response::json(['ok'=>false,'message'=>"Método no soportado"]);

        try {
            $faq = FAQ::belongsTo('id_course', $id)??[];
            
            Response::json([
                'faq'=>$faq
            ]);      
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function quiz(int $id):void{
        $course = Course::find($id);

        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        Response::render('/admin/contenido-curso/quiz', [
            'nameApp'=> APP_NAME,
            'title'=>'Examen de curso',
            'course'=>$course
        ]);
    }

    public static function getQuiz(int $id):void{
        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
             
            $quiz = Quiz::where('id_course', '=', $id)??[];

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
    
            //obtenemos las preguntas del quiz
            $questions = Question::belongsTo('id_quiz', $quiz->id_quiz)??[];

            foreach($questions as $question){

                //obtenemos las respuestas de la pregunta
                $answers = OptionQuestion::belongsTo('id_question', $question->id_question)??[];

                $questionAnswers[] = [
                    'id_question'=>$question->id_question,
                    'question'=>$question->question,
                    'type_question'=>$question->type_question,
                    'id_quiz'=>$question->id_quiz,
                    'answers'=>$answers
                ];

                $answers = [];
            }

            Response::json([
                'quiz'=>$quiz,
                'questions'=>$questionAnswers
            ]);
 
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function attempts(int $id):void{
        $course = Course::find($id);

        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        Response::render('/admin/contenido-curso/attempts-quiz', [
            'nameApp'=> APP_NAME,
            'title'=>'Intentos del curso',
            'course'=>$course
        ]);
    }

    public static function getAttempts(int $id):void{
        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try{

            $quiz = Quiz::where('id_course', '=', $id)??[];

            //si no tengo un quiz registrado
            if(!$quiz){
                Response::json([
                    'attempts'=>[]
                ]);
            }

            $attempts = Attempt::belongsTo('id_quiz', $quiz->id_quiz)??[];

            if(!$attempts){
                Response::json([
                    'attempts'=>[]
                ]);
            }

            $finalAttempts = [];

            foreach($attempts as $attempt){
                $answers = AnswerStudent::belongsTo('id_attempt', $attempt->id_attempt)??[];

                $finalAttempts[] =[
                    'id_attempt'=>$attempt->id_attempt,
                    'time'=>$attempt->time,
                    'score'=>$attempt->score,
                    'min_score'=>$quiz->min_score,
                    'is_approved'=>$attempt->is_approved,
                    'answersStudent'=>$answers
                ];
            }

            Response::json([
                'attempts'=>$finalAttempts
            ]);

        }catch(Exception $e){
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

}