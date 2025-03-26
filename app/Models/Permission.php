<?php

namespace App\Model;

use DinoEngine\Core\Model;

class Permission extends Model{
    
    protected static $table = 'permission';
    protected static $PK_name = 'id_permission';
    protected static $columns = ['id_permission', 'nivel'];
    protected static $fillable = ['nivel'];

    public ?int $id_permission;
    public string $nivel;

    public function __construct($args = [])
    {
        $this->id_permission = $args['id_permission']??null;
        $this->nivel = $args['nivel']??'';
    }

    public function validate(){
         
    }
}