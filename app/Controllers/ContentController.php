<?php

namespace App\Controllers;

use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\Lesson;
use App\Models\Module;

class ContentController{

    public static function testVimeo(){
        $videoId = '1067268542';
        $accessToken = $_ENV['TOKEN_ACCESS_VIMEO'];

        $ch = curl_init();
        $url = "https://api.vimeo.com/videos/{$videoId}";

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$accessToken}",
                "Accept: application/vnd.vimeo.*+json;version=3.4"
            ]
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if(curl_errno($ch))
            Response::json([
                'success' => false,
                'error' => curl_error($ch),
                'code' => $httpCode
            ]);
        
        $exists = false;
        $owned = false;

        switch ($httpCode) {
            case 200:
                $exists = true;
                $owned = true;
                $data = json_decode($response, true);
                break;

            case 403:
                $exists = true;
                $owned = false;
                $data = null;
                break;

            case 404:
                $exists = false;
                $owned = false;
                $data = null;
                break;

            default:
                $data = json_decode($response, true);
                break;
        }

        Response::json([
            'success' => $httpCode === 200,
            'exists' => $exists,
            'owned_by_account' => $owned,
            'code' => $httpCode,
            'data' => $data
        ]);
    
    }

    //pantalla principal para cargar el contenido del curso
    public static function content(string $id){

        Response::render('/admin/contenido-curso/course-content', [
            'nameApp'=> APP_NAME,
            'title'=>'Contenido de curso'
        ]);
    }

    //obtiene los modulos registrados
    public static function getModules(int $id){
        if(Request::isGET()){

            $modules = Module::belongsTo('id_course', $id, "order_module", 'ASC')??[];
            $modulesLessons = [];

            foreach($modules as $module){
                $lesson = Lesson::belongsTo('id_module', $module->id_module, "order_lesson", 'ASC')??[];

                $modulesLessons[] = [
                    'id_module'=>$module->id_module,
                    'name'=>$module->name,
                    'order_module'=>$module->order_module,
                    'id_course'=>$module->id_course,
                    'lessons'=>$lesson
                ];
            }

            Response::json([
                'modules'=>$modulesLessons,
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
                Response::json(['ok'=>false,'message'=>'Error al actualizar el orden del modulo, intente mas tarde', 'recibido'=>$module], 404);

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