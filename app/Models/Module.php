<?php

namespace App\Models;

use DinoEngine\Core\Model;
use DinoEngine\Http\Response;

class Module extends Model {
    
    protected static string $table = 'module';
    protected static string $PK_name = 'id_module';
    protected static array $columns = ['id_module', 'name', 'order_module', 'id_course'];
    protected static array $fillable = ['name', 'order_module', 'id_course'];

    public ?int $id_module;
    public string $name;
    public int $order_module;
    public int $id_course;

    public function __construct($args = []){
        $this->id_module = $args["id_module"]??null;
        $this->name = $args["name"]??"";
        $this->order_module = $args["order_module"]??0;
        $this->id_course = $args["id_course"]??0;
    }

    public function validateAPI(){
        if(!$this->name)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar un nombre al modulo']);

        if(!$this->order_module)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar el orden del modulo']);

        if(!$this->id_course)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar a que curso pertenece']);
    }
}