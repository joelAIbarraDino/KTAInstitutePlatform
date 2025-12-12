<?php

namespace App\Models;

use DinoEngine\Core\Model;

class CourseView extends Model {
    
    protected static string $table = 'course_view';
    protected static array $columns = [
        'id_course', 'name', 'watchword', 'background', 'id_category', 'category', 'thumbnail', 'type', 'description', 'details', 'dates_times',
        'price', 'discount', 'discount_ends_date', 'discount_ends_time', 
        'max_months_enroll', 'created_at', 'url', 'privacy',
        'enrollment', 'id_teacher', 'teacher'
    ];

    public ?int $id_course;
    public string $name;
    public string $watchword;
    public ?string $background;
    public int $id_category;
    public string $category;
    public ?string $thumbnail;
    public string $type;
    public string $description;
    public ?string $details;
    public ?string $dates_times;
    public float $price;
    public ?float $discount;
    public ?string $discount_ends_date;
    public ?string $discount_ends_time;
    public int $max_months_enroll;
    public string $created_at;
    public string $url;
    public string $privacy;
    public int $enrollment;
    public int $id_teacher;
    public string $teacher;

    public function __construct($args = []){
        $this->id_course = $args["id_course"]??null;
        $this->name = $args["name"]??"";
        $this->watchword = $args["watchword"]??"";
        $this->background = $args["background"]??null;
        $this->id_category = $args["id_category"]??0;
        $this->category = $args["category"]??"";
        $this->thumbnail = $args["thumbnail"]??null;
        $this->type = $args["type"]??"";
        $this->description = $args["description"]??"";
        $this->details = $args["details"]??"";
        $this->dates_times = $args["dates_times"]??null;
        $this->price = $args["price"]??0;
        $this->discount = $args["discount"]??null;
        $this->discount_ends_date = $args["discount_ends_date"]??null;
        $this->discount_ends_time = $args["discount_ends_time"]??null;
        $this->max_months_enroll = $args["max_months_enroll"]??0;
        $this->created_at = $args["created_at"]??"";
        $this->url = $args["url"]??"";
        $this->privacy = $args["privacy"]??"Editando";
        $this->enrollment = $args["enrollment"]??0;
        $this->id_teacher = $args["id_teacher"]??0;
        $this->teacher = $args["teacher"]??0;
    }
}