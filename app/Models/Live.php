<?php

namespace App\Models;

use DinoEngine\Classes\Storage;
use DinoEngine\Core\Model;
use DinoEngine\Helpers\Helpers;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class Live extends Model {
    
    protected static string $table = 'live';
    protected static string $PK_name = 'id_live';
    protected static array $columns = [ 
        'id_live', 'name', 'thumbnail', 'background', 'description', 'details', 
        'dates_times','places','price', 'discount', 'discount_ends_date', 'discount_ends_time',
        'created_at', 'url', 
        'privacy', 'id_category'
    ];

    protected static array $fillable = [
        'name', 'thumbnail', 'background', 'description', 'details', 
        'dates_times','places','price', 'discount', 'discount_ends_date', 'discount_ends_time',
        'created_at', 'url', 
        'privacy', 'id_category'
    ];
    protected static array $nulleable = ['discount', 'discount_ends_date', 'discount_ends_time', 'url'];

    public ?int $id_live;
    public string $name;
    public string $background;
    public string $thumbnail;
    public string $description;
    public string $details;
    public string $dates_times;
    public int $places;
    public float $price;
    public float $discount;
    public ?string $discount_ends_date;
    public ?string $discount_ends_time;
    public string $created_at;
    public ?string $url;
    public string $privacy;
    public int $id_category;

    public const PRIVACY = ['Editando', 'Privado', 'Público', 'Desactivado'];

    public function __construct($args = []){

        $this->id_live = $args["id_live"]??null;
        $this->name = $args["name"]??"";
        $this->background = $args["background"]??"";
        $this->thumbnail = $args["thumbnail"]??"";
        $this->description = $args["description"]??"";
        $this->details = $args["details"]??"";
        $this->dates_times = $args["dates_times"]??"";
        $this->places = $args["places"]??0;
        $this->price = $args["price"]??0.0;
        $this->discount = $args["discount"]??0;
        $this->discount_ends_date = $args["discount_ends_date"]??null;
        $this->discount_ends_time = $args["discount_ends_time"]??null;
        $this->created_at = $args["created_at"]??date('Y-m-d');
        $this->url = $args["url"]??null;
        $this->privacy = $args["privacy"]??self::PRIVACY[0];
        $this->id_category = $args["id_category"]??0;
    }

    public function validate():array{
        if(!$this->name)
            self::setAlerts("error", "Debe ingresar el nombre del curso");
        
        if(strlen($this->name) > 100)
            self::setAlerts("error", "El nombre debe tener menos de 100 caracteres");
        
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

        if(!$this->id_category)
            self::setAlerts("error", "Debe seleccionar una categoria");

        return self::$alerts;
    }

    public function validateDates($array):array{
        if(empty($array)){
            self::setAlerts("error", "Debe ingresar por lo menos una fecha al curso en vivo");
        }

        foreach($array as $element){
            if(!$element){
                self::setAlerts("error", "La fecha ingresada no esta configurada");
                break;
            }
        }

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
        if ($this->thumbnail && Storage::exists(DIR_CARATULAS_LIVE.'/'.$this->thumbnail))
            Storage::delete(DIR_CARATULAS_LIVE.'/'.$this->thumbnail);
        
        // Generar un nombre único para la imagen
        $nombreImagen = Storage::uniqName(".png");
        
        // Procesar la imagen con Intervention Image
        $manager = new ImageManager(Driver::class);
        $processImage = $manager->read($imagen['tmp_name']);

        // Redimensionar si se especifican dimensiones
        if ($ancho && $alto)
            $processImage->cover($ancho, $alto);

        if(!is_dir(DIR_CARATULAS_LIVE))
            mkdir(DIR_CARATULAS_LIVE);
        
        $processImage->toPng()->save(DIR_CARATULAS_LIVE.'/'.$nombreImagen);

        // Actualizar el atributo del modelo
        $this->thumbnail = $nombreImagen;
    }

    public function uploadImageBackground(array $imagen, $ancho = null, $alto = null):void{   
        // Eliminar la imagen anterior si existe
        if ($this->background && Storage::exists(DIR_FONDO_CURSO_LIVE.'/'.$this->background))
            Storage::delete(DIR_FONDO_CURSO_LIVE.'/'.$this->background);
        
        // Generar un nombre único para la imagen
        $nombreImagen = Storage::uniqName(".png");
        
        // Procesar la imagen con Intervention Image
        $manager = new ImageManager(Driver::class);
        $processImage = $manager->read($imagen['tmp_name']);

        // Redimensionar si se especifican dimensiones
        if ($ancho && $alto)
            $processImage->cover($ancho, $alto);

        if(!is_dir(DIR_FONDO_CURSO_LIVE))
            mkdir(DIR_FONDO_CURSO_LIVE);
        
        $processImage->toPng()->save(DIR_FONDO_CURSO_LIVE.'/'.$nombreImagen);

        // Actualizar el atributo del modelo
        $this->background = $nombreImagen;
    }

}