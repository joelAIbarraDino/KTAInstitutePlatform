<?php

namespace App\Models;

use DinoEngine\Core\Model;
use DinoEngine\Http\Response;

class Attempt extends Model {
    
    protected static string  $table = 'attempt';
    protected static string  $PK_name = 'id_attempt';
    protected static array $columns = ['id_attempt', 'date', 'time', 'score', 'checked', 'is_approved', 'id_enrollment', 'id_quiz'];

    public ?int $id_attempt;
    public float $time;
    public string $date;
    public float $score;
    public int $checked;
    public int $is_approved;
    public int $id_enrollment;
    public int $id_quiz;

    public function __construct($args = []){
        $this->id_attempt = $args["id_attempt"]??null;
        $this->time = $args["time"]??0.0;
        $this->date = $args["date"]??date('Y-m-d');
        $this->score = $args["score"]??0.0;
        $this->checked = $args["checked"]??0;
        $this->is_approved = $args["is_approved"]??0;
        $this->id_enrollment = $args["id_enrollment"]??0;
        $this->id_quiz = $args["id_quiz"]??0;
    }

    public function validateAPI(){
        if(!$this->id_enrollment)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar a que inscripcion pertenece'], 400);

        if(!$this->id_quiz)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar a que quiz pertenece'], 400);

    }
}