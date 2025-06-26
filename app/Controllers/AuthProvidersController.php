<?php

namespace App\Controllers;

use DinoEngine\Http\Response;
use App\Classes\Helpers;
use App\Models\Student;
use Google_Client;


class AuthProvidersController{

    public static function googleAuth():void{

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

}