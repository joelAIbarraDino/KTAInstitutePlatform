<?php

namespace App\Controllers;

use App\Models\EnrollmentView;
use DinoEngine\Http\Response;

class UserController{

    public static function cursos():void{

        // $student = Student::where('profile_url', '=', $id);
        if(!isset($_SESSION))
            session_start();

        $idStudent = $_SESSION['student'];

        $myCourses = EnrollmentView::belongsTo('id_student', $idStudent['id_student'])??[];

        Response::render('/student/myCourses',[
            'nameApp'=>APP_NAME,
            'title'=>'Mis cursos',
            'myCourses'=>$myCourses
        ]);
        
    }


    public static function profile():void{

        // $student = Student::where('profile_url', '=', $id);

        Response::render('/student/profile',[
            'nameApp'=>APP_NAME,
            'title'=>'Mi perfil'
        ]);
    }

    public static function editProfile():void{

        // $student = Student::where('profile_url', '=', $id);

        Response::render('/student/editProfile',[
            'nameApp'=>APP_NAME,
            'title'=>'Editar perfil'
        ]);
    }
    

}