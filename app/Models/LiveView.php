<?php

namespace App\Models;

use DinoEngine\Core\Model;

class LiveView extends Model {
    
    protected static string $table = 'live_view';
    protected static array $columns = [
        'id_live', 'name', 'id_category', 'category',
        'thumbnail', 'background', 'description', 'details', 'places', 'dates_times',
        'price, discount', 'discount_ends_date', 'discount_ends_time',
        'created_at', 'url', 'privacy', 'enrollment'
    ];

    public ?int $id_live;
    public string $name;
    public int $id_category;
    public string $category;
    public string $thumbnail;
    public string $background;
    public string $description;
    public string $details;
    public int $places;
    public string $dates_times;
    public float $price;
    public ?float $discount;
    public ?string $discount_ends_date;
    public ?string $discount_ends_time;
    public string $created_at;
    public string $url;
    public string $privacy;
    public int $enrollment;

    public function __construct($args = []){
        $this->id_live = $args["id_live"]??null;
        $this->name = $args["name"]??"";
        $this->id_category = $args["id_category"]??0;
        $this->category = $args["category"]??"";
        $this->thumbnail = $args["thumbnail"]??"";
        $this->background = $args["background"]??"";
        $this->description = $args["description"]??"";
        $this->details = $args["details"]??"";
        $this->places = $args["places"]??0;
        $this->dates_times = $args["dates_times"]??"";
        $this->price = $args["price"]??0;
        $this->discount = $args["discount"]??null;
        $this->discount_ends_date = $args["discount_ends_date"]??null;
        $this->discount_ends_time = $args["discount_ends_time"]??null;
        $this->created_at = $args["created_at"]??"";
        $this->url = $args["url"]??"";
        $this->privacy = $args["privacy"]??"Editando";
        $this->enrollment = $args["enrollment"]??0;
    }
}