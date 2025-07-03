<?php

namespace App\Models;

use DinoEngine\Core\Model;
use DinoEngine\Http\Response;

class Attempt extends Model {
    
    protected static string  $table = 'attempt';
    protected static string  $PK_name = 'id_attempt';
    protected static array $columns = ['id_attempt', 'time', 'score', 'is_approved', 'id_enrollment', 'id_quizz'];

    public ?int $id_attempt;
    public float $time;
    public float $score;
    public int $is_approved;
    public int $id_enrollment;
    public int $id_quizz;

    public function __construct($args = []){
        $this->id_attempt = $args["id_attempt"]??null;
        $this->time = $args["time"]??0.0;
        $this->score = $args["score"]??0.0;
        $this->is_approved = $args["is_approved"]??0;
        $this->id_enrollment = $args["id_enrollment"]??0;
        $this->id_quizz = $args["id_quizz"]??0;
    }

    public function validateAPI(){
        if(!$this->id_enrollment)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar a que inscripcion pertenece'], 400);

        if(!$this->id_quizz)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar a que quiz pertenece'], 400);

    }
}