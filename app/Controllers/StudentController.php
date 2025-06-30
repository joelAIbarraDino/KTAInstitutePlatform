<?php

namespace App\Controllers;

use DinoEngine\Exceptions\QueryException;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Classes\Helpers;
use App\Models\Student;
use App\Classes\Auth;
use Exception;

class StudentController{

    public static function create():void{

        $alerts = [];
        $student = new Student;


        if(Request::isPOST()){
            $datosEnviados = Request::getPostData();

            $student->sincronize($datosEnviados);
            $alerts = $student->validate();
            $alerts = $student->studentExists();

            if(empty($alerts)){
                //encripto contraseña
                $student->password = Auth::encriptPassword($student->password);
                
                //guardo registro
                $id = $student->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Estudiante registrado con exito', 3000);
                    Response::redirect('/kta-admin/estudiantes');
                }else{
                    $alerts['error'][] = 'error al registrar el estudiante, intente mas tarde';
                }

            }
        }

        Response::render('/admin/estudiantes/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo estudiante',
            'student'=>$student,
            'alerts'=>$alerts
        ]);
    }

    public static function signIn():void{
        if(Request::isPOST()){

            try{
                $student = new Student;
                $datosEnviados = Request::getPostData();

                
                $student->sincronize($datosEnviados);
                
                $student->studentExistsAPI();
                $student->validateAPI();
                
                $student->password = Auth::encriptPassword($student->password);
                $student->user_confirmed = 1;
                $id = $student->save();

                if(!$id)
                    Response::json(['ok'=>false,'message'=>'Error al procesar el registro, intente mas tarde']);

                Response::json([
                    'ok'=>true,
                    'id'=>$id,
                    'message'=>'Registro exitoso'
                ]);    
                
            }catch(Exception $e){
                Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
            }


        }
    }

    public static function update($id):void{

        $student = Student::find($id);
        $alerts = [];

        if(!$student)
            Response::redirect('/kta-admin/estudiantes');

        if(Request::isPOST()){
            $datosEnviados = Request::getPostData();

            $student->name = $datosEnviados['name'];
            $student->email = $datosEnviados['email'];

            $alerts = $student->validateUpdate();

            if(empty($alerts)){
                
                if(!empty($_POST['password'])){
                    $student->password = $datosEnviados['password'];
                    $student->password = Auth::encriptPassword($_POST['password']);
                }
                
                //guardo registro
                $id = $student->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Estudiante actualizado con exito', 3000);
                    Response::redirect('/kta-admin/estudiantes');
                    return;
                }else{
                    $alerts['error'][] = 'error al actualizar al estudiante, intente mas tarde';
                }
            }
            
        }

        Response::render('/admin/estudiantes/update', [
            'nameApp'=> APP_NAME,
            'title'=>'Actualizar estudiantes',
            'student'=>$student,
            'alerts'=>$alerts
        ]);

    }

    public static function updateName(int $id):void{
        if(!Request::isPATCH())
            Response::json(['ok'=>false, 'message'=>'Metodo no soportado'], 400);

        if(!isset($_SESSION))
            session_start();

        $idStudent = $_SESSION['student']['id_student'];

        if($id != $idStudent)
            Response::json(['ok'=>false, 'message'=>'Error al actualizar estudiante'], 400);
    
        $datosEnviados = Request::getBody();

        $student = Student::where('id_student', '=', $idStudent);

        if(!$student)
            Response::json(['ok'=>false, 'message'=>'Estudiante no encontrado, contactar con KTA para mas información'], 400);

        $student->validateAPI();

        $student->name = $datosEnviados['name'];

        if(!$student->save())
            Response::json(['ok'=>false, 'message'=>'Error al actualizar nombre, intente mas tarde'], 400);

        Response::json(['ok'=>true, 'message'=>'Nombre actualizado con exito']);

    }

    public static function updatePassword(int $id):void{
        if(!Request::isPATCH())
            Response::json(['ok'=>false, 'message'=>'Metodo no soportado'], 400);

        if(!isset($_SESSION))
            session_start();

        $idStudent = $_SESSION['student']['id_student'];

        if($id != $idStudent)
            Response::json(['ok'=>false, 'message'=>'Error al actualizar estudiante'], 400);
    
        $datosEnviados = Request::getBody();

        $student = Student::where('id_student', '=', $idStudent);

        if(!$student)
            Response::json(['ok'=>false, 'message'=>'Estudiante no encontrado, contactar con KTA para mas información'], 400);

        
        $student->password = $datosEnviados['password'];
        
        $student->validateAPI();

        $student->password = Auth::encriptPassword($student->password);

        if(!$student->save())
            Response::json(['ok'=>false, 'message'=>'Error al actualizar contraseña, intente mas tarde'], 400);

        Response::json(['ok'=>true, 'message'=>'Contraseña actualizada con exito']);

    }

    public static function delete($id):void{
        
        if(Request::isDELETE()){
            try {
                
                $student = Student::find($id);

                if(!$student)
                    Response::json(['ok'=>false]);

                $rows = $student->delete();
                
                //si no hubo filas afectadas retorno false
                if($rows === 0)
                    Response::json(['ok'=>false]);
            
                Response::json(['ok'=>true]);

            } catch (QueryException) {
                Response::json(['ok'=>false]);
            }
        }
    }
}