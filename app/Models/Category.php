<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Category extends Model {
    
    protected static string $table = 'category';
    protected static string $PK_name = 'id_category';
    protected static array $columns = ['id_category', 'name'];
    protected static array $fillable = ['name'];

    public ?int $id_category;
    public string $name;

    public function __construct($args = []){
        $this->id_category = $args["id_category"]??null;
        $this->name = $args["name"]??"";
    }

    public function validate(){

    }
}