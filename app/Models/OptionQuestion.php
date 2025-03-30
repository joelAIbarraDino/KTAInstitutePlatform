<?php

namespace App\Models;

use DinoEngine\Core\Model;

class OptionQuestion extends Model {
    
    protected static string $table = 'option_question';
    protected static string $PK_name = 'id_option';
    protected static array $columns = ['id_option', 'text_option', 'point', 'id_question'];
    protected static array $fillable = ['text_option', 'point'];

    public ?int $id_option;
    public string $text_option;
    public float $point;
    public int $id_question;

    public function __construct($args = []){
        $this->id_option = $args["id_option"]??null;
        $this->text_option = $args["text_option"]??"";
        $this->point = $args["point"]??0;
        $this->id_question = $args["id_question"]??0;
    }

    public function validate(){

    }
}