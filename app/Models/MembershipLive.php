<?php

namespace App\Models;

use DinoEngine\Core\Model;
use DinoEngine\Http\Response;

class MembershipLive extends Model {
    
    protected static string $table = 'membership_live';
    protected static string $PK_name = 'id_membership_live';
    protected static array $columns = ['id_membership_live', 'id_membership', 'id_live'];
    protected static array $fillable = ['id_membership', 'id_live'];

    public ?int $id_membership_live;
    public int $id_membership;
    public int $id_live;

    public function __construct($args = []){
        $this->id_membership_live = $args["id_membership_live"]??null;
        $this->id_membership = $args["id_membership"]??0;
        $this->id_live = $args["id_live"]??0;
    }

    public function validateAPI(){

        if(!$this->id_membership)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar a que membresía pertenece'], 400);

        if(!$this->id_live)
            Response::json(['ok'=>false, 'message'=>'Debe ingresar la lección a agregar'], 400);

    }
}