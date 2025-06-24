<?php

namespace App\Controllers;

use App\Models\Course;
use App\Models\CourseView;
use App\Models\Student;
use DinoEngine\Http\Response;

class UserController{

    // public static function profile(int $uuid):void{

    //     $student = Student::where('profile_url', '=', $uuid);

    //     Response::render('/student/profile.php',[
    //         'nameApp'=>APP_NAME,
    //         'title'=>'Bienvenido '.$student->name,
    //         'transparente'=>false,
    //         'student'=>$student
    //     ]);
    // }

    public static function cursos():void{

        // $student = Student::where('profile_url', '=', $id);
        $myCourses = CourseView::all();

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