<?php

namespace App\Models;

use DinoEngine\Core\Model;

class PaymentMembershipView extends Model {
    
    protected static string $table = 'payment_membership_view';
    protected static array $columns = ['id_membership_student', 'type', 'photo', 'student', 'email', 'amount', 'currency', 'created_at', 'status', 'stripe_id'];

    public ?int $id_membership_student;
    public string $type;
    public string $photo;
    public ?string $student;
    public string $email;
    public float $amount;
    public string $currency;
    public string $created_at;
    public string $status;
    public string $stripe_id;
    
    public function __construct($args = []){
        $this->id_membership_student = $args["id_membership_student"]??null;
        $this->type = $args["type"]??"";
        $this->photo = $args["photo"]??"";
        $this->student = $args["student"]??"";
        $this->email = $args["email"]??"";
        $this->amount = $args["amount"]??0.0;
        $this->currency = $args["currency"]??"";
        $this->created_at = $args["created_at"]??"";
        $this->status = $args["status"]??"";
        $this->stripe_id = $args["stripe_id"]??"";
    
    }

}