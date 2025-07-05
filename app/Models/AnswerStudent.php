<?php

namespace App\Models;

use DinoEngine\Core\Model;

class AnswerStudent extends Model {
    
    protected static string $table = 'answer_student';
    protected static string $PK_name = 'id_answer';
    protected static array $columns = ['id_answer', 'id_attempt', 'type_question', 'question', 'answer', 'is_correct'];
    protected static array $nulleable = ['type_column', 'answer'];

    public ?int $id_answer;
    public int $id_attempt;
    public string $type_question;
    public ?string $question;
    public ?string $answer;
    public int $is_correct;

    public function __construct($args = []){
        $this->id_answer = $args["id_answer"]??null;
        $this->id_attempt = $args["id_attempt"]??0;
        $this->type_question = $args["type_question"]??"";
        $this->question = $args["question"]??null;
        $this->answer = $args["answer"]??null;
        $this->is_correct = $args["is_correct"]??0;
    }
}