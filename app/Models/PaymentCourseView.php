<?php

namespace App\Models;

use DinoEngine\Core\Model;

class PaymentCourseView extends Model {
    
    protected static string $table = 'payment_course_view';
    protected static array $columns = ['id_enrollment', 'thumbnail', 'id_student', 'name', 'photo', 'student', 'email', 'phone', 'street', 'number_street', 'state', 'cp', 'id_payment', 'amount', 'currency', 'method', 'created_at', 'status', 'stripe_id'];

    public ?int $id_enrollment;
    public string $thumbnail;
    public string $name;
    public ?string $photo;
    public int $id_student;
    public string $student;
    public string $email;
    public string $phone;
    public ?string $street;
    public ?string $number_street;
    public ?string $state;
    public ?string $cp;
    public int $id_payment;
    public float $amount;
    public string $currency;
    public string $method;
    public string $created_at;
    public string $status;
    public string $stripe_id;
    
    public function __construct($args = []){
        $this->id_enrollment = $args["id_enrollment"]??null;
        $this->thumbnail = $args["thumbnail"]??"";
        $this->id_student = $args["id_student"]??0;
        $this->name = $args["name"]??"";
        $this->photo = $args["photo"]??"";
        $this->student = $args["student"]??"";
        $this->email = $args["email"]??"";
        $this->phone = $args['phone']??"";
        $this->street = $args['street']??null;
        $this->number_street = $args['number_street']??null;
        $this->state = $args['state']??null;
        $this->cp = $args['cp']??null;
        $this->id_payment = $args["id_payment"]??0;
        $this->amount = $args["amount"]??0;
        $this->currency = $args["currency"]??"";
        $this->method = $args["method"]??"";
        $this->created_at = $args["created_at"]??"";
        $this->status = $args["status"]??"";
        $this->stripe_id = $args["stripe_id"]??"";
    }

}