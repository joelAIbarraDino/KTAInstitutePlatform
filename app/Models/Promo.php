<?php

use DinoEngine\Core\Model;

class Promo extends Model {
    
    protected static $table = 'promo';
    protected static $PK_name = 'id_promo';
    protected static $columns = ['id_promo', 'discount', 'promo_ends'];
    protected static $fillable = ['discount', 'promo_ends'];


    public ?int $id_promo;
    public float $discount;
    public string $promo_ends;

    public function __construct($args = []){
        $this->id_promo = $args["id_promo"]??null;
        $this->discount = $args["discount"]??0.0;
        $this->promo_ends = $args["promo_ends"]??"";
    }

    public function validate(){

    }
}