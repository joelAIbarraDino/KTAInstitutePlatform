<?php

use DinoEngine\Core\Model;

class Category extends Model {
    
    protected static $table = 'category';
    protected static $PK_name = 'id_category';
    protected static $columns = ['id_category', 'name'];
    protected static $fillable = ['name'];

    public ?int $id_category;
    public string $name;

    public function __construct($args = []){
        $this->id_category = $args["id_category"]??null;
        $this->name = $args["name"]??"";
    }

    public function validate(){

    }
}