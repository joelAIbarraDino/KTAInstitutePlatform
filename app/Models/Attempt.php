<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Attempt extends Model {
    
    protected static string  $table = 'attempt';
    protected static string  $PK_name = 'id_attempt';
    protected static array $columns = ['id_attempt', 'time', 'score', 'is_approved', 'id_enrollment', 'id_quizz'];

    public ?int $id_attempt;
    public float $time;
    public float $score;
    public bool $is_approved;
    public int $id_enrollment;
    public int $id_quizz;

    public function __construct($args = []){
        $this->id_attempt = $args["id_attempt"]??null;
        $this->time = $args["time"]??"";
        $this->score = $args["score"]??"";
        $this->is_approved = $args["is_approved"]??false;
        $this->id_enrollment = $args["id_enrollment"]??0;
        $this->id_quizz = $args["id_quizz"]??0;
    }

    public function validate(){

    }
}