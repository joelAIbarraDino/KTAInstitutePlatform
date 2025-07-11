<?php

namespace App\Models;

use DinoEngine\Core\Model;

class AttemptView extends Model {
    
    protected static string $table = 'attempt_view';
    protected static array $columns = ['id_attempt', 'time', 'date', 'score', 'checked', 'is_approved', 'id_quiz', 'min_score', 'max_time', 'student', 'email'];

    public ?int $id_attempt;
    public float $time;
    public string $date;
    public float $score;
    public int $checked;
    public int $is_approved;
    public int $id_quiz;
    public float $min_score;
    public float $max_time;
    public string $student;
    public string $email;

    public function __construct($args = []){
        $this->id_attempt = $args["id_attempt"]??null;
        $this->time = $args["time"]??0.0;
        $this->date = $args["date"]??"";
        $this->score = $args["score"]??0.0;
        $this->checked = $args["checked"]??0;
        $this->is_approved = $args["is_approved"]??0;
        $this->id_quiz = $args["id_quiz"]??0;
        $this->min_score = $args["min_score"]??0;
        $this->max_time = $args["max_time"]??0;
        $this->student = $args["student"]??"";
        $this->email = $args["email"]??"";
    }

}