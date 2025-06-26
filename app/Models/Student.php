<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Student extends Model {
    
    protected static string $table = 'student';
    protected static string $PK_name = 'id_student';
    protected static array $columns = ['id_student', 'name', 'email', 'password', 'photo', 'oauth_provider', 'oauth_id', 'totp_secret', 'totp_active', 'user_confirmed'];
    protected static array $fillable = ['name', 'email', 'password', 'photo', 'oauth_provider', 'oauth_id', 'totp_secret', 'totp_active', 'user_confirmed'];
    protected static array $nulleable = ['password', 'photo', 'oauth_provider', 'oauth_id', 'totp_secret'];

    public ?int $id_student;
    public string $name;
    public string $email;
    public ?string $password;
    public ?string $photo;
    public ?string $oauth_provider;
    public ?string $oauth_id;
    public ?string $totp_secret;
    public int $totp_active;
    public int $user_confirmed;
    

    public function __construct($args = []){
        $this->id_student = $args["id_student"]??null;
        $this->name = $args["name"]??"";
        $this->email = $args["email"]??"";
        $this->password = $args["password"]??null;
        $this->photo = $args["photo"]??null;
        $this->oauth_provider = $args["oauth_provider"]??"";
        $this->oauth_id = $args["oauth_id"]??"";
        $this->totp_secret = $args["totp_secret"]??null;
        $this->totp_active = $args["totp_active"]??0;
        $this->user_confirmed = $args["user_confirmed"]??0;
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

    public static function studentOAuthExists(string $oauth_id, string $oauth_provider = 'google'):bool{
        
        $studentExists = Student::multiWhere([
            'oauth_id'=>$oauth_id,
            'oauth_provider'=> $oauth_provider
        ]);

        return is_null($studentExists)?false:true;
    }
}