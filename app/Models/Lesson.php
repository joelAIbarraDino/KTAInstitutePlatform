<?php

namespace App\Models;

use DinoEngine\Core\Model;
use DinoEngine\Http\Response;

class Lesson extends Model {
    
    protected static string $table = 'lesson';
    protected static string $PK_name = 'id_lesson';
    protected static array $columns = ['id_lesson', 'name', 'description', 'id_video', 'order_lesson', 'id_module'];
    protected static array $fillable = ['name', 'description', 'id_video', 'order_lesson'];

    public ?int $id_lesson;
    public string $name;
    public string $description;
    public int $id_video;
    public int $order_lesson;
    public int $id_module;

    public function __construct($args = []){
        $this->id_lesson = $args["id_lesson"]??null;
        $this->name = $args["name"]??"";
        $this->description = $args["description"]??"";
        $this->id_video = $args["id_video"]??0;
        $this->order_lesson = $args["order_lesson"]??0;
        $this->id_module = $args["id_module"]??0;
    }

    public function validateAPI(){

        if(!$this->name)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar un nombre a la lección'], 400);

        if(!$this->description)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar la descripción de la lección'], 400);

        if(!$this->id_video)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar el ID del video'], 400);

        if(!$this->order_lesson)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar el orden de la lección'], 400);

        if(!$this->id_module)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar a que modulo pertenece'], 400);

    }
}