<?php

namespace App\Controllers;

use DinoEngine\Exceptions\QueryException;
use App\Classes\Helpers;
use App\Models\Slidebar;
use DinoEngine\Helpers\Helpers as HelpersHelpers;
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
            $alerts = $slidebar->validateLink();
            $alerts = $slidebar->validateImage($_FILES);

            if(empty($alerts)){
                //proceso y guardo imagen;
                $slidebar->subirImagen($_FILES['background'], 1200, 628);

                //guardo registro
                $id = $slidebar->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Slidebar creado con exito', 3000);
                    Response::redirect('/kta-admin/slidebar');
                }else{
                    $alerts['error'][] = 'error al crear el slidebar, intente mas tarde';
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
            Response::redirect('/kta-admin/slidebar');

        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();

            $slidebar->title = $datosEnviados['title'];
            $slidebar->color_title = $datosEnviados['color_title'];
            $slidebar->subtitule = $datosEnviados['subtitule'];
            $slidebar->color_subtitule = $datosEnviados['color_subtitule'];
            $slidebar->link = $datosEnviados['link'];
            $slidebar->CTA = $datosEnviados['CTA'];

            $alerts = $slidebar->validate();
            $alerts = $slidebar->validateLink();
            
            if($_FILES['background']['size'] > 0)
                $alerts = $slidebar->validateImage($_FILES);

            if(empty($alerts)){    
                
                if($_FILES['background']['size'] > 0)
                    $slidebar->subirImagen($_FILES['background'], 1200, 628);
                //guardo registro
                $id = $slidebar->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'slidebar actualizado con exito', 3000);
                    Response::redirect('/kta-admin/slidebar');
                }else{
                    $alerts['error'][] = 'error al actualizar el slidebar, intente mas tarde';
                }
            }
            
        }

        Response::render('/admin/slidebar/update', [
            'nameApp'=> APP_NAME,
            'title'=>'Actualizar slider',
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
                $photoFile = $slidebar->background;
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