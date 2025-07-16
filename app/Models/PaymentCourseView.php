<?php

namespace App\Models;

use DinoEngine\Core\Model;

class PaymentCourseView extends Model {
    
    protected static string $table = 'payment_course_view';
    protected static array $columns = ['id_enrollment', 'thumbnail', 'name', 'photo', 'student', 'email', 'phone', 'street', 'number_street', 'state', 'cp', 'amount', 'currency', 'method', 'created_at', 'status', 'stripe_id'];

    public ?int $id_enrollment;
    public string $thumbnail;
    public string $name;
    public ?string $photo;
    public string $student;
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
        $this->id_enrollment = $args["id_enrollment"]??null;
        $this->thumbnail = $args["thumbnail"]??"";
        $this->name = $args["name"]??"";
        $this->photo = $args["photo"]??"";
        $this->student = $args["student"]??"";
        $this->email = $args["email"]??"";
        $this->phone = $args['phone']??"";
        $this->street = $args['street']??"";
        $this->number_street = $args['number_street']??"";
        $this->state = $args['state']??"";
        $this->cp = $args['cp']??"";
        $this->amount = $args["amount"]??0;
        $this->currency = $args["currency"]??"";
        $this->method = $args["method"]??"";
        $this->created_at = $args["created_at"]??"";
        $this->status = $args["status"]??"";
        $this->stripe_id = $args["stripe_id"]??"";
    }

}