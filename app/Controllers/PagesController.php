<?php

namespace App\Controllers;

use DinoEngine\Http\Request;
use DinoEngine\Http\Response;

class PagesController
{
    public static function index(string $nameApp): void{
        Response::render('publicPages/index', [
            'nameApp'=>$nameApp, 
            'title' => 'Inicio'
        ]);
    }

    public static function login(string $nameApp): void{

        if(Request::isPOST()){
            
        }

        Response::render('publicPages/login', [
            'nameApp'=>$nameApp, 
            'title' => 'Login'
        ]);
    }

}