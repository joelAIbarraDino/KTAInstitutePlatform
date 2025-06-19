<?php

namespace App\Controllers;

use App\Models\Course;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\Lesson;
use App\Models\Module;
use Exception;

class ModuleController{

    public static function create(int $id){
        if(!Request::isPOST())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);
        
        try {
            $module = new Module;

            //sincronizamos datos enviados por js para nuevo modulo
            $dataPost = Request::getPostData();
            $module->sincronize($dataPost);

            //verificamos si el curso esta publicado
            $course = Course::find($id);

            if($course->privacy == Course::PRIVACY[2])
               Response::json(['ok'=>false,'message'=>'El curso esta publicado, ponga en privado el curso para agregar mas contenido'], 409);
            
            //obtenemos el ultimo orden actual que tenemos registrado en la BD
            $currentOrder = Module::max('order_module', 'id_course', '=', $id);
            $currentOrder+=1;

            $module->order_module = $currentOrder;

            //validamos entrada de datos
            $module->validateAPI();

            //registramos modulo y devolvemos ID
            $id = $module->save();

            if(!$id)
                Response::json(['ok'=>false,'message'=>'Error al registrar el modulo, intente mas tarde']);

            Response::json([
                'ok'=>true,
                'id'=>$id,
                'order_module'=>$currentOrder,
                'message'=>'Modulo registrado con exito'
            ]);                  
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function updateName(int $id){
        if(!Request::isPATCH())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $module = Module::find($id);
            $dataSend = Request::getBody();
            $module->name = $dataSend['name'];

            //validamos que no nos hayan enviado un nombre vacio
            if(!$module->name)
                Response::json(['ok'=>false,'message'=>'El nombre es obligatorio'], 400);

            //guardamos los cambios
            $rowAffected = $module->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar el nombre, intente mas tarde'], 404);

            Response::json(['ok'=>true,'message'=>'Nombre actualizado con exito']);
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }    
    }

    public static function updateOrder(int $id){
        if(!Request::isPATCH())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $module = Module::find($id);
            $dataSend = Request::getBody();

            $module->order_module = $dataSend['order_module'];

            $module->validateAPI();

            //guardamos los cambios
            $rowAffected = $module->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar el orden del modulo, intente mas tarde'], 404);

            Response::json(['ok'=>true,'message'=>'Orden actualizado actualizado con exito']);
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function delete(int $id){
        if(!Request::isDELETE())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            //busco el modulo que quiero eliminar
            $module = Module::find($id);

            //guardo el orden del modulo que tenia y el curso al que pertenece
            $order_module = $module->order_module;
            $id_course = $module->id_course;

            //verifico si ese modulo tiene cursos
            $lessonsBelongsToModule = Lesson::belongsTo('id_module', $module->id_module);

            if(!is_null($lessonsBelongsToModule))
                Response::json(['ok'=>false,'message'=>'Este modulo tiene clases agregadas, elimine las clases para eliminar este modulo'], 409);

            //elimino el modulo
            $rowAffected = $module->delete();

            //en caso de que no se elimine cancelo el siguiente paso
            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al eliminar el modulo, intente mas tarde'], 404);

            
            //actualizo el orden en los siguientes pasos
            $respuesta = Module::querySQL("UPDATE module set order_module = order_module - 1 where order_module > :order_module AND id_course = :id_course", [
                ':order_module'=>$order_module,
                ':id_course'=>$id_course
            ]);

            //regreso respuesta para ver que me regresa el querySQL
            Response::json(['ok'=>true,'message'=>$respuesta]);
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

}