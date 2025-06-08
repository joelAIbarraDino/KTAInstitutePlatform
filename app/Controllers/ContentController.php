<?php

namespace App\Controllers;

use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;

class ContentController{

    public static function content(int $id){
        
        $course = Course::find($id);
        
        if(!$course)
            Response::redirect('/kta-admin/cursos');
    
        Response::render('/admin/contenido-curso/course-content', [
            'nameApp'=> APP_NAME,
            'title'=>'Contenido de curso'
        ]);
    }

    public static function getModules(int $id){

        if(Request::isGET()){

            $modules = Module::belongsTo('id_course', $id, "order_module", 'ASC')??[];
            
            Response::json([
                'modules'=>$modules
            ]);
        }
    }

    public static function createModule(int $id){
        
        //solo acepta peticiones POST
        if(Request::isPOST()){
            $module = new Module;

            //sincronizamos datos enviados por js para nuevo modulo
            $dataPost = Request::getPostData();
            $module->sincronize($dataPost);

            //obtenemos el ultimo orden actual que tenemos registrado en la BD
            $currentOrder = Module::max('order_module', 'id_course', '=', $id);
            $currentOrder +=1;

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
                'message'=>'Modulo registrado  con exito'
            ]);
        }
    }

    public static function updateNameModule(int $id){
        if(Request::isPATCH()){

            $module = Module::find($id);
            $dataSend = Request::getBody();
            $module->name = $dataSend['name'];

            //validamos que no nos hayan enviado un nombre vacio
            if(!$module->name)
                Response::json(['ok'=>false,'message'=>'El nombre es obligatorio'], 404);

            //guardamos los cambios
            $rowAffected = $module->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar el nombre, intente mas tarde'], 404);

            Response::json(['ok'=>true,'message'=>'Nombre actualizado con exito']);
        }
    }

    public static function updateOrderModule(int $id){
        if(Request::isPATCH()){

            $module = Module::find($id);
            $dataSend = Request::getBody();
            $module->order_module = $dataSend['order_module'];

            //validamos que no nos hayan enviado un nombre vacio
            if(!$module->order_module)
                Response::json(['ok'=>false,'message'=>'El ordern de modulo es obligatorio'], 404);

            //guardamos los cambios
            $rowAffected = $module->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar el orden del modulo, intente mas tarde'], 404);

            Response::json(['ok'=>true,'message'=>'Orden actualizado actualizado con exito']);
        }
    }

    public static function deleteModule(int $id){
        
        if(Request::isDELETE()){
            //busco el modulo que quiero eliminar
            $module = Module::find($id);

            //guardo el orden del modulo que tenia y el curso al que pertenece
            $order_module = $module->order_module;
            $id_course = $module->id_course;

            //verifico si ese modulo tiene cursos
            $lessonsBelongsToModule = Lesson::belongsTo('id_module', $module->id_module);

            if(!is_null($lessonsBelongsToModule))
                Response::json(['ok'=>false,'message'=>'Este modulo tiene clases agregadas, elimine las clases para eliminar este modulo'], 404);

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

        }
    }
}