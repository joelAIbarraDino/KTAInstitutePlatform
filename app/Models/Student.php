<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Student extends Model {
    
    protected static string $table = 'student';
    protected static string $PK_name = 'id_student';
    protected static array $columns = ['id_student', 'birthday', 'phone'];
    protected static array $fillable = ['birthday', 'phone'];

    public ?int $id_student;
    public string $birthday;
    public string $phone;

    public function __construct($args = []){
        $this->id_student = $args["id_student"]??null;
        $this->birthday = $args["birthday"]??"";
        $this->phone = $args["phone"]??"";
    }

    public function validate(){

    }
}