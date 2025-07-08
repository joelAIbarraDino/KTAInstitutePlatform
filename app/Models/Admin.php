<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Admin extends Model{
    
    protected static string $table = 'admin';
    protected static string $PK_name = 'id_admin';
    protected static array $columns = ['id_admin', 'name', 'email', 'password', 'totp_secret', 'totp_active'];
    protected static array $fillable = ['name', 'email', 'password', 'totp_secret', 'totp_active'];
    protected static array $nulleable = ['totp_secret'];

    public ?int $id_admin;
    public string $name;
    public string $email;
    public string $password;
    public ?string $totp_secret;
    public int $totp_active;

    public function __construct($args = [])
    {
        $this->id_admin = $args['id_admin']??null;
        $this->name = $args['name']??"";
        $this->email = $args['email']??"";
        $this->password = $args['password']??"";
        $this->totp_secret = $args['totp_secret']??null;
        $this->totp_active = $args['totp_active']??0;
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

    public function adminExists():array{
        $adminExists = Admin::where("email", "=", $this->email);

        if($adminExists)
            self::setAlerts('warning', 'Ya existe un administrador registrado con este correo');
        
        return self::$alerts;
    }
}