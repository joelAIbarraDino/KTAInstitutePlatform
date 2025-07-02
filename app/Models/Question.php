<?php

namespace App\Models;

use DinoEngine\Core\Model;
use DinoEngine\Http\Response;

class Question extends Model {
    
    protected static string $table = 'question';
    protected static string $PK_name = 'id_question';
    protected static array $columns = ['id_question', 'question', 'type_question', 'id_quiz'];
    protected static array $fillable = ['question', 'type_question', 'id_quiz'];

    public ?int $id_question;
    public string $question;
    public string $type_question;
    public int $id_quiz;

    public function __construct($args = []){
        $this->id_question = $args["id_question"]??null;
        $this->question = $args["question"]??"";
        $this->type_question = $args["type_question"]??"";
        $this->id_quiz = $args["id_quiz"]??0;
    }

    public function validateAPI(){
        if(!$this->question)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar una pregunta valida'], 400);

        if(!$this->type_question)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar el tipo de pregunta'], 400);

        if(!$this->id_quiz)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar a que quiz pertenece la pregunta'], 400);
    }
}