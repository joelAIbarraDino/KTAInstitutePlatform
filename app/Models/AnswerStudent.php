<?php

use DinoEngine\Core\Model;

class AnswerStudent extends Model {
    
    protected static $table = 'answer_student';
    protected static $PK_name = 'id_answer';
    protected static $columns = ['id_answer', 'id_attempt', 'id_question', 'id_option'];

    public ?int $id_answer;
    public int $id_attempt;
    public int $id_question;
    public int $id_option;

    public function __construct($args = []){
        $this->id_answer = $args["id_answer"]??null;
        $this->id_attempt = $args["id_attempt"]??0;
        $this->id_question = $args["id_question"]??0;
        $this->id_option = $args["id_option"]??0;
    }

    public function validate(){

    }
}