<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Student extends Model {
    
    protected static string $table = 'student';
    protected static string $PK_name = 'id_student';
    protected static array $columns = ['id_student', 'name', 'email', 'password', 'birthday', 'phone', 'url', 'clave'];
    protected static array $fillable = ['name', 'email', 'password', 'birthday', 'phone', 'url', 'clave'];
    protected static array $nulleable = ['url', 'clave'];

    public ?int $id_student;
    public string $name;
    public string $email;
    public string $password;
    public string $birthday;
    public string $phone;
    public ?string $url;
    public ?string $clave;

    public function __construct($args = []){
        $this->id_student = $args["id_student"]??null;
        $this->name = $args["name"]??"";
        $this->email = $args["email"]??"";
        $this->password = $args["password"]??"";
        $this->birthday = $args["birthday"]??"";
        $this->phone = $args["phone"]??"";
        $this->url = $args["url"]??null;
        $this->clave = $args["clave"]??null;
        
    }

    public function validate():array{

        if(!$this->name)
            self::setAlerts('error', "el nombre es obligatorio");

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            self::setAlerts('error', "debe ingresar un correo valido");

        if(!$this->password)
            self::setAlerts('error', "la contraseña es obligatoria");

        if(!$this->birthday)
            self::setAlerts('error', "El cumpleaños es obligatorio");
        elseif(date("Y-m-d") < $this->birthday)
            self::setAlerts('error', "El cumpleaños debe ser de una fecha anterior a hoy");

        if(!$this->phone)
            self::setAlerts('error', "El telefono es obligatorio");

        return self::$alerts;
    }

    public function validateUpdate():array{

        if(!$this->name)
            self::setAlerts('error', "el nombre es obligatorio");

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            self::setAlerts('error', "debe ingresar un correo valido");

        if(!$this->birthday)
            self::setAlerts('error', "El cumpleaños es obligatorio");

        if(!$this->phone)
            self::setAlerts('error', "El telefono es obligatorio");

        return self::$alerts;
    }

    public function studentExists():array{
        $studentExists = Student::where("email", "=", $this->email);

        if($studentExists)
            self::setAlerts('warning', 'Ya existe un estudiante registrado con este correo');
        
        return self::$alerts;
    }
}