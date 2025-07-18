<?php

namespace App\Models;

use DinoEngine\Core\Model;

class PaymentMembershipView extends Model {
    
    protected static string $table = 'payment_membership_view';
    protected static array $columns = ['id_membership_student', 'type', 'photo', 'student', 'email', 'phone', 'street', 'number_street', 'state', 'cp', 'amount', 'currency', 'method', 'created_at', 'status', 'stripe_id'];

    public ?int $id_membership_student;
    public string $type;
    public string $photo;
    public ?string $student;
    public string $email;
    public string $phone;
    public string $street;
    public string $number_street;
    public string $state;
    public string $cp;
    public float $amount;
    public string $currency;
    public string $method;
    public string $created_at;
    public string $status;
    public string $stripe_id;
    
    public function __construct($args = []){
        $this->id_membership_student = $args["id_membership_student"]??null;
        $this->type = $args["type"]??"";
        $this->photo = $args["photo"]??"";
        $this->student = $args["student"]??"";
        $this->email = $args["email"]??"";
        $this->phone = $args['phone']??"";
        $this->street = $args['street']??"";
        $this->number_street = $args['number_street']??"";
        $this->state = $args['state']??"";
        $this->cp = $args['cp']??"";
        $this->amount = $args["amount"]??0.0;
        $this->currency = $args["currency"]??"";
        $this->method = $args["method"]??"";
        $this->created_at = $args["created_at"]??"";
        $this->status = $args["status"]??"";
        $this->stripe_id = $args["stripe_id"]??"";
    
    }

}