<?php

namespace App\Controllers;

use App\Classes\Helpers;
use App\Models\BannerAsesoria;
use App\Models\Slidebar;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

class BannerAsesoriaController{

    public static function create():void{

        $alerts = [];
        $bannerAsesoria = new BannerAsesoria;


        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();

            $bannerAsesoria->sincronize($datosEnviados);

            $alerts = $bannerAsesoria->validate();
            $alerts = $bannerAsesoria->validateLink();
    
            if(empty($alerts)){

                //guardo registro
                $id = $bannerAsesoria->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Banner creado con exito', 3000);
                    
                    $atributosTraducibles = ['text_banner', 'CTA']; 
                    Helpers::traducirYGuardarJson("bannerAsesoria", $id, $bannerAsesoria, null, $atributosTraducibles);

                    Response::redirect('/kta-admin/banner-asesoria');
                }else{
                    $alerts['error'][] = 'error al crear el banner, intente mas tarde';
                }

            }
        }

        Response::render('/admin/bannerAsesoria/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo banner de asesoría',
            'bannerAsesoria'=>$bannerAsesoria,
            'alerts'=>$alerts
        ]);
    }

    public static function update($id):void{

        $bannerAsesoria = BannerAsesoria::find($id);
        $original = clone $bannerAsesoria;
        $alerts = [];

        if(!$bannerAsesoria)
            Response::redirect('/kta-admin/banner-asesoria');

        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData();

            $bannerAsesoria->text_banner = $datosEnviados['text_banner'];
            $bannerAsesoria->link = $datosEnviados['link'];
            $bannerAsesoria->CTA = $datosEnviados['CTA'];

            $alerts = $bannerAsesoria->validate();
            $alerts = $bannerAsesoria->validateLink();

            if(empty($alerts)){    
                //guardo registro
                $id = $bannerAsesoria->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Banner actualizado con exito', 3000);

                    $atributosTraducibles = ['text_banner', 'CTA']; 
                    Helpers::traducirYGuardarJson("bannerAsesoria", $bannerAsesoria->id_banner_asesoria, $bannerAsesoria, $original, $atributosTraducibles);

                    Response::redirect('/kta-admin/banner-asesoria');
                }else{
                    $alerts['error'][] = 'error al actualizar el banner, intente mas tarde';
                }
            }
            
        }

        Response::render('/admin/bannerAsesoria/update', [
            'nameApp'=> APP_NAME,
            'title'=>'Actualizar slider',
            'bannerAsesoria'=>$bannerAsesoria,
            'alerts'=>$alerts
        ]);

    }

}