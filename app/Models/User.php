<?php

use DinoEngine\Core\Model;

class User extends Model {
    
    protected static $table = 'user';
    protected static $PK_name = 'id_user';
    protected static $columns = ['id_user', 'name', 'email', 'password', 'token', 'clave'];
    protected static $fillable = ['name', 'email', 'password'];
    protected static $nullable = ['token', 'clave'];
    protected static $hidden = ['password'];

    public ?int $id_user;
    public string $name;
    public string $email;
    public string $password;
    public string $token;
    public string $clave;

    public function __construct($args = []){
        $this->id_user = $args["id_user"]??null;
        $this->name = $args["name"]??"";
        $this->email = $args["email"]??"";
        $this->password = $args["password"]??"";
        $this->token = $args["token"]??null;
        $this->clave = $args["clave"]??null;
    }

    public function validate(){

    }
}