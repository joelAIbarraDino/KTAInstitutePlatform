<?php

namespace App\Models;

use DinoEngine\Classes\Storage;
use DinoEngine\Core\Model;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class Teacher extends Model{
    
    protected static string $table = 'teacher';
    protected static string $PK_name = 'id_teacher';
    protected static array $columns = ['id_teacher', 'name', 'photo', 'speciality', 'experience', 'bio'];
    protected static array $fillable = ['id_teacher', 'name', 'photo', 'speciality', 'experience', 'bio'];

    public ?int $id_teacher;
    public string $name;
    public string $photo;
    public string $speciality;
    public int $experience;
    public string $bio;
    
    public function __construct($args = [])
    {
        $this->id_teacher = $args['id_teacher']??null;
        $this->name = $args['name']??'';
        $this->photo = $args['photo']??'';
        $this->speciality = $args['speciality']??'';
        $this->experience = $args['experience']??0;
        $this->bio = $args['bio']??'';
    }

    public function validate():array{

        if(!$this->name)
            self::setAlerts('error', "el nombre es obligatorio");

        if(!$this->speciality)
            self::setAlerts('error', "la especialidad es obligatoria");

        if(!$this->experience)
            self::setAlerts('error', "la experiencia es obligatoria");

        if(!$this->bio)
            self::setAlerts('error', "la bio es obligatoria");
        
        if(strlen($this->bio) < 100 || strlen($this->bio) > 1000)
            self::setAlerts('error', "la bio debe tener mas de 100 caracteres y menos de 1000");

        return self::$alerts;
    }

    public function validateUpdate():array{

        if(!$this->name)
            self::setAlerts('error', "el nombre es obligatorio");

        if(!$this->speciality)
            self::setAlerts('error', "la especialidad es obligatoria");

        if(!$this->experience)
            self::setAlerts('error', "la experiencia es obligatoria");

        if(!$this->bio)
            self::setAlerts('error', "la bio es obligatoria");
        
        if(strlen($this->bio) < 100 || strlen($this->bio) > 1000)
            self::setAlerts('error', "la bio debe tener mas de 100 caracteres y menos de 1000");

        return self::$alerts;
    }

    public function validateImage(?array $file):array{

        if($file['photo']['size'] == 0){
            self::setAlerts('error', 'No se ha subido una imagen');
            return self::$alerts;
        }
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if(!Storage::validateFormat($file['photo']['type'], $allowedTypes))
            self::setAlerts('error', 'Solo se permiten imágenes (JPEG, PNG, GIF)');

        return self::$alerts;
    }

    public function subirImagen(array $imagen, $ancho = null, $alto = null):void{   
        // Eliminar la imagen anterior si existe
        if ($this->photo && Storage::exists(DIR_PROFESORES.'/'.$this->photo))
            Storage::delete(DIR_PROFESORES.'/'.$this->photo);
        
        // Generar un nombre único para la imagen
        $nombreImagen = Storage::uniqName(".png");
        
        // Procesar la imagen con Intervention Image
        $manager = new ImageManager(Driver::class);
        $processImage = $manager->read($imagen['tmp_name']);

        // Redimensionar si se especifican dimensiones
        if ($ancho && $alto)
            $processImage->cover($ancho, $alto);

        if(!is_dir(DIR_PROFESORES))
            mkdir(DIR_PROFESORES);
        
        $processImage->toPng()->save(DIR_PROFESORES.'/'.$nombreImagen);

        // Actualizar el atributo del modelo
        $this->photo = $nombreImagen;
    }

}