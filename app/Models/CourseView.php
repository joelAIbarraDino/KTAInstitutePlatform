<?php

namespace App\Models;

use DinoEngine\Core\Model;

class CourseView extends Model {
    
    protected static string $table = 'course_view';
    protected static array $columns = [
        'id_course', 'name', 'watchword', 'category', 'thumbnail', 'description', 'price', 'discount', 'discount_ends',
        'max_months_enroll', 'created_at', 'privacy',
        'enrollment', 'id_teacher', 'teacher'
    ];

    public ?int $id_course;
    public string $name;
    public string $watchword;
    public string $category;
    public string $thumbnail;
    public string $description;
    public float $price;
    public ?float $discount;
    public ?string $discount_ends;
    public int $max_months_enroll;
    public string $created_at;
    public int $privacy;
    public int $enrollment;
    public int $id_teacher;
    public string $teacher;

    public function __construct($args = []){
        $this->id_course = $args["id_course"]??null;
        $this->name = $args["name"]??"";
        $this->watchword = $args["watchword"]??"";
        $this->category = $args["category"]??"";
        $this->thumbnail = $args["thumbnail"]??"";
        $this->description = $args["description"]??"";
        $this->price = $args["price"]??0;
        $this->discount = $args["discount"]??null;
        $this->discount_ends = $args["discount_ends"]??null;
        $this->max_months_enroll = $args["max_months_enroll"]??0;
        $this->created_at = $args["created_at"]??"";
        $this->privacy = $args["privacy"]??0;
        $this->enrollment = $args["enrollment"]??0;
        $this->id_teacher = $args["id_teacher"]??0;
        $this->teacher = $args["teacher"]??0;
    }
}