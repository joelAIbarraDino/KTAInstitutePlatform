<?php

namespace App\Controllers;

use App\Classes\Helpers;
use App\Models\Category;
use DinoEngine\Exceptions\QueryException;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

class CategoryController{

    public static function create():void{

        $alerts = [];
        $category = new Category;


        if(Request::isPOST()){
            $datosEnviados = Request::getPostData();

            $category->sincronize($datosEnviados);
            $alerts = $category->validate();
            $alerts = $category->categoryExists();

            if(empty($alerts)){

                //guardo registro
                $id = $category->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Categoría registrada con exito', 3000);
                    Response::redirect('/kta-admin/categorias');
                }else{
                    $alerts['error'][] = 'error al registrar la categoría, intente mas tarde';
                }

            }
        }

        Response::render('/admin/categorias/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo estudiante',
            'category'=>$category,
            'alerts'=>$alerts
        ]);
    }

    public static function update($id):void{

        $category = Category::find($id);
        $alerts = [];

        if(!$category)
            Response::redirect('/kta-admin/categorias');

        if(Request::isPOST()){
            $datosEnviados = Request::getPostData();

            $category->name = $datosEnviados['name'];
            $alerts = $category->validate();

            if(empty($alerts)){
                //guardo registro
                $id = $category->save();
                
                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Categoría actualizada con exito', 3000);
                    Response::redirect('/kta-admin/categorias');
                    return;
                }else{
                    $alerts['error'][] = 'error al actualizar la categoría, intente mas tarde';
                }
            }
            
        }

        Response::render('/admin/categorias/update', [
            'nameApp'=> APP_NAME,
            'title'=>'Actualizar categoria',
            'category'=>$category,
            'alerts'=>$alerts
        ]);

    }

    public static function delete($id):void{
        
        if(Request::isDELETE()){

            try {
                $category = Category::find($id);

                if(!$category)
                    Response::json(['ok'=>false]);

                $rows = $category->delete();

                if($rows === 0)
                    Response::json(['ok'=>false]);

                Response::json(['ok'=>true]);
    
            } catch (QueryException) {
                Response::json(['ok'=>false]);
            }
            
        }
    }
}