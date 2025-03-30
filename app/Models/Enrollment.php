<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Enrollment extends Model {
    
    protected static string $table = 'enrollment';
    protected static string $PK_name = 'id_enrollment';
    protected static array $columns = ['id_enrollment', 'enrollment_at', 'id_course', 'id_student', 'id_payment'];

    public ?int $id_enrollment;
    public string $enrollment_at;
    public int $id_course;
    public int $id_student;
    public int $id_payment;

    public function __construct($args = []){
        $this->id_enrollment = $args["id_enrollment"]??null;
        $this->enrollment_at = $args["enrollment_at"]??"";
        $this->id_course = $args["id_course"]??0;
        $this->id_student = $args["id_student"]??0;
        $this->id_payment = $args["id_payment"]??0;
    }

    public function validate(){

    }
}