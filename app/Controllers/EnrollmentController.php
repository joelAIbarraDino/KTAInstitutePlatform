<?php

namespace App\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use DinoEngine\Http\Response;
use Ramsey\Uuid\Uuid;

class EnrollmentController{

    public static function index(string $uuid){
    
        Response::render('/student/aula/virtualAula', [
            'nameApp'=>APP_NAME,
            'title'=>'Curso'
        ]);
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
}