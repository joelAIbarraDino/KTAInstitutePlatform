<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Membership extends Model {
    
    protected static string $table = 'membership';
    protected static string $PK_name = 'id_membership';
    protected static array $columns = ['id_membership', 'type', 'max_time_membership', 'price', 'caract'];
    protected static array $fillable = ['type', 'max_time_membership', 'price', 'caract'];

    public ?int $id_membership;
    public string $type;
    public int $max_time_membership;
    public float $price;
    public string $caract;

    public function __construct($args = []){
        $this->id_membership = $args["id_membership"]??null;
        $this->type = $args["type"]??"";
        $this->max_time_membership = $args["max_time_membership"]??0;
        $this->price = $args["price"]??0.0;
        $this->caract = $args["caract"]??"";
    }

    public function validate():array{

        if(!$this->type)
            self::setAlerts('error', "el tipo de membresia es obligatoría");

        if(!$this->max_time_membership)
            self::setAlerts('error', "El acceso a la membresía es obligatoría");

        if(!$this->price)
            self::setAlerts('error', "El precio es obligatorio");
        
        if(strlen($this->caract) < 80)
            self::setAlerts('error', "La descripción debe ser mayor de 80 caracteres");

        return self::$alerts;
    }

}