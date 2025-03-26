<?php

use DinoEngine\Core\Model;

class Material extends Model {
    
    protected static $table = 'material';
    protected static $PK_name = 'id_material';
    protected static $columns = ['id_material', 'type', 'url_file', 'id_lesson'];
    protected static $fillable = ['type', 'url_file'];

    public ?int $id_material;
    public string $type;
    public string $url_file;
    public int $id_lesson;

    public function __construct($args = []){
        $this->id_material = $args["id_material"]??null;
        $this->type = $args["type"]??"";
        $this->url_file = $args["url_file"]??"";
        $this->id_lesson = $args["id_lesson"]??0;
    }

    public function validate(){

    }
}