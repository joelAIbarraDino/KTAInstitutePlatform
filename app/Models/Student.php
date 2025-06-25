<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Student extends Model {
    
    protected static string $table = 'student';
    protected static string $PK_name = 'id_student';
    protected static array $columns = ['id_student', 'name', 'email', 'password', 'user_confirmed', 'url_login'];
    protected static array $fillable = ['name', 'email', 'password', 'user_confirmed', 'url_login'];
    protected static array $nulleable = ['url_login'];

    public ?int $id_student;
    public string $name;
    public string $email;
    public string $password;
    public int $user_confirmed;
    public ?string $url_login;

    public function __construct($args = []){
        $this->id_student = $args["id_student"]??null;
        $this->name = $args["name"]??"";
        $this->email = $args["email"]??"";
        $this->password = $args["password"]??"";
        $this->user_confirmed = $args["user_confirmed"]??0;
        $this->url_login = $args["url_login"]??null;
        
    }

    public function validate():array{

        if(!$this->name)
            self::setAlerts('error', "el nombre es obligatorio");

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            self::setAlerts('error', "debe ingresar un correo valido");

        if(!$this->password)
            self::setAlerts('error', "la contraseña es obligatoria");

        return self::$alerts;
    }

    public function validateUpdate():array{

        if(!$this->name)
            self::setAlerts('error', "el nombre es obligatorio");

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            self::setAlerts('error', "debe ingresar un correo valido");

        return self::$alerts;
    }

    public function studentExists():array{
        $studentExists = Student::where("email", "=", $this->email);

        if($studentExists)
            self::setAlerts('warning', 'Ya existe un estudiante registrado con este correo');
        
        return self::$alerts;
    }
}