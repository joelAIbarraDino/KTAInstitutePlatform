<?php

namespace App\Model;

use DinoEngine\Core\Model;

class Teacher extends Model{
    
    protected static $table = 'teacher';
    protected static $PK_name = 'id_teacher';
    protected static $columns = ['id_teacher', 'id_user', 'photo', 'speciality', 'experience', 'bio'];
    protected static $fillable = ['photo', 'speciality', 'experience', 'bio'];

    public ?int $id_teacher;
    public int $id_user;
    public string $photo;
    public string $speciality;
    public int $experience;
    public string $bio;

    public function __construct($args = [])
    {
        $this->id_teacher = $args['id_teacher']??null;
        $this->id_user = $args['id_user']??0;
        $this->photo = $args['photo']??'';
        $this->speciality = $args['speciality']??'';
        $this->experience = $args['experience']??0;
        $this->bio = $args['bio']??'';
    }

    public function validate(){
        
    }
}