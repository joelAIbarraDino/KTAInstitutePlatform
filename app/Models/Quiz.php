<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Quiz extends Model {
    
    protected static string $table = 'quiz';
    protected static string $PK_name = 'id_quiz';
    protected static array $columns = ['id_quiz', 'name', 'min_score', 'max_time', 'max_attempts', 'id_course'];
    protected static array $fillable = ['name', 'min_score', 'max_time', 'max_attempts'];

    public ?int $id_quiz;
    public string $name;
    public float $min_score;
    public float $max_time;
    public int $max_attempts;
    public int $id_course;

    public function __construct($args = []){
        $this->id_quiz = $args["id_quiz"]??null;
        $this->name = $args["name"]??"";
        $this->min_score = $args["min_score"]??80.0;
        $this->max_time = $args["max_time"]??180;
        $this->max_attempts = $args["max_attempts"]??3;
        $this->id_course = $args["id_course"]??0;
    }

    public function validate(){

    }
}