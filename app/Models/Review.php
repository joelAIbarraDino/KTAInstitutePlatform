<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Review extends Model {
    
    protected static string $table = 'review';
    protected static string $PK_name = 'id_review';
    protected static array $columns = ['id_review', 'author_name' , 'review', 'google_url', 'rating'];
    protected static array $fillable = ['name'];

    public ?int $id_review;
    public string $author_name;
    public string $review;
    public string $google_url;
    public int $rating;

    public function __construct($args = []){
        $this->id_review = $args["id_review"]??null;
        $this->author_name = $args["author_name"]??"";
        $this->review = $args["review"]??"";
        $this->google_url = $args["google_url"]??"";
        $this->rating = $args["rating"]??0;
    }

    public function validate(){

        if(!$this->author_name)
            self::setAlerts('error', 'El nombre es obligatorio');

        if(!$this->review)
            self::setAlerts('error', 'La reseña es obligatoria');

        return self::$alerts;
    }

}