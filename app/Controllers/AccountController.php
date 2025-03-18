<?php

namespace App\Controllers;

use DinoEngine\Http\Response;

class AccountController
{
    public static function login(string $nameApp): void{

        Response::render('pages_account/login', [
            'nameApp'=>$nameApp, 
            'title' => 'Login'
        ]);
    }

    public static function forgot(string $nameApp): void{

        Response::render('pages_account/forgot', [
            'nameApp'=>$nameApp, 
            'title' => 'Login'
        ]);
    }

}