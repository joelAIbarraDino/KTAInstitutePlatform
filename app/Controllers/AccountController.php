<?php

namespace App\Controllers;

use DinoEngine\Http\Response;

class AccountController
{
    public static function login(string $nameApp): void{

        Response::render('account/login', [
            'nameApp'=>$nameApp, 
            'title' => 'Login'
        ]);
    }

    public static function forgot(string $nameApp): void{

        Response::render('account/forgot', [
            'nameApp'=>$nameApp, 
            'title' => 'Login'
        ]);
    }

    public static function signin(string $nameApp): void{

        Response::render('account/signin', [
            'nameApp'=>$nameApp, 
            'title' => 'Sign in'
        ]);
    }

}