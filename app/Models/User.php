<?php

namespace App\Models;

use DinoEngine\Core\Model;

class User extends Model {
    
    protected static string $table = 'user';
    protected static string $PK_name = 'id_user';
    protected static array $columns = ['id_user', 'name', 'email', 'password', 'token', 'clave'];
    protected static array $fillable = ['name', 'email', 'password'];
    protected static array $nullable = ['token', 'clave'];
    protected static array $hidden = ['password'];

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