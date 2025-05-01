<?php

namespace App\Models;

use DinoEngine\Classes\Storage;
use DinoEngine\Core\Model;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class Slidebar extends Model{
    
    protected static string $table = 'slidebar';
    protected static string $PK_name = 'id_slidebar';
    protected static array $columns = ['id_slidebar', 'title', 'color_title', 'subtitule', 'color_subtitule', 'type_background', 'background', 'link', 'CTA'];
    protected static array $fillable = ['id_slidebar', 'title', 'color_title', 'subtitule', 'color_subtitule', 'type_background', 'background', 'link', 'CTA'];
    protected static array $nulleable = ['link', 'CTA'];

    public ?int $id_slidebar;
    public string $title;
    public string $color_title;
    public string $subtitule;
    public string $color_subtitule;
    public int $type_background;
    public string $background;
    public ?string $link;
    public ?string $CTA;

    public function __construct($args = [])
    {
        $this->id_slidebar = $args['id_slidebar']??null;
        $this->title = $args['title']??'';
        $this->color_title = $args['color_title']??'#cda02d';
        $this->subtitule = $args['subtitule']??'';
        $this->color_subtitule = $args['color_subtitule']??'#cda02d';
        $this->type_background = $args['type_background']??1;
        $this->background = $args['background']??'';
        $this->link = $args['link']??null;
        $this->CTA = $args['CTA']??null;
    }

    public function validate():array{

        if(!$this->title)
            self::setAlerts('error', "El titulo es obligatorio");

        if(!$this->color_title)
            self::setAlerts('error', "El color del titulo es obligatorio");

        if(!$this->subtitule)
            self::setAlerts('error', "El subtitulo es obligatoria");

        if(!$this->color_subtitule)
            self::setAlerts('error', "El color del subtitulo es obligatorio");

        if(!$this->type_background)
            self::setAlerts('error', "El tipo de fondo es obligatoria");

        return self::$alerts;
    }

    public function validateLink():array{

        if($this->link && !$this->CTA)
            self::setAlerts('error', "El texto del boton es obligatoria");

        if($this->link && !filter_var($this->link, FILTER_VALIDATE_URL))
            self::setAlerts('error', "La URL ingresada no es valida");

        return self::$alerts;
    }

    public function validateImage(?array $file):array{

        if($file['background']['size'] == 0){
            self::setAlerts('error', 'No se ha subido una imagen');
            return self::$alerts;
        }
        
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if(!Storage::validateFormat($file['background']['type'], $allowedTypes))
            self::setAlerts('error', 'Solo se permiten imágenes (JPEG, PNG, GIF)');

        $manager = new ImageManager(Driver::class);
        $processImage = $manager->read($file['background']['tmp_name']);

        //validar si la imagen es muy pequeña para evitar pixeleado
        $width = $processImage->width();
        $height = $processImage->height();

        if($width < 1800 || $height < 1200)
            self::setAlerts('error', 'la imagen de fondo es muy pequeña (se recomienda imagenes de 1800 x 1200 px o superior)');
        

        return self::$alerts;
    }

    public function subirImagen(array $imagen, $ancho = null, $alto = null):array{   
        // Eliminar la imagen anterior si existe
        if ($this->background && Storage::exists(DIR_SLIDEBAR.'/'.$this->background))
            Storage::delete(DIR_SLIDEBAR.'/'.$this->background);
        
        // Generar un nombre único para la imagen
        $nombreImagen = Storage::uniqName(".png");
        
        // Procesar la imagen con Intervention Image
        $manager = new ImageManager(Driver::class);
        $processImage = $manager->read($imagen['tmp_name']);

        // Redimensionar si se especifican dimensiones
        if ($ancho && $alto)
            $processImage->cover($ancho, $alto);

        if(!is_dir(DIR_SLIDEBAR))
            mkdir(DIR_SLIDEBAR);
        
        $processImage->toPng()->save(DIR_SLIDEBAR.'/'.$nombreImagen);

        // Actualizar el atributo del modelo
        $this->background = $nombreImagen;

        return self::$alerts;
    }

}