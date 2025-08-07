<?php

namespace App\Models;

use DinoEngine\Core\Model;

class   BannerAsesoria extends Model{
    
    protected static string $table = 'banner_asesoria';
    protected static string $PK_name = 'id_banner_asesoria';
    protected static array $columns = ['id_banner_asesoria', 'text_banner', 'link', 'CTA'];
    protected static array $fillable = ['text_banner', 'link', 'CTA'];
    protected static array $nulleable = ['link', 'CTA'];

    public ?int $id_banner_asesoria;
    public string $text_banner;
    public ?string $link;
    public ?string $CTA;

    public function __construct($args = [])
    {
        $this->id_banner_asesoria = $args['id_banner_asesoria']??null;
        $this->text_banner = $args['text_banner']??"";
        $this->link = $args['link']??null;
        $this->CTA = $args['CTA']??null;
    }

    public function validate():array{

        if(!$this->text_banner)
            self::setAlerts('error', "el nombre es obligatorio");

        return self::$alerts;
    }

    public function validateLink():array{

        if($this->link && !$this->CTA)
            self::setAlerts('error', "El texto del boton es obligatoria");

        if($this->CTA && !$this->link)
            self::setAlerts('error', "La URL del CTA es obligatorio");

        if($this->link && !filter_var($this->link, FILTER_VALIDATE_URL))
            self::setAlerts('error', "La URL ingresada no es valida");

        return self::$alerts;
    }

}