<?php

namespace App\Controllers;

use App\Classes\Auth;
use App\Classes\Helpers;
use App\Models\Teacher;
use DinoEngine\Exceptions\QueryException;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

class TeacherController{

    public static function create():void{

        $alerts = [];
        $teacher = new Teacher;


        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();

            $teacher->sincronize($datosEnviados);
            $alerts = $teacher->validate();
            $alerts = $teacher->validateImage($_FILES);

            if(empty($alerts)){
                //proceso y guardo imagen;
                $teacher->subirImagen($_FILES['photo'], 1000,1000);

                //guardo registro
                $id = $teacher->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Profesor registrado con exito', 3000);
                    Response::redirect('/kta-admin/maestros');
                }else{
                    $alerts['error'][] = 'error al registrar el profesor, intente mas tarde';
                }

            }
        }

        Response::render('/admin/maestros/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo maestro',
            'teacher'=>$teacher,
            'alerts'=>$alerts
        ]);
    }

    public static function update($id):void{

        $teacher = Teacher::find($id);
        $alerts = [];

        if(!$teacher)
            Response::redirect('/kta-admin/maestros');

        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();

            $teacher->name = $datosEnviados['name'];
            $teacher->speciality = $datosEnviados['speciality'];
            $teacher->experience = $datosEnviados['experience'];
            $teacher->bio = $datosEnviados['bio'];

            $alerts = $teacher->validateUpdate();

            if(empty($alerts)){
                
                if($_FILES['photo']['size'] > 0){
                    $alerts = $teacher->validateImage($_FILES);
                    $teacher->subirImagen($_FILES['photo'], 1000,1000);
                }
                
                if(!empty($_POST['password'])){
                    $teacher->password = $datosEnviados['password'];
                    $teacher->password = Auth::encriptPassword($_POST['password']);
                }
                
                //guardo registro
                $id = $teacher->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Profesor actualizado con exito', 3000);
                    Response::redirect('/kta-admin/maestros');
                }else{
                    $alerts['error'][] = 'error al actualizar el profesor, intente mas tarde';
                }
            }
            
        }

        Response::render('/admin/maestros/update', [
            'nameApp'=> APP_NAME,
            'title'=>'Actualizar profesor',
            'teacher'=>$teacher,
            'alerts'=>$alerts
        ]);

    }

    public static function delete($id):void{
        
        if(Request::isDELETE()){
            try {
                
                $teacher = Teacher::find($id);

                if(!$teacher)
                    Response::json(['ok'=>false]);

                //guardo el nombre de la imagen antes de eliminar del DB
                $photoFile = $teacher->photo;
                $rows = $teacher->delete();
                
                //si no hubo filas afectadas retorno false
                if($rows === 0)
                    Response::json(['ok'=>false]);
            
                //se elimina la foto del servidor
                unlink(DIR_PROFESORES.$photoFile);
                Response::json(['ok'=>true]);

            } catch (QueryException) {
                Response::json(['ok'=>false]);
            }
        }
    }
}