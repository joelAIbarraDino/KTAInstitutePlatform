<?php

namespace App\Controllers;

use DinoEngine\Http\Response;

use App\Models\TeacherView;
use App\Models\Category;
use App\Models\Course;
use DinoEngine\Http\Request;

class CourseController{

    public static function formCreate():void{
        
        $teachers = TeacherView::all();
        $categories = Category::all();

        Response::render('/admin/cursos/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo curso',
            'arrayStatus'=>Course::PRIVACY,
            'teachers'=> $teachers,
            'categories' => $categories
        ]);
    }

    public static function create():void{

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

    }

    public static function update($id):void{

        if(Request::isPOST()){
            
            $datosEnviados = Request::getPostData();
            $course = Course::find(intval($id));

            if(!$course) 
                Response::json(['find' => false]);
            
            $course->sincronize($datosEnviados);
            $alerts = $course->validate();

            if(!empty($alerts))
                Response::json(['alerts'=>$alerts]);
            
            //guardo registro
            $id = $course->save();
            Response::json(['row' => $id]);    
            
        }
    }

    public static function delete($id):void{
        
        if(Request::isDELETE()){
            $course = Course::find($id);

            if(!$course)
                Response::json(['ok'=>false]);

            $rows = $course->delete();

            if($rows == 0)
                Response::json(['ok'=>false]);

            Response::json(['ok'=>true]);
        }
    }
}