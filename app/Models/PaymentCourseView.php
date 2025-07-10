<?php

namespace App\Models;

use DinoEngine\Core\Model;

class PaymentCourseView extends Model {
    
    protected static string $table = 'payment_course_view';
    protected static array $columns = ['id_enrollment', 'thumbnail', 'name', 'photo', 'student', 'email', 'amount', 'currency', 'created_at', 'status', 'stripe_id'];

    public ?int $id_enrollment;
    public string $thumbnail;
    public string $name;
    public ?string $photo;
    public string $student;
    public string $email;
    public float $amount;
    public string $currency;
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
        $this->amount = $args["amount"]??0;
        $this->currency = $args["currency"]??"";
        $this->created_at = $args["created_at"]??"";
        $this->status = $args["status"]??"";
        $this->stripe_id = $args["stripe_id"]??"";
    }

}