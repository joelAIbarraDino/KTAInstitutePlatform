<?php

namespace App\Controllers;

use DinoEngine\Exceptions\QueryException;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Teacher;
use DinoEngine\Helpers\Helpers;

class CourseController{

    public static function create():void{

        $alerts = [];
        $teachers = Teacher::all();
        $categories = Category::all();
        $modules = [];

        $course = new Course;
        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();
            
            $course->sincronize($datosEnviados);

            $alerts = $course->validate();
            $alerts = $course->validateFile($_FILES);

            if(empty($alerts)){
                $course->uploadImage($_FILES['thumbnail'], 1280, 720);

                
                $id = $course->save();
                if($id){
                    Response::redirect("/admin/curso/create/content/$id");
                }else{
                    $alerts['error'][] = 'error al registrar el curso, intente mas tarde';
                }
            }


        }

        Response::render('/admin/cursos/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo curso',
            'arrayStatus'=>Course::PRIVACY,
            'course'=>$course,
            'modules'=>$modules,
            'teachers'=> $teachers,
            'categories' => $categories,
            'alerts'=>$alerts
        ]);

    }

    public static function update($id):void{

        if(Request::isPOST()){
            
            
        }
    }

    public static function delete($id):void{
        
        if(Request::isDELETE()){
            try {
                $course = Course::find($id);

                if(!$course)
                    Response::json(['ok'=>false]);

                //guardo el nombre de la imagen antes de eliminar del DB
                $photoFile = $course->thumbnail;
                $rows = $course->delete();

                if($rows == 0)
                    Response::json(['ok'=>false]);

                //se elimina la foto del servidor
                unlink(DIR_CARATULAS.$photoFile);
                Response::json(['ok'=>true]);
            } catch (QueryException) {
                Response::json(['ok'=>false]);
            }

        }
    }
}