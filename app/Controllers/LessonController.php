<?php

namespace App\Controllers;

use App\Classes\Helpers;
use App\Models\Course;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\Lesson;
use App\Models\Material;
use App\Models\Module;
use Exception;

class LessonController{

    public static function create(int $id){
        if(!Request::isPOST())
            Response::json(['ok'=>true,'message'=>"Método no soportado"], 404);

        try {
            $lesson = new Lesson;
            
            //sincronizamos datos enviados por js para la nueva clase
            $dataPost = Request::getPostData();
            $lesson->sincronize($dataPost);

            //obtenemos el ultimo orden registrado en la base de datos 
            $currentOrder = Lesson::max('order_lesson', 'id_module', '=', $id);
            $currentOrder+=1;

            $lesson->order_lesson = $currentOrder;
            $lesson->id_module = $id;

            //validamos entrada de datos
            $lesson->validateAPI();

            //registramos modulo y devolvemos ID
            $id = $lesson->save();

            if(!$id)
                Response::json(['ok'=>false,'message'=>'Error al registrar la lección, intente mas tarde']);

            $atributosTraducibles = ['name', 'description']; 
            Helpers::traducirYGuardarJson("lesson", $id, $lesson, null, $atributosTraducibles);

            Response::json([
                'ok'=>true,
                'id'=>$id,
                'order_lesson'=>$currentOrder,
                'message'=>'Lección registrada con exito'
            ]);
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    
    }

    public static function update(int $id){
        if(!Request::isPUT())
            Response::json(['ok'=>true,'message'=>"Método no soportado"], 404);

        try {
            $lesson = Lesson::find($id);
            $original = clone $lesson;
            $dataSend = Request::getBody();

            $lesson->name = $dataSend['name'];
            $lesson->description = $dataSend['description'];
            $lesson->id_video = $dataSend['id_video'];

            $lesson->validateAPI();

            $rowAffected = $lesson->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar la lección, intente mas tarde'], 404);

            $atributosTraducibles = ['name', 'description']; 
            Helpers::traducirYGuardarJson("lesson", $lesson->id_lesson, $lesson, $original, $atributosTraducibles);

            Response::json(['ok'=>true,'message'=>'Lección actualizada con exito']);
        } catch (Exception $e) {
            Response::json(['ok'=>false, 'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
        
    }

    public static function delete(int $id){
        if(!Request::isDELETE())
            Response::json(['ok'=>false,'message'=>"Método no soportado"]);

        try {
            $lesson = Lesson::find($id);
            $module = Module::find($lesson->id_module);
            $course = Course::find($module->id_course);

            //guardo el orden del modulo que tenia y el curso al que pertenece
            $order_lesson = $lesson->order_lesson;
            $id_module = $lesson->id_module;

            //verifico si la clase tiene material
            $materialBelongsTolesson = Material::belongsTo('id_lesson', $lesson->id_lesson);

            if(!is_null($materialBelongsTolesson))
                Response::json(['ok'=>false,'message'=>'Esta lección tiene material agregados, elimine el material para eliminar esta lección'], 409);

            //verifico si el curso esta publicado
            $privacy = $course->privacy;

            if($privacy === Course::PRIVACY[2])
                Response::json(['ok'=>false,'message'=>'El curso esta publicado, ponga en privado el curso para eliminar esta lección'], 409);

            //verifico si el curso ya fue tomado por alguien

            //elimino el modulo
            $rowAffected = $lesson->delete();

            //en caso de que no se elimine cancelo el siguiente paso
            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al eliminar la lección, intente mas tarde'], 404);

            
            //actualizo el orden en los siguientes pasos
            $respuesta = Lesson::querySQL("UPDATE lesson set order_lesson = order_lesson - 1 where order_lesson > :order_lesson AND id_module = :id_module", [
                ':order_lesson'=>$order_lesson,
                ':id_module'=>$id_module
            ]);

            //regreso respuesta para ver que me regresa el querySQL
            Response::json(['ok'=>true,'message'=>$respuesta]);                  
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    
    }
}