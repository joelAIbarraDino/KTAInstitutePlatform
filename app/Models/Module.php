<?php

use DinoEngine\Core\Model;

class Module extends Model {
    
    protected static $table = 'module';
    protected static $PK_name = 'id_module';
    protected static $columns = ['id_module', 'name', 'order_module', 'id_course'];
    protected static $fillable = ['name', 'order_module'];

    public ?int $id_module;
    public string $name;
    public int $order_module;
    public string $id_course;

    public function __construct($args = []){
        $this->id_module = $args["id_module"]??null;
        $this->order_module = $args["order_module"]??0;
        $this->name = $args["name"]??"";
        $this->id_course = $args["id_course"]??0;
    }

    public function validate(){

    }
}