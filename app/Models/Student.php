<?php

namespace App\Models;

use DinoEngine\Core\Model;
use DinoEngine\Http\Response;

class Student extends Model {
    
    protected static string $table = 'student';
    protected static string $PK_name = 'id_student';
    protected static array $columns = ['id_student', 'name', 'email', 'phone', 'street', 'number_street', 'state', 'cp', 'password', 'photo', 'oauth_provider', 'oauth_id', 'totp_secret', 'totp_active', 'user_confirmed'];
    protected static array $fillable = ['name', 'email', 'phone', 'street', 'number_street', 'state', 'cp', 'password', 'photo', 'oauth_provider', 'oauth_id', 'totp_secret', 'totp_active', 'user_confirmed'];
    protected static array $nulleable = ['phone','street', 'number_street', 'state', 'cp', 'password', 'photo', 'oauth_provider', 'oauth_id', 'totp_secret'];

    public ?int $id_student;
    public string $name;
    public string $email;
    public ?string $phone;
    public ?string $street;
    public ?string $number_street;
    public ?string $state;
    public ?string $cp;
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
        $this->phone = $args['phone']??null;
        $this->street = $args['street']??null;
        $this->number_street = $args['number_street']??null;
        $this->state = $args['state']??null;
        $this->cp = $args['cp']??null;
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
            self::setAlerts('error', "El nombre es obligatorio");

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            self::setAlerts('error', "Debe ingresar un correo valido");

        if(!$this->password)
            self::setAlerts('error', "La contraseña es obligatoria");

        // if(!$this->phone)
        //     self::setAlerts('error', "El teléfono es obligatorio");

        return self::$alerts;
    }

    public function validateDirection():array{
        $direction = [
            'street'=>$this->street??null,
            'number_street'=>$this->number_street??null,
            'state'=>$this->state??null,
            'cp'=>$this->cp??null,
        ];

        $anyFilled = array_filter($direction, fn($value)=>!empty($value));

        if($this->cp && strlen($this->cp) > 5)
            self::setAlerts('error', "El CP es invalido");

        if($anyFilled && count($anyFilled) < count($direction))
            self::setAlerts('error', "Debe completar los datos de la dircción");

        return self::$alerts;
    }

    public function validateDirectionAPI():void{
        $direction = [
            'street'=>$this->street??null,
            'number_street'=>$this->number_street??null,
            'state'=>$this->state??null,
            'cp'=>$this->cp??null,
        ];

        $anyFilled = array_filter($direction, fn($value)=>!empty($value));

        if($this->cp && strlen($this->cp) > 5)
            Response::json(['ok'=>false, 'message'=>'El CP es invalido'], 400);

        if($anyFilled && count($anyFilled) < count($direction))
            Response::json(['ok'=>false, 'message'=>'Debe completar los datos de la dircción'], 400);

    }

    public function validateAPI():void{
        if(!$this->name)
            Response::json(['ok'=>false, 'message'=>'El nombre es obligatorio'], 400);

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            Response::json(['ok'=>false, 'message'=>'Debe ingresar un correo valido'], 400);

        // if(!$this->phone)
        //     Response::json(['ok'=>false, 'message'=>'El teléfono es obligatorio'], 400);

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

    public function studentExistsAPI():void{
        $studentExists = Student::where("email", "=", $this->email);

        if($studentExists)
            Response::json(['ok'=>false, 'message'=>'Ya existe un estudiante registrado con este correo'], 400);
        
    }

}