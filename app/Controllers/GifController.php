<?php

namespace App\Controllers;

use App\Classes\Helpers;
use App\Models\Gif;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

class GifController{

    public static function create():void{

        $alerts = [];
        $gif = new Gif;


        if(Request::isPOST()){
            $alerts = [];

            $alerts = $gif->validateImage($_FILES);
    
            if(empty($alerts)){

                $gif->subirImagen($_FILES['gif_file'], 1200, 150);

                //guardo registro
                $id = $gif->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Gif creado con exito', 3000);
                
                    Response::redirect('/kta-admin/gifs');
                }else{
                    $alerts['error'][] = 'error al crear el gif, intente mas tarde';
                }

            }
        }

        Response::render('/admin/gifs/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo Gif',
            'gif'=>$gif,
            'alerts'=>$alerts
        ]);
    }

    public static function update($id):void{

        $gif = Gif::find($id);
        $alerts = [];

        if(!$gif)
            Response::redirect('/kta-admin/gifs');

        if(Request::isPOST()){
            $alerts = [];
            
            $alerts = $gif->validateImage($_FILES);

            if(empty($alerts)){    
                
                $gif->subirImagen($_FILES['gif_file'], 1200, 628);
                //guardo registro
                $id = $gif->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'gif actualizado con exito', 3000);

                    Response::redirect('/kta-admin/gifs');
                }else{
                    $alerts['error'][] = 'error al actualizar el gif, intente mas tarde';
                }
            }
            
        }

        Response::render('/admin/gifs/update', [
            'nameApp'=> APP_NAME,
            'title'=>'Actualizar gif',
            'gif'=>$gif,
            'alerts'=>$alerts
        ]);

    }
}