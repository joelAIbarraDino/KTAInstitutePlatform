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

        if($file['gif_file']['size'] == 0){
            self::setAlerts('error', 'No se ha subido una imagen');
            return self::$alerts;
        }
        
        $allowedTypes = ['image/gif'];

        if(!Storage::validateFormat($file['gif_file']['type'], $allowedTypes))
            self::setAlerts('error', 'Solo se permiten imágenes gif');

        return self::$alerts;
    }

    public function subirImagen(array $imagen): array{
        
        // Eliminar la imagen anterior si existe
        if ($this->file_url && Storage::exists(DIR_GIF . '/' . $this->file_url)) {
            Storage::delete(DIR_GIF . '/' . $this->file_url);
        }
    
        // Validar que el archivo exista y no esté vacío
        if (!isset($imagen['tmp_name']) || $imagen['size'] == 0 || !is_uploaded_file($imagen['tmp_name'])) {
            self::setAlerts('error', 'No se ha recibido un archivo válido');
            return self::$alerts;
        }
    
        // Verificar MIME real (no confiar solo en $_FILES['type'])
        $mime = mime_content_type($imagen['tmp_name']);
        if ($mime !== 'image/gif') {
            self::setAlerts('error', 'El archivo no es un GIF válido');
            return self::$alerts;
        }
    
        // Verificar que el archivo empieza con "GIF"
        $fh = fopen($imagen['tmp_name'], 'rb');
        $header = fread($fh, 6);
        fclose($fh);
        if ($header !== 'GIF87a' && $header !== 'GIF89a') {
            self::setAlerts('error', 'El archivo GIF está dañado o mal generado');
            return self::$alerts;
        }
    
        // Generar nombre único
        $nombreImagen = Storage::uniqName('.gif');
    
        // Crear carpeta si no existe
        if (!is_dir(DIR_GIF)) {
            mkdir(DIR_GIF, 0777, true);
        }
    
        try {
            // Procesar la imagen con Intervention
            $manager = new \Intervention\Image\ImageManager(\Intervention\Image\Drivers\Gd\Driver::class);
            $processImage = $manager->read($imagen['tmp_name']);
            $processImage->toGif()->save(DIR_GIF . '/' . $nombreImagen);
            $this->file_url = $nombreImagen;
    
        } catch (\Throwable $e) {
            // Si falla la lectura, mover el archivo sin procesar
            move_uploaded_file($imagen['tmp_name'], DIR_GIF . '/' . $nombreImagen);
            $this->file_url = $nombreImagen;
            error_log("GIF inválido procesado directamente: " . $e->getMessage());
        }
    
        return self::$alerts;
    }

}