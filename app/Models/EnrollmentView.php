<?php

namespace App\Models;

use DinoEngine\Core\Model;

class EnrollmentView extends Model {
    
    protected static string $table = 'enrollment_view';
    protected static array $columns = ['id_enrollment', 'enrollment_at', 'id_student', 'student', 'id_course', 'thumbnail', 'course', 'id_payment', 'amount', 'status', 'id_transition'];

    public ?int $id_enrollment;
    public string $enrollment_at;
    public int $id_student;
    public string $student;
    public int $id_course;
    public string $thumbnail;
    public string $course;
    public int $id_payment;
    public float $amount;
    public string $status;
    public int $id_transition;

    public function __construct($args = []){
        $this->id_enrollment = $args["id_enrollment"]??null;
        $this->enrollment_at = $args["enrollment_at"]??"";
        $this->id_student = $args["id_student"]??0;
        $this->student = $args["student"]??"";
        $this->id_course = $args["id_course"]??0;
        $this->thumbnail = $args["thumbnail"]??"";
        $this->course = $args["course"]??"";
        $this->id_payment = $args["id_payment"]??0;
        $this->amount = $args["amount"]??0;
        $this->status = $args["status"]??"";
        $this->id_transition = $args["id_transition"]??0;
    }

}