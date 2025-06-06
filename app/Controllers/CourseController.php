<?php

namespace App\Controllers;

use App\Classes\Helpers;
use DinoEngine\Exceptions\QueryException;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Teacher;

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
                $course->generateURL();
                
                $id = $course->save();
                if($id){
                    Response::redirect("/kta-admin/course-content/$id");
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
        
        $course = Course::find($id);
        $alerts = [];

        if(!$course)
            Response::redirect('/kta-admin/cursos');
        
        $teachers = Teacher::all();
        $categories = Category::all();
        $modules = [];

        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();

            $course->name = $datosEnviados['name'];
            $course->watchword = $datosEnviados['watchword'];
            $course->max_months_enroll = $datosEnviados['max_months_enroll'];
            $course->price = $datosEnviados['price'];
            $course->discount = $datosEnviados['discount'];
            $course->discount_ends_date = $datosEnviados['discount_ends_date'];
            $course->discount_ends_time = $datosEnviados['discount_ends_time'];
            $course->id_teacher = $datosEnviados['id_teacher'];
            $course->id_category = $datosEnviados['id_category'];
            $course->description = $datosEnviados['description'];

            $alerts = $course->validate();

            if($_FILES['thumbnail']['size'] > 0)
                $alerts = $course->validateFile($_FILES['thumbnail'], 1280, 720);

            
            if(empty($alerts)){
                //subir la nueva imagen si se subio una
                if($_FILES['thumbnail']['size'] > 0)
                    $course->uploadImage($_FILES['thumbnail'], 1280, 720);
                
                $id = $course->save();

                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Curso actualizado con exito');
                    Response::redirect('/kta-admin/cursos');
                }else{
                    $alerts['error'][] = 'Eror al actualizar el curso, intente mas tarde';
                }

            }
            

        }

        Response::render('/admin/cursos/update', [
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