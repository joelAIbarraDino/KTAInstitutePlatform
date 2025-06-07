<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Lesson extends Model {
    
    protected static string $table = 'lesson';
    protected static string $PK_name = 'id_lesson';
    protected static array $columns = ['id_lesson', 'name', 'description', 'id_video', 'order_lesson', 'id_module'];
    protected static array $fillable = ['name', 'description', 'order_lesson'];

    public ?int $id_lesson;
    public string $name;
    public string $description;
    public string $id_video;
    public int $order_lesson;
    public string $id_module;
    public string $clave;

    public function __construct($args = []){
        $this->id_lesson = $args["id_lesson"]??null;
        $this->name = $args["name"]??"";
        $this->description = $args["description"]??"";
        $this->id_video = $args["id_video"]??"";
        $this->order_lesson = $args["order_lesson"]??0;
        $this->id_module = $args["id_module"]??null;
        $this->clave = $args["clave"]??null;
    }

    public function validate(){

    }
}