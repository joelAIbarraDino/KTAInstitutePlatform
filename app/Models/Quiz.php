<?php

namespace App\Models;

use DinoEngine\Core\Model;
use DinoEngine\Http\Response;

class Quiz extends Model {
    
    protected static string $table = 'quiz';
    protected static string $PK_name = 'id_quiz';
    protected static array $columns = ['id_quiz', 'name', 'tutorial_id', 'quiz_mode', 'show_answers', 'min_score', 'max_time', 'max_attempts', 'id_course'];
    protected static array $fillable = ['name', 'tutorial_id', 'quiz_mode', 'show_answers', 'min_score', 'max_time', 'max_attempts', 'id_course'];

    public ?int $id_quiz;
    public string $name;
    public int $tutorial_id;
    public string $quiz_mode;
    public string $show_answers;
    public float $min_score;
    public float $max_time;
    public int $max_attempts;
    public int $id_course;

    public function __construct($args = []){
        $this->id_quiz = $args["id_quiz"]??null;
        $this->name = $args["name"]??"";
        $this->tutorial_id = $args["tutorial_id"]??0;
        $this->quiz_mode = $args["quiz_mode"]??"";
        $this->show_answers = $args["show_answers"]??"";
        $this->min_score = $args["min_score"]??80.0;
        $this->max_time = $args["max_time"]??180;
        $this->max_attempts = $args["max_attempts"]??3;
        $this->id_course = $args["id_course"]??0;
    }

    public function validateAPI(){
        if(!$this->name)
            Response::json(['ok'=>false, 'message'=>'El nombre del quiz es obligatorio'], 400);

        if(!$this->quiz_mode)
            Response::json(['ok'=>false, 'message'=>'El modol del quiz es obligatorio'], 400);

        if($this->min_score < 1 || $this->min_score > 100)
            Response::json(['ok'=>false, 'message'=>'El score debe estar en el rango de (1 - 100)'], 400);

        if($this->max_time < 1)
            Response::json(['ok'=>false, 'message'=>'El tiempo maximo no puede ser negativo'], 400);

        if($this->max_attempts < 1)
            Response::json(['ok'=>false, 'message'=>'El numero de intentos no puede ser negativo'], 400);

        if(!$this->tutorial_id)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar el ID del video en Vimeo del tutorial'], 400);

        if(!$this->id_course)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar a que curso pertenece'], 400);

    }
}