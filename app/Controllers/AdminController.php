<?php

namespace App\Controllers;

use DinoEngine\Http\Response;

class AdminController
{
    public static function index(string $nameApp): void{

        Response::render('pages_admin/upload', [
            'nameApp'=>$nameApp, 
            'title' => 'Inicio'
        ]);

    }
}