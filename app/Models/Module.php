<?php

use DinoEngine\Core\Model;

class Module extends Model {
    
    protected static $table = 'module';
    protected static $PK_name = 'id_module';
    protected static $columns = ['id_module', 'name', 'order', 'id_course'];
    protected static $fillable = ['name', 'order'];

    public ?int $id_module;
    public string $name;
    public int $order;
    public string $id_course;

    public function __construct($args = []){
        $this->id_module = $args["id_module"]??null;
        $this->order = $args["order"]??0;
        $this->name = $args["name"]??"";
        $this->id_course = $args["id_course"]??0;
    }

    public function validate(){

    }
}