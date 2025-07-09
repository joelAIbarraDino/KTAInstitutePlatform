<?php

namespace App\Controllers;

use DinoEngine\Exceptions\QueryException;

use App\Classes\Helpers;
use App\Models\Membership;

use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

class MembershipController{

    public static function create():void{

        $alerts = [];
        $membership = new Membership;

        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();

            $membership->sincronize($datosEnviados);
            $alerts = $membership->validate();
            $alerts = $membership->validateImage($_FILES);

            if(empty($alerts)){
                //proceso para guardar imagen
                $membership->subirImagen($_FILES['photo'], 920, 780);

                //guardo registro
                $id = $membership->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Membresia registrada con exito', 3000);
                    Response::redirect('/kta-admin/membresias');
                }else{
                    $alerts['error'][] = 'error al registrar la membresia, intente mas tarde';
                }

            }
        }

        Response::render('/admin/membresia/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nueva membresia',
            'membership'=>$membership,
            'alerts'=>$alerts
        ]);
    }

    public static function update($id):void{

        $membership = Membership::find($id);
        $alerts = [];

        if(!$membership)
            Response::redirect('/kta-admin/membresias');

        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();

            $membership->type = $datosEnviados['type'];
            $membership->max_time_membership = $datosEnviados['max_time_membership'];
            $membership->price = $datosEnviados['price'];
            $membership->caract = $datosEnviados['caract'];

            $alerts = $membership->validate();

            if(empty($alerts)){

                if($_FILES['photo']['size'] > 0){
                    $alerts = $membership->validateImage($_FILES);
                    $membership->subirImagen($_FILES['photo'], 920, 780);
                }

                //guardo registro
                $id = $membership->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Membresia actualizada con exito', 3000);
                    Response::redirect('/kta-admin/membresias');
                }else{
                    $alerts['error'][] = 'error al actualizar la membresia, intente mas tarde';
                }
            }
            
        }

        Response::render('/admin/membresia/update', [
            'nameApp'=> APP_NAME,
            'title'=>'Actualizar membresia',
            'membership'=>$membership,
            'alerts'=>$alerts
        ]);

    }

    public static function delete($id):void{
        
        if(Request::isDELETE()){
            try {
                
                $membership = Membership::find($id);

                if(!$membership)
                    Response::json(['ok'=>false]);

                $rows = $membership->delete();
                
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