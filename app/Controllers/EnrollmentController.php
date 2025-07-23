<?php

namespace App\Controllers;

use DinoEngine\Http\Request;
use DinoEngine\Http\Response;

use App\Models\Enrollment;
use App\Models\Material;
use App\Models\Attempt;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Course;
use App\Models\ProgressEnrollment;
use Ramsey\Uuid\Uuid;
use App\Models\Quiz;
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
                    $progress = ProgressEnrollment::where('id_lesson', '=', $lesson->id_lesson)??[];
                    
                    $lessonsMaterial[] = [
                        'id_lesson'=>$lesson->id_lesson,
                        'name'=>$lesson->name,
                        'description'=>$lesson->description,
                        'id_video'=>$lesson->id_video,
                        'order_lesson'=>$lesson->order_lesson,
                        'id_module'=>$lesson->id_module,
                        'progress'=>$progress,
                        'material'=>$material,
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

    public static function newProgess(string $uuid):void{
        if(!isset($_SESSION))
            session_start();
        
        if(!Request::isPOST())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        $enroll = Enrollment::where('url', '=', $uuid);

        try{
            $progress = new ProgressEnrollment;

            $dataPost = Request::getPostData();
            $progress->completed = 1;
            $progress->id_enrollment = $enroll->id_enrollment;
            $progress->id_lesson = $dataPost['id_lesson'];

            $id = $progress->save();

            if(!$id)
                Response::json(['ok'=>false,'message'=>'Error al guardar el progreso, intente mas tarde']);

            Response::json([
                'ok'=>true,
                'id_progress'=>$id,
                'id_enrollment'=>$enroll->id_enrollment,
                'message'=>'progreso guardado con exito'
            ]);


        }catch(Exception $e){
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function updateProgess(int $id, string $uuid):void{
        if(!isset($_SESSION))
            session_start();
        
        if(!Request::isPATCH())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        $progress = ProgressEnrollment::find($id);

        try{
            $dataPost = Request::getBody();
            $progress->completed = $dataPost['completed']??0;

            $id = $progress->save();

            if(!$id)
                Response::json(['ok'=>false,'message'=>'Error al actualizar el progreso, intente mas tarde']);

            Response::json([
                'ok'=>true,
                'message'=>'progreso actualizado con exito'
            ]);


        }catch(Exception $e){
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

}