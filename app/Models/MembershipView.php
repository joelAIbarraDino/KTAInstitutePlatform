<?php

namespace App\Models;

use DinoEngine\Core\Model;

class MembershipView extends Model {
    
    protected static string $table = 'membership_view';
    protected static array $columns = ['id_membership', 'type', 'max_time_membership', 'created_at', 'id_payment', 'id_student', 'student', 'email'];

    public ?int $id_membership;
    public string $type;
    public int $max_time_membership;
    public string $created_at;
    public ?int $id_payment;
    public int $id_student;
    public string $student;
    public string $email;
    
    public function __construct($args = []){
        $this->id_membership = $args["id_membership"]??null;
        $this->type = $args["type"]??"";
        $this->max_time_membership = $args["max_time_membership"]??0;
        $this->created_at = $args["created_at"]??"";
        $this->id_payment = $args["id_payment"]??0;
        $this->id_student = $args["id_student"]??0;
        $this->student = $args["student"]??"";
        $this->email = $args["email"]??"";
    }

}