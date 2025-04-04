<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Student extends Model {
    
    protected static string $table = 'student';
    protected static string $PK_name = 'id_student';
    protected static array $columns = ['id_student', 'name', 'email', 'pasword', 'birthday', 'phone', 'url', 'clave'];
    protected static array $fillable = ['name', 'email', 'pasword', 'birthday', 'phone', 'url', 'clave'];

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

    public function validate(){

    }
}