<?php

namespace App\Controllers;

use App\Classes\Auth;
use App\Classes\Helpers;
use App\Models\Student;
use DinoEngine\Http\Request;
use DinoEngine\Http\Response;

class AccountController
{
    public static function login(): void{
        Response::render('account/login', [
            'nameApp'=>APP_NAME, 
            'title' => 'Login',
            'transparente'=>false
        ]);
    }

    public static function validateLogin():void{
        if(Request::isPOST()){
            $credentials = Request::getPostData();

            $user = Student::where('email', '=', $credentials['email']);

            if(!$user){
                Response::json([
                    'ok'=>false,
                    'message'=>'El correo ingresado no tiene una cuenta asociada'
                ]);
            }

            $correctPassword = Auth::comparePassword($user->password, $credentials['password']);

            if(!$correctPassword){
                Response::json([
                    'ok'=>false,
                    'message'=>'La contraseña ingresa no es correcta'
                ]);
            }

            //guardamos sesion en php
            session_start();

            $_SESSION['student'] = [
                'id_student' => $user->id_student,
                'nombre' => $user->name,
                'iniciales' => Helpers::obtenerIniciales($user->name)
            ];

            Response::json([
                'ok'=>true,
                'message'=>'Autenticación correcta',
                'redirect_url'=>'/mis-cursos'
            ]);
        }
    }

    public static function forgot(): void{

        Response::render('account/forgot', [
            'nameApp'=>APP_NAME, 
            'title' => 'Login',
            'transparente'=>false
        ]);
    }

    public static function signin(): void{

        Response::render('account/signin', [
            'nameApp'=>APP_NAME, 
            'title' => 'Sign in',
            'transparente'=>false
        ]);
    }

    public static function logout():void{

        session_start();
        session_unset();
        session_destroy();

        $_SESSION = [];

        Response::redirect('/login');

    }

}