<?php

namespace App\Models;

use DinoEngine\Core\Model;

class PaymentLiveView extends Model {
    
    protected static string $table = 'payment_live_view';
    protected static array $columns = ['id_student_live', 'id_student', 'student', 'email', 'phone', 'id_live', 'live'];

    public ?int $id_student_live;
    public int $id_student;
    public string $student;
    public string $email;
    public string $phone;
    public int $id_live;
    public string $live;
    
    public function __construct($args = []){
        $this->id_student_live = $args["id_student_live"]??null;
        $this->id_student = $args["id_student"]??0;
        $this->student = $args["student"]??"";
        $this->email = $args["email"]??"";
        $this->phone = $args['phone']??"";
        $this->id_live = $args["id_live"]??0;
        $this->live = $args["live"]??"";

    }

}