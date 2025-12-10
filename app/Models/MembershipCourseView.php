<?php

namespace App\Models;

use DinoEngine\Core\Model;

class MembershipCourseView extends Model {
    
    protected static string $table = 'membership_course_view';
    protected static array $columns = ['id_membership_course', 'name', 'id_membership', 'id_course', 'type'];

    public ?int $id_membership_course;
    public string $name;
    public int $id_membership;
    public int $id_course;
    public string $type;
    
    public function __construct($args = []){
        $this->id_membership_course = $args["id_membership_course"]??null;
        $this->type = $args["type"]??"";
        $this->id_membership = $args["id_membership"]??0;
        $this->id_course = $args["id_course"]??0;
        $this->type = $args["type"]??"";
    }

}