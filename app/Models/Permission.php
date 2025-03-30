<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Permission extends Model{
    
    protected static string $table = 'permission';
    protected static string $PK_name = 'id_permission';
    protected static array $columns = ['id_permission', 'nivel'];
    protected static array $fillable = ['nivel'];

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