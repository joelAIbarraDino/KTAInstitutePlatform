<?php

namespace App\Models;

use DinoEngine\Core\Model;

class StudentLive extends Model {
    
    protected static string $table = 'student_live';
    protected static string $PK_name = 'id_student_live';
    protected static array $columns = ['id_student_live', 'from_membership', 'id_live', 'id_student', 'id_payment'];

    public ?int $id_student_live;
    public int $id_live;
    public int $from_membership;
    public int $id_student;
    public int $id_payment;

    public function __construct($args = []){
        $this->id_student_live = $args["id_student_live"]??null;
        $this->id_live = $args["id_live"]??0;
        $this->from_membership = $args["from_membership"]??0;
        $this->id_student = $args["id_student"]??0;
        $this->id_payment = $args["id_payment"]??0;
    }

    public function validate(){

    }
}