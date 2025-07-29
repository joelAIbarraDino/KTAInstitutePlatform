<?php

namespace App\Controllers;

use DinoEngine\Exceptions\QueryException;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Classes\Helpers;
use App\Models\Category;
use App\Models\LiveView;
use App\Models\Live;
use App\Models\PaymentLiveView;
use Exception;

class LiveController{

    public static function create():void{

        $alerts = [];
        $categories = Category::all();

        $live = new Live;
        $fechas = [];

        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData(['details']);

            
            $live->sincronize($datosEnviados, false);
            $fechas = $datosEnviados['schedules']??[];

            $alerts == $live->validateDates($fechas);
            $alerts = $live->validate();
            $alerts = $live->validateFileThumbnail($_FILES);
            $alerts = $live->validateFileBackground($_FILES);

            if(empty($alerts)){
                $live->uploadImageThumbnail($_FILES['thumbnail'], 1000, 1000);
                $live->uploadImageBackground($_FILES['background'], 1280, 720);
                $live->generateURL();
                $live->dates_times = json_encode($fechas);

                $id = $live->save();
                if($id){
                    $atributosTraducibles = ['name', 'description', 'details']; 
                    Helpers::traducirYGuardarJson("live", $id, $live, null, $atributosTraducibles, "html");

                    Response::redirect("/kta-admin/lives");
                }else{
                    $alerts['error'][] = 'error al registrar el curso, intente mas tarde';
                }
            }


        }

        Response::render('/admin/lives/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo live',
            'live'=>$live,
            'categories' => $categories,
            'alerts'=>$alerts,
            'fechas'=>$fechas
        ]);

    }

    public static function update($id):void{
        
        $live = Live::find($id);
        $original = clone $live;
        $fechas = json_decode($live->dates_times);
        $alerts = [];

        if(!$live)
            Response::redirect('/kta-admin/cursos');
        
        $categories = Category::all();

        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData(['details']);

            $live->sincronize($datosEnviados, false);
            
            $fechas = $datosEnviados['schedules']??[];
            $alerts == $live->validateDates($fechas);
            $alerts = $live->validate();

            if($_FILES['thumbnail']['size'] > 0)
                $alerts = $live->validateFileThumbnail($_FILES);

            if($_FILES['background']['size'] > 0)
                $alerts = $live->validateFileBackground($_FILES);

            
            if(empty($alerts)){
                //subir la nueva imagen si se subio una
                if($_FILES['thumbnail']['size'] > 0)
                    $live->uploadImageThumbnail($_FILES['thumbnail'], 1000, 1000);

                if($_FILES['background']['size'] > 0)
                    $live->uploadImageBackground($_FILES['background'], 1280, 720);
                
                $live->dates_times = json_encode($fechas);

                $id = $live->save();

                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Live actualizado con exito');
                    
                    $atributosTraducibles = ['name', 'watchword', 'description', 'details']; 
                    Helpers::traducirYGuardarJson("live", $live->id_live, $live, $original, $atributosTraducibles, "html");

                    Response::redirect('/kta-admin/lives');
                }else{
                    $alerts['error'][] = 'Eror al actualizar el live, intente mas tarde';
                }

            }
            

        }

        Response::render('/admin/lives/update', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo curso',
            'live'=>$live,
            'categories' => $categories,
            'alerts'=>$alerts,
            'fechas'=>$fechas
        ]);
    }

    public static function delete($id):void{
        
        if(Request::isDELETE()){
            try {
                $live = Live::find($id);

                if(!$live)
                    Response::json(['ok'=>false]);

                //guardo el nombre de la imagen antes de eliminar del DB
                $photoFile = $live->thumbnail;
                $rows = $live->delete();

                if($rows == 0)
                    Response::json(['ok'=>false]);

                //se elimina la foto del servidor
                unlink(DIR_CARATULAS.$photoFile);
                Response::json(['ok'=>true]);
            } catch (QueryException) {
                Response::json(['ok'=>false]);
            }

        }
    }

    public static function lives():void{

        $eventos = LiveView::all();
        $listaEventos = [];

        foreach($eventos as $evento){
            
            $fechas = json_decode($evento->dates_times);

            foreach($fechas as $fecha){
                $listaEventos[] =[
                    'title'=>$evento->name,
                    'start'=>$fecha,
                    'url'=>'/live/view/'.$evento->url
                ];
            }
        }

        Response::json($listaEventos);
    }

    public static function searchPagoLive(string $attribute, string $value):void{
        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        if(!property_exists(PaymentLiveView ::class, $attribute))
            Response::json(['ok'=>true,'message'=>"Attributo invalido"]);

        try{

            $query = PaymentLiveView::querySQL('SELECT * FROM payment_live_view WHERE '.$attribute.' LIKE :value', [
                ':value'=>'%'.$value.'%'
            ])??[];

            if(!$query){
                Response::json([
                    'query'=>[]
                ]);
            }

            Response::json([
                'query'=>$query
            ]);

        }catch(Exception $e){
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }
}