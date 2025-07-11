<?php

namespace App\Models;

use DinoEngine\Core\Model;

class EnrollmentView extends Model {
    
    protected static string $table = 'enrollment_view';
    protected static array $columns = ['id_enrollment', 'enrollment_at', 'enroll_url', 'id_student', 'student', 'email', 'id_course', 'thumbnail', 'course', 'privacy', 'category', 'course_url', 'max_months_enroll'];

    public ?int $id_enrollment;
    public string $enrollment_at;
    public string $enroll_url;
    public int $id_student;
    public string $student;
    public string $email;
    public int $id_course;
    public string $thumbnail;
    public string $course;
    public string $privacy;
    public string $category;
    public string $course_url;
    public int $max_months_enroll;

    public function __construct($args = []){
        $this->id_enrollment = $args["id_enrollment"]??null;
        $this->enrollment_at = $args["enrollment_at"]??"";
        $this->enroll_url = $args["enroll_url"]??"";
        $this->id_student = $args["id_student"]??0;
        $this->student = $args["student"]??"";
        $this->email = $args["email"]??"";
        $this->id_course = $args["id_course"]??0;
        $this->thumbnail = $args["thumbnail"]??"";
        $this->course = $args["course"]??"";
        $this->privacy = $args["privacy"]??"";
        $this->category = $args["category"]??"";
        $this->course_url = $args["course_url"]??"";
        $this->max_months_enroll = $args["max_months_enroll"]??6;
    }

}