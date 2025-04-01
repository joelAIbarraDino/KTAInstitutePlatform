<?php

namespace App\Models;

use DinoEngine\Core\Model;
use DinoEngine\Http\Response;

class Course extends Model {
    
    protected static string $table = 'course';
    protected static string $PK_name = 'id_course';
    protected static array $columns = [
        'id_course', 'name', 'watchword', 'thumbnail', 
        'description', 'price','discount', 'discount_ends', 
        'max_months_enroll', 'created_at', 
        'privacy', 'id_category', 'id_teacher'
    ];

    protected static array $fillable = [
        'name', 'watchword', 'thumbnail', 
        'description', 'price','discount', 'discount_ends', 
        'max_months_enroll', 
        'privacy', 'id_category', 'id_teacher'
    ];
    protected static array $nulleable = ['discount', 'discount_ends'];

    public ?int $id_course;
    public string $name;
    public string $watchword;
    public string $thumbnail;
    public string $description;
    public float $price;
    public ?float $discount;
    public ?string $discount_ends;
    public int $max_months_enroll;
    public string $created_at;
    public int $privacy;
    public int $id_category;
    public int $id_teacher;

    public const PRIVACY = [
        'borrador'=>0,
        'privado'=>1,
        'publico'=>2
    ];

    public function __construct($args = []){

        $this->id_course = $args["id_course"]??null;
        $this->name = $args["name"]??"";
        $this->watchword = $args["watchword"]??"";
        $this->thumbnail = $args["thumbnail"]??"";
        $this->description = $args["description"]??"";
        $this->price = $args["price"]??0.0;
        $this->discount = $args["discount"]??null;
        $this->discount_ends = $args["discount_ends"]??null;
        $this->max_months_enroll = $args["max_months_enroll"]??0;
        $this->created_at = $args["created_at"]??date('Y-m-d');
        $this->privacy = $args["privacy"]??self::PRIVACY['borrador'];
        $this->id_category = $args["id_category"]??0;
        $this->id_teacher = $args["id_teacher"]??0;
    }

    public function validate():array{
        if(!$this->name)
            self::setAlerts("name", "debe ingresar el nombre del curso");
        
        if(!$this->watchword)
            self::setAlerts("watchword", "debe ingresar un lema al curso");

        if(!$this->description)
            self::setAlerts("description", "debe ingresar una descripción");

        if(!$this->price)
            self::setAlerts("price", "debe ingresar el precio del curso");

        if($this->discount && !$this->discount_ends)
            self::setAlerts("discount_ends", "la fecha de fin de promoción es obligatorio");

        if(!$this->discount && $this->discount_ends)
            self::setAlerts("discount", "el descuento es obligatorio");

        if(!$this->max_months_enroll)
            self::setAlerts("watchword", "debe ingresar el maximo de meses para ver el curso");

        if(!$this->id_category)
            self::setAlerts("watchword", "debe seleccionar una categoria");

        if(!$this->id_teacher)
            self::setAlerts("watchword", "debe seleccionar un maestro");

        return self::$alerts;
    }

    public function validateFile(?array $file):array{
        
        if(!isset($file['thumbnail'])){
            self::setAlerts('thumbnail', "debe ingresar la caratula del curso");
            return self::$alerts;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        
        
        if (!in_array($file['thumbnail']['type'], $allowedTypes))
            self::setAlerts('thumbnail', "Solo se permiten imágenes (JPEG, PNG, GIF)");
        
        return self::$alerts;
    }

    public function saveFile(array $file){
        //genero un nombre a la caratula
        $fileName = uniqid() . '-' . basename($file['thumbnail']['name']);
        $targetPath = DIR_CARATULAS.$fileName;
        
        //si no existe la carpeta se crea una nueva carpeta
        if(!is_dir(DIR_CARATULAS))
            mkdir(DIR_CARATULAS);

        //se mueve el archivo, en caso de que no se guarda en servidor se configura una nueva alerta
        if(!move_uploaded_file($file['thumbnail']['tmp_name'], $targetPath))
            Response::json(['thumbnail'=>"ocurrió un error al guardar la imagen, intente mas tarde"]);

        $this->thumbnail = $fileName;
    }

}