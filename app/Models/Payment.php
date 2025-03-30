<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Payment extends Model {
    
    protected static string $table = 'payment';
    protected static string $PK_name = 'id_payment';
    protected static array $columns = ['id_payment', 'method', 'amount', 'currency', 'status', 'id_transition'];
    protected static array $fillable = ['method', 'amount', 'currency', 'status', 'id_transition'];

    public ?int $id_payment;
    public string $method;
    public float $amount;
    public string $currency;
    public string $status;
    public int $id_transition;

    public const METHOD_PAYMENT =[
        'payPal'=>'payPal',
        'card'=>'card',
    ];

    public const ESTATUS_PAYMENT = [
        'completed'=>'completed',
        'in_progress'=>'in_progress',
        'rejected'=>'rejected',
    ];


    public function __construct($args = []){
        $this->id_payment = $args["id_payment"]??null;
        $this->method = $args["method"]??self::METHOD_PAYMENT['payPal'];
        $this->amount = $args["amount"]??0;
        $this->currency = $args["currency"]??"USD";
        $this->status = $args["status"]??self::ESTATUS_PAYMENT['in_progress'];
        $this->id_transition = $args["id_transition"]??0;

        
    }

    public function validate(){

    }
}