<?php

use DinoEngine\Core\Model;

class Attempt extends Model {
    
    protected static $table = 'attempt';
    protected static $PK_name = 'id_attempt';
    protected static $columns = ['id_attempt', 'time', 'score', 'is_approved', 'id_enrollment', 'id_quizz'];

    public ?int $id_attempt;
    public float $time;
    public float $score;
    public bool $is_approved;
    public int $id_emn;
    public int $id_quizz;

    public function __construct($args = []){
        $this->id_attempt = $args["id_attempt"]??null;
        $this->time = $args["time"]??"";
        $this->score = $args["score"]??"";
        $this->is_approved = $args["is_approved"]??"";
        $this->id_emn = $args["id_emn"]??null;
        $this->id_quizz = $args["id_quizz"]??null;
    }

    public function validate(){

    }
}