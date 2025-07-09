<?php

namespace App\Models;

use DinoEngine\Core\Model;

class MembershipStudent extends Model {
    
    protected static string $table = 'membershipStudent';
    protected static string $PK_name = 'id_membership_student';
    protected static array $columns = ['id_membership_student', 'id_membership', 'id_student', 'created_at', 'id_payment'];
    protected static array $fillable = ['id_membership', 'id_student', 'created_at', 'id_payment'];

    public ?int $id_membership_student;
    public int $id_membership;
    public int $id_student;
    public string $created_at;
    public int $id_payment;

    public function __construct($args = []){
        $this->id_membership_student = $args["id_membership_student"]??null;
        $this->id_membership = $args["id_membership"]??0;
        $this->id_student = $args["id_student"]??0;
        $this->created_at = date('Y-m-d');
        $this->id_payment = $args["id_payment"]??0;
    }

}