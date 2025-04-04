<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Admin extends Model{
    
    protected static string $table = 'admin';
    protected static string $PK_name = 'id_admin';
    protected static array $columns = ['id_admin', 'name', 'pasword', 'url', 'token'];
    protected static array $fillable = ['name', 'pasword', 'url', 'token'];

    public ?int $id_admin;
    public string $name;
    public string $password;
    public ?string $url;
    public ?string $token;

    public function __construct($args = [])
    {
        $this->id_admin = $args['id_admin']??null;
        $this->name = $args['name']??"";
        $this->password = $args['password']??"";
        $this->url = $args['url']??null;
        $this->token = $args['token']??null;
    }

    public function validate(){
        
    }
}