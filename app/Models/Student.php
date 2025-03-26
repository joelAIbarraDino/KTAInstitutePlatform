<?php

use DinoEngine\Core\Model;

class Student extends Model {
    
    protected static $table = 'student';
    protected static $PK_name = 'id_student';
    protected static $columns = ['id_student', 'birthday', 'phone'];
    protected static $fillable = ['birthday', 'phone'];

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