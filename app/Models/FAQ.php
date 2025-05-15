<?php

namespace App\Models;

use DinoEngine\Core\Model;

class FAQ extends Model{
    
    protected static string $table = 'FAQ';
    protected static string $PK_name = 'id_FAQ';
    protected static array $columns = ['id_FAQ', 'question', 'answer'];
    protected static array $fillable = ['question', 'answer'];

    public ?int $id_admin;
    public string $question;
    public string $answer;
    
    public function __construct($args = [])
    {
        $this->id_admin = $args['id_admin']??null;
        $this->question = $args['question']??"";
        $this->answer = $args['answer']??"";
    }

    public function validate():array{

        if(!$this->question)
            self::setAlerts('error', "La pregunta es obligatoria");

        if(!$this->answer)
            self::setAlerts('error', "La respuesta de la pregunta es obligatoria");

        return self::$alerts;
    }

}