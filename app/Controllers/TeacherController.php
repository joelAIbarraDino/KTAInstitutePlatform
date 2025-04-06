<?php

namespace App\Controllers;

use App\Classes\Auth;
use App\Models\Teacher;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

class TeacherController{

    public static function formCreate():void{
        
        Response::render('/admin/maestros/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo maestro'
        ]);
    }

    public static function formUpdate($id):void{
        
    }

    public static function create():void{

        if(Request::isPOST()){
            $datosEnviados = Request::getPostData();
            $teacher = new Teacher;

            $teacherExists = Teacher::where("email", "=", $datosEnviados['email']);

            if($teacherExists)
                Response::json(['alerts'=>['email'=>'Ya existe un maestro registrado con este correo']]);

            $teacher->sincronize($datosEnviados);
            $alerts = $teacher->validate();
            $alerts = $teacher->validateImage($_FILES);

            if(!empty($alerts))
                Response::json(['alerts'=>$alerts]);

            //encripto contraseña
            $teacher->password = Auth::encriptPassword($teacher->password);
            //proceso y guardo imagen;
            $teacher->subirImagen($_FILES['photo'], 1000,1000);

            //guardo registro
            $id = $teacher->save();
            Response::json(['id' => $id]);

        }

    }

    public static function update($id):void{

        if(Request::isPOST()){

        }

    }

    public static function delete($id):void{
        
        if(Request::isDELETE()){
            
        }
    }
}