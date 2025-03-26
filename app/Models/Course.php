<?php

use DinoEngine\Core\Model;

class Course extends Model {
    
    protected static $table = 'course';
    protected static $PK_name = 'id_course';
    protected static $columns = [
        'id_course', 'name', 'watchword', 'thumbnail', 
        'description', 'price', 'max_months_enroll',
        'id_category', 'id_promo', 'id_teacher'
    ];

    protected static $fillable = [
        'name', 'watchword', 'thumbnail', 
        'description', 'price', 'max_months_enroll',
        'id_category', 'id_promo', 'id_teacher'
    ];
    protected static $nullable = ['id_promo'];

    public ?int $id_course;
    public string $name;
    public string $watchword;
    public string $thumbnail;
    public string $description;
    public float $price;
    public int $max_months_enroll;
    public int $id_category;
    public int $id_promo;
    public int $id_teacher;

    public function __construct($args = []){
        $this->id_course = $args["id_course"]??null;
        $this->name = $args["name"]??"";
        $this->watchword = $args["watchword"]??"";
        $this->thumbnail = $args["thumbnail"]??"";
        $this->description = $args["description"]??"";
        $this->price = $args["price"]??0.0;
        $this->max_months_enroll = $args["max_months_enroll"]??0;
        $this->id_category = $args["id_category"]??0;
        $this->id_promo = $args["id_promo"]??0;
        $this->id_teacher = $args["id_teacher"]??0;
    }

    public function validate(){

    }
}