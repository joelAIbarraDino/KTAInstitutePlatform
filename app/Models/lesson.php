<?php

use DinoEngine\Core\Model;

class Lesson extends Model {
    
    protected static $table = 'lesson';
    protected static $PK_name = 'id_lesson';
    protected static $columns = ['id_lesson', 'name', 'description', 'id_video', 'order', 'id_module'];
    protected static $fillable = ['name', 'description', 'order'];

    public ?int $id_lesson;
    public string $name;
    public string $description;
    public string $id_video;
    public int $order;
    public string $id_module;
    public string $clave;

    public function __construct($args = []){
        $this->id_lesson = $args["id_lesson"]??null;
        $this->name = $args["name"]??"";
        $this->description = $args["description"]??"";
        $this->id_video = $args["id_video"]??"";
        $this->order = $args["order"]??0;
        $this->id_module = $args["id_module"]??null;
        $this->clave = $args["clave"]??null;
    }

    public function validate(){

    }
}