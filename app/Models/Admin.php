<?php

namespace App\Model;

use DinoEngine\Core\Model;

class Admin extends Model{
    
    protected static $table = 'admin';
    protected static $PK_name = 'id_admin';
    protected static $columns = ['id_admin', 'id_user', 'id_rol'];
    protected static $fillable = ['id_user', 'id_rol'];

    public ?int $id_admin;
    public int $id_user;
    public int $id_rol;

    public function __construct($args = [])
    {
        $this->id_admin = $args['id_admin']??null;
        $this->id_user = $args['id_user']??0;
        $this->id_rol = $args['id_rol']??0;
    }

    public function validate(){
        
    }
}