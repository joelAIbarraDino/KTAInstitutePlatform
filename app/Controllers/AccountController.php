<?php

namespace App\Controllers;

use DinoEngine\Http\Response;

class AccountController
{
    public static function login(): void{

        Response::render('account/login', [
            'nameApp'=>APP_NAME, 
            'title' => 'Login'
        ]);
    }

    public static function forgot(): void{

        Response::render('account/forgot', [
            'nameApp'=>APP_NAME, 
            'title' => 'Login'
        ]);
    }

    public static function signin(): void{

        Response::render('account/signin', [
            'nameApp'=>APP_NAME, 
            'title' => 'Sign in'
        ]);
    }

}