<?php

namespace App\Controllers;

use App\Classes\Auth;
use App\Classes\Helpers;
use App\Models\Admin;
use DinoEngine\Exceptions\QueryException;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

class AdminsController{

    public static function create():void{

        $alerts = [];
        $admin = new Admin;


        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();

            $admin->sincronize($datosEnviados);
            $alerts = $admin->validate();
            $alerts = $admin->adminExists();

            if(empty($alerts)){
                //encripto contraseña
                $admin->password = Auth::encriptPassword($admin->password);
                
                //guardo registro
                $id = $admin->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Administrador registrado con exito', 3000);
                    Response::redirect('/kta-admin/administradores');
                }else{
                    $alerts['error'][] = 'error al registrar el administrador, intente mas tarde';
                }

            }
        }

        Response::render('/admin/administradores/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo maestro',
            'admin'=>$admin,
            'alerts'=>$alerts
        ]);
    }

    public static function update($id):void{

        $admin = Admin::find($id);
        $alerts = [];

        if(!$admin)
            Response::redirect('/kta-admin/administradores');

        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();

            $admin->name = $datosEnviados['name'];
            $admin->email = $datosEnviados['email'];

            $alerts = $admin->validateUpdate();

            if(empty($alerts)){
                
                if(!empty($_POST['password'])){
                    $admin->password = $datosEnviados['password'];
                    $admin->password = Auth::encriptPassword($_POST['password']);
                }
                
                //guardo registro
                $id = $admin->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Administrador actualizado con exito', 3000);
                    Response::redirect('/kta-admin/administradores');
                }else{
                    $alerts['error'][] = 'error al actualizar el administrador, intente mas tarde';
                }
            }
            
        }

        Response::render('/admin/administradores/update', [
            'nameApp'=> APP_NAME,
            'title'=>'Actualizar administrador',
            'admin'=>$admin,
            'alerts'=>$alerts
        ]);

    }

    public static function delete($id):void{
        
        if(Request::isDELETE()){
            try {
                
                $admin = Admin::find($id);

                if(!$admin)
                    Response::json(['ok'=>false]);

                $rows = $admin->delete();
                
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