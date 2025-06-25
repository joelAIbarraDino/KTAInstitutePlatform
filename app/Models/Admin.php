<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Admin extends Model{
    
    protected static string $table = 'admin';
    protected static string $PK_name = 'id_admin';
    protected static array $columns = ['id_admin', 'name', 'email', 'password', 'url'];
    protected static array $fillable = ['name', 'email', 'password', 'url'];
    protected static array $nulleable = ['url'];

    public ?int $id_admin;
    public string $name;
    public string $email;
    public string $password;
    public ?string $url;

    public function __construct($args = [])
    {
        $this->id_admin = $args['id_admin']??null;
        $this->name = $args['name']??"";
        $this->email = $args['email']??"";
        $this->password = $args['password']??"";
        $this->url = $args['url']??null;
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