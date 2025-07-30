<?php

namespace App\Models;

use DinoEngine\Classes\Storage;
use DinoEngine\Core\Model;
use DinoEngine\Exceptions\QueryException;
use DinoEngine\Http\Response;

class Material extends Model {
    
    protected static string $table = 'material';
    protected static string $PK_name = 'id_material';
    protected static array $columns = ['id_material', 'name', 'type', 'url_file', 'id_lesson'];
    protected static array $fillable = ['type', 'name', 'url_file', 'id_lesson'];

    public ?int $id_material;
    public string $name;
    public string $type;
    public string $url_file;
    public int $id_lesson;

    public function __construct($args = []){
        $this->id_material = $args["id_material"]??null;
        $this->name = $args["name"]??"";
        $this->type = $args["type"]??"";
        $this->url_file = $args["url_file"]??"";
        $this->id_lesson = $args["id_lesson"]??0;
    }

    public function validateAPI():void{
        if(!$this->name)
            Response::json(['ok'=>false, 'message'=>'Se debe ingresar el nombre del archivo'], 400);

        if(!$this->type)
            Response::json(['ok'=>false, 'message'=>'Se debe especificar el tipo de archivo'], 400);

        if(!$this->id_lesson)
            Response::json(['ok'=>false, 'message'=>'Se debe especificar a que curso pertenece'], 400);
    }

    public function validateFile(?array $file):void{
        
        if(!isset($file['file']))
            Response::json(['ok'=>false, 'message'=>'Debe subir un archivo'], 400);
    }

    public function uploadFile(array $file):void{   
        // Eliminar la imagen anterior si existe
        if ($this->url_file && Storage::exists(DIR_MATERIAL.'/'.$this->url_file))
            Storage::delete(DIR_MATERIAL.'/'.$this->url_file);
        
        // Generar un nombre único para la imagen
        $file_name = $file['name'];
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
        $nombreArchivo = Storage::uniqName(".".$file_type);

        if(!is_dir(DIR_MATERIAL))
            mkdir(DIR_MATERIAL);
        
        move_uploaded_file($file['tmp_name'], DIR_MATERIAL.'/'.$nombreArchivo);

        // Actualizar el atributo del modelo
        $this->url_file = $nombreArchivo;
    }
}