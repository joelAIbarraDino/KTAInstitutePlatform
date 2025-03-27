<?php

namespace App\Controllers;

use App\Classes\Helpers;
use DinoEngine\Http\Response;

class AdminController
{
    public static function index(string $nameApp): void{

        Response::render('admin/index', [
            'nameApp'=>$nameApp, 
            'title' => 'Admin KTA',
            'bienvenida' => Helpers::saludo()
        ]);

    }

    public static function courses(string $nameApp):void{

        

        Response::render('admin/cursos', [
            'nameApp' => $nameApp,
            'title' => 'Admin cursos'
        ]);

    }
}