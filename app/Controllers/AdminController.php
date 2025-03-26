<?php

namespace App\Controllers;

use DinoEngine\Http\Response;

class AdminController
{
    public static function index(string $nameApp): void{

        Response::render('admin/index', [
            'nameApp'=>$nameApp, 
            'title' => 'Admin KTA'
        ]);

    }
}