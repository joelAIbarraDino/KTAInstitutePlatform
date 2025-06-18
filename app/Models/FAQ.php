<?php

namespace App\Models;

use DinoEngine\Core\Model;
use DinoEngine\Http\Response;

class FAQ extends Model{
    
    protected static string $table = 'FAQ';
    protected static string $PK_name = 'id_FAQ';
    protected static array $columns = ['id_FAQ', 'question', 'answer', 'id_course'];
    protected static array $fillable = ['question', 'answer', 'id_course'];

    public ?int $id_FAQ;
    public string $question;
    public string $answer;
    public int $id_course;
    
    public function __construct($args = [])
    {
        $this->id_FAQ = $args['id_FAQ']??null;
        $this->question = $args['question']??"";
        $this->answer = $args['answer']??"";
        $this->id_course = $args['id_course']??0;
    }

    public function validateAPI():void{

        if(!$this->question)
            Response::json(['ok'=>false, 'message'=>'La pregunta es obligatoria'], 400);

        if(!$this->answer)
            Response::json(['ok'=>false, 'message'=>'La respuesta de la pregunta es obligatoria'], 400);

    }

}