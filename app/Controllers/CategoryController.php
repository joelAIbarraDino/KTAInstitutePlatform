<?php

namespace App\Controllers;

use App\Models\Category;
use DinoEngine\Exceptions\QueryException;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

class CategoryController{

    public static function formCreate():void{
        
        Response::render('/admin/categorias/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nueva categoria'
        ]);
    }

    public static function formUpdate($id):void{
        
        $category = Category::find($id);

        if(!$category)
            Response::redirect("/kta-admin/categorias");

        Response::render('/admin/categorias/update', [
            'nameApp'=> APP_NAME,
            'title'=>'Actualizar categoria',
            'category'=>$category
        ]);
    }

    public static function create():void{

        if(Request::isPOST()){
            $datosEnviados = Request::getPostData();
            $category = new Category;

            $categoryExists = Category::where('name', 'LIKE', $datosEnviados['name']);

            if($categoryExists)
                Response::json(['alerts'=>['name'=>'ya existe una categoria con un nombre similar o igual']]);

            //sincronizo los datos ingresados y valido los datos
            $category->sincronize($datosEnviados);
            $alerts = $category->validate();

            if(!empty($alerts))
                Response::json(['alerts'=>$alerts]);

            //guardo registro
            $id = $category->save();
            Response::json(['id' => $id]);
        }

    }

    public static function update($id):void{

        if(Request::isPOST()){
            $datosEnviados = Request::getPostData();
            $category = Category::find($id);

            if(!$category)
                Response::json(['find'=>false]);

            if($category->name === $datosEnviados['name'])
                Response::json(['find'=>true, 'alerts'=>['name'=>'El valor es el mismo']]);

            $categoryExists = Category::where('name', 'LIKE', $datosEnviados['name']);

            if($categoryExists)
                Response::json(['alerts'=>['name'=>'ya existe una categoria con un nombre similar o igual']]);

            $category->sincronize($datosEnviados);
            $alerts = $category->validate();

            if(!empty($alerts))
                Response::json(['alerts'=>$alerts]);

            $row = $category->save();
            Response::json(['row' => $row]);
        }

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