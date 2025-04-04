<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Teacher extends Model{
    
    protected static string $table = 'teacher';
    protected static string $PK_name = 'id_teacher';
    protected static array $columns = ['id_teacher', 'name', 'password', 'photo', 'speciality', 'experience', 'bio', 'url', 'clave'];
    protected static array $fillable = ['name', 'password', 'photo', 'speciality', 'experience', 'bio', 'url', 'clave'];

    public ?int $id_teacher;
    public string $name;
    public string $password;
    public string $photo;
    public string $speciality;
    public int $experience;
    public string $bio;
    public ?string $url;
    public ?string $clave;

    public function __construct($args = [])
    {
        $this->id_teacher = $args['id_teacher']??null;
        $this->name = $args['name']??'';
        $this->password = $args['password']??'';
        $this->photo = $args['photo']??'';
        $this->speciality = $args['speciality']??'';
        $this->experience = $args['experience']??0;
        $this->bio = $args['bio']??'';
        $this->url = $args['url']??null;
        $this->clave = $args['clave']??null;
    }

    public function validate(){
        
    }
}