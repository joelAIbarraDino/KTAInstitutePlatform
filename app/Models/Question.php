<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Question extends Model {
    
    protected static string $table = 'question';
    protected static string $PK_name = 'id_question';
    protected static array $columns = ['id_question', 'question', 'max_points', 'id_quizz'];
    protected static array $fillable = ['question', 'max_points'];

    public ?int $id_question;
    public string $question;
    public float $max_points;
    public float $id_quizz;

    public function __construct($args = []){
        $this->id_question = $args["id_question"]??null;
        $this->question = $args["question"]??"";
        $this->max_points = $args["max_points"]??1;
        $this->id_quizz = $args["id_quizz"]??0;
    }

    public function validate(){

    }
}