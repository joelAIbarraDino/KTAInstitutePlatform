<?php

namespace App\Models;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use DinoEngine\Classes\Storage;
use DinoEngine\Core\Model;

class Membership extends Model {
    
    protected static string $table = 'membership';
    protected static string $PK_name = 'id_membership';
    protected static array $columns = ['id_membership', 'type', 'max_time_membership', 'price', 'caract', 'photo'];
    protected static array $fillable = ['type', 'max_time_membership', 'price', 'caract', 'photo'];

    public ?int $id_membership;
    public string $type;
    public int $max_time_membership;
    public float $price;
    public string $caract;
    public string $photo;

    public function __construct($args = []){
        $this->id_membership = $args["id_membership"]??null;
        $this->type = $args["type"]??"";
        $this->max_time_membership = $args["max_time_membership"]??0;
        $this->price = $args["price"]??0.0;
        $this->caract = $args["caract"]??"";
        $this->photo = $args["photo"]??"";
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

    public function validateImage(?array $file):array{

        if($file['photo']['size'] == 0){
            self::setAlerts('error', 'No se ha subido una imagen');
            return self::$alerts;
        }
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if(!Storage::validateFormat($file['photo']['type'], $allowedTypes))
            self::setAlerts('error', 'Solo se permiten imágenes (JPEG, PNG, GIF, WEBP)');

        return self::$alerts;
    }

    public function subirImagen(array $imagen, $ancho = null, $alto = null):void{   
        // Eliminar la imagen anterior si existe
        if ($this->photo && Storage::exists(DIR_MEMBRESIAS.'/'.$this->photo))
            Storage::delete(DIR_MEMBRESIAS.'/'.$this->photo);
        
        // Generar un nombre único para la imagen
        $nombreImagen = Storage::uniqName(".png");
        
        // Procesar la imagen con Intervention Image
        $manager = new ImageManager(Driver::class);
        $processImage = $manager->read($imagen['tmp_name']);

        // Redimensionar si se especifican dimensiones
        if ($ancho && $alto)
            $processImage->cover($ancho, $alto);

        if(!is_dir(DIR_MEMBRESIAS))
            mkdir(DIR_MEMBRESIAS);
        
        $processImage->toPng()->save(DIR_MEMBRESIAS.'/'.$nombreImagen);

        // Actualizar el atributo del modelo
        $this->photo = $nombreImagen;
    }

}