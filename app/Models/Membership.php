<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Membership extends Model {
    
    protected static string $table = 'membership';
    protected static string $PK_name = 'id_membership';
    protected static array $columns = ['id_membership', 'start_at', 'ends_at', 'type', 'id_payment'];
    protected static array $fillable = ['start_at', 'ends_at', 'type'];

    public ?int $id_membership;
    public string $start_at;
    public string $ends_at;
    public string $type;
    public int $id_payment;

    public function __construct($args = []){
        $this->id_membership = $args["id_membership"]??null;
        $this->start_at = $args["start_at"]??"";
        $this->ends_at = $args["ends_at"]??"";
        $this->type = $args["type"]??"";
        $this->id_payment = $args["id_payment"]??0;
    }

    public function validate(){

    }
}