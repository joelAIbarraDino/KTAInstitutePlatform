<?php

namespace App\Controllers;

use App\Classes\Auth;
use App\Classes\Helpers;
use App\Models\Admin;
use App\Models\Student;
use DinoEngine\Http\Request;
use DinoEngine\Http\Response;


class AuthController
{

    public static function login(): void{

        Response::render('account/login', [
            'nameApp'=>APP_NAME, 
            'title' => 'Login',
            'googleCallBack'=>URI_REDIRECT_GOOGLE
        ]);
    }

    public static function loginAdmin():void{
        Response::render('account/loginAdmin', [
            'nameApp'=>APP_NAME, 
            'title' => 'Login Admin'
        ]);
    }

    public static function ktaAuth():void{
        if(Request::isPOST()){
            $credentials = Request::getPostData();

            //si no existe el estudiante
            $user = Student::where('email', '=', $credentials['email']);

            if(!$user){
                Response::json([
                    'ok'=>false,
                    'message'=>'El correo ingresado no tiene una cuenta asociada'
                ]);
            }

            //si inicio sesion con google y no se guardo una contraseña
            if(!$user->password){
                Response::json([
                    'ok'=>false,
                    'message'=>'La cuenta no tiene una contraseña configurada, inicie sesión con Google'
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
                'iniciales' => Helpers::obtenerIniciales($user->name),
                'photo'=> $user->photo
            ];

            Response::json([
                'ok'=>true,
                'message'=>'Autenticación correcta',
                'redirect_url'=>'/mis-cursos'
            ]);
        }
    }

    public static function ktaAuthAdmin():void{
        if(Request::isPOST()){
            $credentials = Request::getPostData();

            //si no existe el estudiante
            $user = Admin::where('email', '=', $credentials['email']);

            if(!$user){
                Response::json([
                    'ok'=>false,
                    'message'=>'El correo ingresado no es una cuenta administradora'
                ]);
            }

            //si inicio sesion con google y no se guardo una contraseña
            if(!$user->password){
                Response::json([
                    'ok'=>false,
                    'message'=>'La cuenta no tiene una contraseña configurada, contacte con el administrador'
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

            $_SESSION['admin'] = [
                'id_admin' => $user->id_admin,
                'nombre' => $user->name,
                'iniciales' => Helpers::obtenerIniciales($user->name)
            ];

            Response::json([
                'ok'=>true,
                'message'=>'Autenticación correcta',
                'redirect_url'=>'/kta-admin/dashboard'
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

    public static function signIn(): void{

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