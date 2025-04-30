<?php

namespace App\Controllers;

use App\Models\Slidebar;
use DinoEngine\Http\Response;

class PagesController
{
    public static function index(): void{

        $sliders = Slidebar::all();

        Response::render('public/index', [
            'nameApp'=>APP_NAME, 
            'title' => 'Inicio',
            'sliders'=>$sliders
        ]);
    }

}