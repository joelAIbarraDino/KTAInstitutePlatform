<?php

namespace App\Models;

use DinoEngine\Classes\Storage;
use DinoEngine\Core\Model;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class Course extends Model {
    
    protected static string $table = 'course';
    protected static string $PK_name = 'id_course';
    protected static array $columns = [ 
        'id_course', 'name', 'watchword', 'thumbnail', 'background', 'description', 'details', 
        'price','discount', 'discount_ends_date', 'discount_ends_time', 
        'max_months_enroll', 'created_at', 'url', 
        'privacy', 'id_category', 'id_teacher'
    ];

    protected static array $fillable = [
        'name', 'watchword', 'thumbnail', 'background', 'description', 'details', 
        'price','discount', 'discount_ends_date', 'discount_ends_time',
        'max_months_enroll', 
        'privacy', 'id_category', 'id_teacher'
    ];
    protected static array $nulleable = ['discount', 'discount_ends_date', 'discount_ends_time', 'url'];

    public ?int $id_course;
    public string $name;
    public string $watchword;
    public string $background;
    public string $thumbnail;
    public string $description;
    public string $details;
    public float $price;
    public float $discount;
    public ?string $discount_ends_date;
    public ?string $discount_ends_time;
    public int $max_months_enroll;
    public string $created_at;
    public ?string $url;
    public string $privacy;
    public int $id_category;
    public int $id_teacher;

    public const PRIVACY = ['Editando', 'Privado', 'Público', 'Desactivado'];

    public function __construct($args = []){

        $this->id_course = $args["id_course"]??null;
        $this->name = $args["name"]??"";
        $this->watchword = $args["watchword"]??"";
        $this->background = $args["background"]??"";
        $this->thumbnail = $args["thumbnail"]??"";
        $this->description = $args["description"]??"";
        $this->details = $args["details"]??"";
        $this->price = $args["price"]??0.0;
        $this->discount = $args["discount"]??0;
        $this->discount_ends_date = $args["discount_ends_date"]??null;
        $this->discount_ends_time = $args["discount_ends_time"]??null;
        $this->max_months_enroll = $args["max_months_enroll"]??6;
        $this->created_at = $args["created_at"]??date('Y-m-d');
        $this->url = $args["url"]??null;
        $this->privacy = $args["privacy"]??self::PRIVACY[0];
        $this->id_category = $args["id_category"]??0;
        $this->id_teacher = $args["id_teacher"]??0;
    }

    public function validate():array{
        if(!$this->name)
            self::setAlerts("error", "Debe ingresar el nombre del curso");
        
        if(strlen($this->name) > 100)
            self::setAlerts("error", "El nombre debe tener menos de 100 caracteres");

        if(!$this->watchword)
            self::setAlerts("error", "Debe ingresar un lema al curso");

        if(strlen($this->watchword) > 200)
            self::setAlerts("error", "El lema debe tener menos de 200 caracteres");
        
        if(strlen($this->description) < 80)
            self::setAlerts("error", "La descripción debe tener mas de 80 caracteres");

        if(strlen($this->details) === 0)
            self::setAlerts("error", "El curso no tiene detalles agregados");

        if(!$this->price)
            self::setAlerts("error", "Debe ingresar el precio del curso");

        if($this->discount && (!$this->discount_ends_date || !$this->discount_ends_time))
            self::setAlerts("error", "La fecha y hora de fin de promoción es obligatorio");

        if(!$this->discount && ($this->discount_ends_date || $this->discount_ends_time))
            self::setAlerts("error", "El descuento es obligatorio");

        if(!$this->discount && !$this->discount_ends_date && !$this->discount_ends_time){
            $this->discount = 0;
            $this->discount_ends_date = null;
            $this->discount_ends_time = null;
        }
        
        if(!$this->max_months_enroll)
            self::setAlerts("error", "Debe ingresar el maximo de meses para ver el curso");

        if(!$this->id_category)
            self::setAlerts("error", "Debe seleccionar una categoria");

        if(!$this->id_teacher)
            self::setAlerts("error", "Debe seleccionar un maestro");

        return self::$alerts;
    }

    public function generateURL():void{
        $this->url = bin2hex(random_bytes(8));
    }

    public function validateFileThumbnail(?array $file):array{
        
        if(!isset($file['thumbnail'])){
            self::setAlerts('error', "Debe ingresar la caratula del curso");
            return self::$alerts;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                
        if (!in_array($file['thumbnail']['type'], $allowedTypes))
            self::setAlerts('error', "Solo se permiten imágenes en las caratulas (JPEG, PNG, GIF, WEBP)");
        
        return self::$alerts;
    }

    public function validateFileBackground(?array $file):array{
        
        if(!isset($file['background'])){
            self::setAlerts('error', "Debe ingresar el fondo del curso");
            return self::$alerts;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        
        if (!in_array($file['background']['type'], $allowedTypes))
            self::setAlerts('error', "Solo se permiten imágenes en el fondo del curso(JPEG, PNG, GIF, WEBP)");
        
        
        return self::$alerts;
    }

    public function uploadImageThumbnail(array $imagen, $ancho = null, $alto = null):void{   
        // Eliminar la imagen anterior si existe
        if ($this->thumbnail && Storage::exists(DIR_CARATULAS.'/'.$this->thumbnail))
            Storage::delete(DIR_CARATULAS.'/'.$this->thumbnail);
        
        // Generar un nombre único para la imagen
        $nombreImagen = Storage::uniqName(".png");
        
        // Procesar la imagen con Intervention Image
        $manager = new ImageManager(Driver::class);
        $processImage = $manager->read($imagen['tmp_name']);

        // Redimensionar si se especifican dimensiones
        if ($ancho && $alto)
            $processImage->cover($ancho, $alto);

        if(!is_dir(DIR_CARATULAS))
            mkdir(DIR_CARATULAS);
        
        $processImage->toPng()->save(DIR_CARATULAS.'/'.$nombreImagen);

        // Actualizar el atributo del modelo
        $this->thumbnail = $nombreImagen;
    }

    public function uploadImageBackground(array $imagen, $ancho = null, $alto = null):void{   
        // Eliminar la imagen anterior si existe
        if ($this->background && Storage::exists(DIR_FONDO_CURSO.'/'.$this->background))
            Storage::delete(DIR_FONDO_CURSO.'/'.$this->background);
        
        // Generar un nombre único para la imagen
        $nombreImagen = Storage::uniqName(".png");
        
        // Procesar la imagen con Intervention Image
        $manager = new ImageManager(Driver::class);
        $processImage = $manager->read($imagen['tmp_name']);

        // Redimensionar si se especifican dimensiones
        if ($ancho && $alto)
            $processImage->cover($ancho, $alto);

        if(!is_dir(DIR_FONDO_CURSO))
            mkdir(DIR_FONDO_CURSO);
        
        $processImage->toPng()->save(DIR_FONDO_CURSO.'/'.$nombreImagen);

        // Actualizar el atributo del modelo
        $this->background = $nombreImagen;
    }

}