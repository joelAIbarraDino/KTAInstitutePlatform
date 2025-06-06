<?php

namespace App\Controllers;

use DinoEngine\Http\Response;
use App\Models\Course;
use App\Models\Module;
use DinoEngine\Http\Request;

class ContentController{

    public static function content(int $id){
        
        $course = Course::find($id);
        
        if(!$course)
            Response::redirect('/kta-admin/cursos');
    
        $modules = Module::belongsTo('id_course', $course->id_course)??[];

        Response::render('/admin/contenido/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Contenido de curso',
            'modules'=>$modules
        ]);
    }

    public static function getModules(int $id){

        if(Request::isGET()){

            $modules = Module::belongsTo('id_course', $id)??[];
            
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
        
        if(Request::isPUT()){

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

    public static function deleteModule(int $id){
        
        if(Request::isDELETE()){

        }
    }
}