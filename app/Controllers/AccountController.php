<?php

namespace App\Controllers;

use App\Classes\Auth;
use App\Classes\Helpers;
use App\Models\Student;
use DinoEngine\Helpers\Helpers as HelpersHelpers;
use DinoEngine\Http\Request;
use DinoEngine\Http\Response;
use Google\Service\FirebaseAppHosting\Redirect;
use Google_Client;

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

            //si no existe el estudiante
            $user = Student::where('email', '=', $credentials['email']);

            if(!$user){
                Response::json([
                    'ok'=>false,
                    'message'=>'El correo ingresado no tiene una cuenta asociada'
                ]);
            }

            //si inicio sesion con google y no se guardo una contraseña
            if(!$user->password && $user->oauth_id){
                Response::json([
                    'ok'=>false,
                    'message'=>'La cuenta no tiene una contraseña configurada, inicie sesión con '.$user->oauth_provider
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

    public static function googleLogin():void{

        $idToken = $_POST['credential']??null;

        $client = new Google_Client();
        $client->setClientId($_ENV['CLIENT_ID_GOOGLE']);

        $payload = $client->verifyIdToken($idToken);

        if(!$payload){
            Helpers::setSwalAlert('error', '¡Error!', 'Token invalido', 3000);
            Response::redirect('/login');
        }

        $student = Student::where('email', '=', $payload['email']);

        //existe el estudiante pero es la primera vez que inicia sesión con google
        if($student && !$student->oauth_id){
            $student->oauth_id = $payload['sub'];
            $student->oauth_provider = "Google";
            $student->photo = $payload['picture']??null;
            $student->user_confirmed = $payload['email_verified'] ? 1 : 0;

            //salvamos el registro
            if(!$student->save()){
                Helpers::setSwalAlert('error', '¡Error!', 'Error al actualizar usuario existente', 3000);
                Response::redirect('/login');
            }
        }

        //registramos al estudiante si no existe
        if(!$student){
            $student = new Student;

            $student->name = $payload['name'];
            $student->email = $payload['email'];
            $student->photo = $payload['photo']??null;
            $student->oauth_id = $payload['sub'];
            $student->oauth_provider = "Google";
            $student->user_confirmed = $payload['email_verified'] ? 1 : 0;

            //creamos el nuevo usuario
            $student->id_student = $student->save();

            if(!$student->id_student){
                Helpers::setSwalAlert('error', '¡Error!', 'Error al actualizar usuario existente', 3000);
                Response::redirect('/login');
            }
        }

        session_start();

        $_SESSION['student'] = [
            'id_student' => $student->id_student,
            'nombre' => $student->name,
            'iniciales' => Helpers::obtenerIniciales($student->name),
            'photo'=> $student->photo
        ];

        Response::redirect('/mis-cursos');
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