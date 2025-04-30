<?php

namespace App\Controllers;

use App\Classes\Auth;
use App\Classes\Helpers;
use App\Models\Slidebar;
use DinoEngine\Exceptions\QueryException;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

class SlidebarController{

    public static function create():void{

        $alerts = [];
        $slidebar = new Slidebar;


        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();

            $slidebar->sincronize($datosEnviados);
            $alerts = $slidebar->validate();
            $alerts = $slidebar->validateImage($_FILES);

            if(empty($alerts)){
                //proceso y guardo imagen;
                $slidebar->subirImagen($_FILES['background'], 1800,1200);

                //guardo registro
                $id = $slidebar->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Slidebar creado con exito', 3000);
                    Response::redirect('/slidebar');
                }else{
                    $alerts['error'][] = ['error al crear el slidebar, intente mas tarde'];
                }

            }
        }

        Response::render('/admin/slidebar/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo slidebar',
            'slidebar'=>$slidebar,
            'alerts'=>$alerts
        ]);
    }

    public static function update($id):void{

        $slidebar = Slidebar::find($id);
        $alerts = [];

        if(!$slidebar)
            Response::redirect('/maestros');

        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();

            $slidebar->name = $datosEnviados['name'];
            $slidebar->email = $datosEnviados['email'];
            $slidebar->speciality = $datosEnviados['speciality'];
            $slidebar->experience = $datosEnviados['experience'];
            $slidebar->bio = $datosEnviados['bio'];

            $alerts = $slidebar->validate();

            if(empty($alerts)){
                
                if($_FILES['background']['size'] > 0){
                    $alerts = $slidebar->validateImage($_FILES);
                    $slidebar->subirImagen($_FILES['background'], 1000,1000);
                }
                
                //guardo registro
                $id = $slidebar->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'slidebar actualizado con exito', 3000);
                    Response::redirect('/maestros');
                }else{
                    $alerts['error'][] = ['error al actualizar el slidebar, intente mas tarde'];
                }
            }
            
        }

        Response::render('/admin/maestros/update', [
            'nameApp'=> APP_NAME,
            'title'=>'Actualizar profesor',
            'slidebar'=>$slidebar,
            'alerts'=>$alerts
        ]);

    }

    public static function delete($id):void{
        
        if(Request::isDELETE()){
            try {
                
                $slidebar = Slidebar::find($id);

                if(!$slidebar)
                    Response::json(['ok'=>false]);

                //guardo el nombre de la imagen antes de eliminar del DB
                $photoFile = $slidebar->photo;
                $rows = $slidebar->delete();
                
                //si no hubo filas afectadas retorno false
                if($rows === 0)
                    Response::json(['ok'=>false]);
            
                //se elimina la foto del servidor
                unlink(DIR_SLIDEBAR.$photoFile);
                Response::json(['ok'=>true]);

            } catch (QueryException) {
                Response::json(['ok'=>false]);
            }
        }
    }
}