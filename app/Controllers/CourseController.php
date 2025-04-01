<?php

namespace App\Controllers;

use DinoEngine\Http\Response;

use App\Models\TeacherView;
use App\Models\Category;
use App\Models\Course;
use DinoEngine\Http\Request;

class CourseController{

    public static function create():void{

        $teachers = TeacherView::all();
        $categories = Category::all();

        if(Request::isPOST()){

            $datosEnviados = Request::getPostData();
            $course = new Course;
            $file = $_FILES;
            

            //sincronizo los datos ingresados y valido los datos
            $course->sincronize($datosEnviados);
            $alerts = $course->validate();
            $alerts = $course->validateFile($file);
    
            if(!empty($alerts))
                Response::json(['alerts'=>$alerts]);
            
            //guardo imagen
            $course->saveFile($file);        
            
            //guardo registro
            $id = $course->save();
            Response::json(['id' => $id]);            
        }

        Response::render('/admin/cursos/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo curso',
            'arrayStatus'=>Course::PRIVACY,
            'teachers'=> $teachers,
            'categories' => $categories
        ]);
    }
}