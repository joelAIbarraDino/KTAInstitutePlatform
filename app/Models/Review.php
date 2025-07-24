<?php

namespace App\Models;

use DinoEngine\Core\Model;

class Review extends Model {
    
    protected static string $table = 'review';
    protected static string $PK_name = 'id_review';
    protected static array $columns = ['id_review', 'author_name' , 'photo', 'relative_time', 'review', 'google_url', 'rating'];

    public ?int $id_review;
    public string $author_name;
    public ?string $photo;
    public string $relative_time;
    public string $review;
    public string $google_url;
    public int $rating;

    public function __construct($args = []){
        $this->id_review = $args["id_review"]??null;
        $this->author_name = $args["author_name"]??"";
        $this->photo = $args["photo"]??null;
        $this->relative_time = $args["relative_time"]??"";
        $this->review = $args["review"]??"";
        $this->google_url = $args["google_url"]??"";
        $this->rating = $args["rating"]??0;
    }

}