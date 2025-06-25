<?php

namespace App\Models;

use DinoEngine\Core\Model;

class OptionQuestion extends Model {
    
    protected static string $table = 'option_question';
    protected static string $PK_name = 'id_option';
    protected static array $columns = ['id_option', 'text_option', 'is_correct', 'id_question'];
    protected static array $fillable = ['text_option', 'is_correct'];

    public ?int $id_option;
    public string $text_option;
    public bool $is_correct;
    public int $id_question;

    public function __construct($args = []){
        $this->id_option = $args["id_option"]??null;
        $this->text_option = $args["text_option"]??"";
        $this->is_correct = $args["is_correct"]??false;
        $this->id_question = $args["id_question"]??0;
    }

    public function validate(){

    }
}