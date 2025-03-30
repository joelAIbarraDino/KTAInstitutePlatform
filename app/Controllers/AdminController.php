<?php

namespace App\Controllers;

use App\Classes\Helpers;
use DinoEngine\Http\Response;

class AdminController
{
    public static function index(): void{

        Response::render('admin/index', [
            'nameApp'=>APP_NAME, 
            'title' => 'Admin KTA',
            'bienvenida' => Helpers::saludo()
        ]);

    }

    public static function courses():void{

        

        Response::render('admin/cursos/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin cursos'
        ]);

    }
}