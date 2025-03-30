<?php

namespace App\Models;

use DinoEngine\Core\Model;

class TeacherView extends Model{
    
    protected static string $table = 'teacher_view';
    protected static array $columns = ['id_teacher', 'id_user', 'name', 'photo', 'email', 'speciality', 'experience', 'bio'];

    public ?int $id_teacher;
    public ?int $id_user;
    public string $name;
    public string $photo;
    public string $email;
    public string $speciality;
    public int $experience;
    public string $bio;

    public function __construct($args = [])
    {
        $this->id_teacher = $args['id_teacher']??null;
        $this->id_user = $args['id_user']??null;
        $this->name = $args['name']??'';
        $this->photo = $args['photo']??'';
        $this->email = $args['email']??'';
        $this->speciality = $args['speciality']??'';
        $this->experience = $args['experience']??0;
        $this->bio = $args['bio']??'';
    }

    public function validate(){
        
    }
}