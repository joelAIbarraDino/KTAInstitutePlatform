<?php

namespace App\Models;

use DinoEngine\Classes\Storage;
use DinoEngine\Core\Model;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class Teacher extends Model{
    
    protected static string $table = 'teacher';
    protected static string $PK_name = 'id_teacher';
    protected static array $columns = ['id_teacher', 'name', 'email', 'password', 'photo', 'speciality', 'experience', 'bio', 'url', 'clave'];
    protected static array $fillable = ['id_teacher', 'name', 'email', 'password', 'photo', 'speciality', 'experience', 'bio', 'url', 'clave'];
    protected static array $nulleable = ['url', 'clave'];

    public ?int $id_teacher;
    public string $name;
    public string $email;
    public string $password;
    public string $photo;
    public string $speciality;
    public int $experience;
    public string $bio;
    public ?string $url;
    public ?string $clave;

    public function __construct($args = [])
    {
        $this->id_teacher = $args['id_teacher']??null;
        $this->name = $args['name']??'';
        $this->email = $args['email']??'';
        $this->password = $args['password']??'';
        $this->photo = $args['photo']??'';
        $this->speciality = $args['speciality']??'';
        $this->experience = $args['experience']??0;
        $this->bio = $args['bio']??'';
        $this->url = $args['url']??null;
        $this->clave = $args['clave']??null;
    }

    public function validate():array{

        if(!$this->name)
            self::setAlerts('name', "el nombre es obligatorio");

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            self::setAlerts('email', "debe ingresar un correo valido");

        if(!$this->password)
            self::setAlerts('password', "la contraseña es obligatoria");

        if(!$this->speciality)
            self::setAlerts('speciality', "la especialidad es obligatoria");

        if(!$this->experience)
            self::setAlerts('experience', "la experiencia es obligatoria");

        if(!$this->bio)
            self::setAlerts('bio', "la bio es obligatoria");
        
        return self::$alerts;
    }

    public function validateImage(?array $file):array{
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if(!Storage::validateFormat($file['photo']['type'], $allowedTypes))
            self::setAlerts('photo', 'Solo se permiten imágenes (JPEG, PNG, GIF)');

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