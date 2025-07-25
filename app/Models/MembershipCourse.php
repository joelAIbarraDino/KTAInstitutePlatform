<?php

namespace App\Models;

use DinoEngine\Core\Model;
use DinoEngine\Http\Response;

class MembershipCourse extends Model {
    
    protected static string $table = 'membership_course';
    protected static string $PK_name = 'id_membership_course';
    protected static array $columns = ['id_membership_course', 'id_membership', 'id_course'];
    protected static array $fillable = ['id_membership', 'id_course'];

    public ?int $id_membership_course;
    public int $id_membership;
    public int $id_course;

    public function __construct($args = []){
        $this->id_membership_course = $args["id_membership_course"]??null;
        $this->id_membership = $args["id_membership"]??0;
        $this->id_course = $args["id_course"]??0;
    }

    public function validateAPI(){

        if(!$this->id_membership)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar a que membresía pertenece'], 400);

        if(!$this->id_course)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar la lección a agregar'], 400);

    }
}