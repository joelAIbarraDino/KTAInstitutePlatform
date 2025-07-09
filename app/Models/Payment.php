<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Payment extends Model {
    
    protected static string $table = 'payment';
    protected static string $PK_name = 'id_payment';
    protected static array $columns = ['id_payment', 'amount', 'currency', 'status','created_at', 'stripe_id'];
    protected static array $fillable = ['amount', 'currency', 'status', 'stripe_id'];

    public ?int $id_payment;
    public float $amount;
    public string $currency;
    public string $status;
    public string $created_at;
    public string $stripe_id;

    public function __construct($args = []){
        $this->id_payment = $args["id_payment"]??null;
        $this->amount = $args["amount"]??0;
        $this->currency = $args["currency"]??"USD";
        $this->status = $args["status"]??"pendiente";
        $this->created_at = $args["stripcreated_ate_id"]??date("Y-m-d H:i:s");;
        $this->stripe_id = $args["stripe_id"]??"";

        
    }

    public function validate(){

    }
}