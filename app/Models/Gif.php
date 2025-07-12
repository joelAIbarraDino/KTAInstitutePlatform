<?php

namespace App\Models;

use DinoEngine\Classes\Storage;
use DinoEngine\Core\Model;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class Gif extends Model{
    
    protected static string $table = 'gif';
    protected static string $PK_name = 'id_gif';
    protected static array $columns = ['id_gif', 'file_url'];
    protected static array $fillable = ['file_url'];

    public ?int $id_gif;
    public string $file_url;

    public function __construct($args = [])
    {
        $this->id_gif = $args['id_gif']??null;
        $this->file_url = $args['file_url']??'';
    }

    public function validateImage(?array $file):array{

        if($file['file_url']['size'] == 0){
            self::setAlerts('error', 'No se ha subido una imagen');
            return self::$alerts;
        }
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if(!Storage::validateFormat($file['file_url']['type'], $allowedTypes))
            self::setAlerts('error', 'Solo se permiten imágenes (JPEG, PNG, GIF)');

        return self::$alerts;
    }

    public function subirImagen(array $imagen):array{   
        // Eliminar la imagen anterior si existe
        if ($this->file_url && Storage::exists(DIR_GIF.'/'.$this->file_url))
            Storage::delete(DIR_GIF.'/'.$this->file_url);
        
        // Generar un nombre único para la imagen
        $nombreImagen = Storage::uniqName(".gif");
        
        // Procesar la imagen con Intervention Image
        $manager = new ImageManager(Driver::class);
        $processImage = $manager->read($imagen['tmp_name']);

        if(!is_dir(DIR_GIF))
            mkdir(DIR_GIF);
        
        $processImage->toPng()->save(DIR_GIF.'/'.$nombreImagen);

        // Actualizar el atributo del modelo
        $this->background = $nombreImagen;

        return self::$alerts;
    }

}