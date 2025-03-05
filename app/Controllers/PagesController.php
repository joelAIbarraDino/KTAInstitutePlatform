<?php

namespace App\Controllers;

use DinoEngine\Helpers\Helpers;
use DinoEngine\Http\Request;
use DinoEngine\Http\Response;
use GrahamCampbell\ResultType\Result;

class PagesController
{
    public static function index(string $nameApp): void{
        Response::render('pages/index', [
            'nameApp'=>$nameApp, 
            'title' => 'Inicio'
        ]);
    }

    public static function cursos(string $nameApp): void{
        Response::render('pages/cursos', [
            'nameApp'=>$nameApp, 
            'title' => 'Cursos'
        ]);
    }

    public static function cursoInfo(string $nameApp): void{
        Response::render('pages/cursoInfo', [
            'nameApp'=>$nameApp, 
            'title' => 'Cursos info'
        ]);
    }

    public static function cursoCategoria(string $nameApp, string $categoria): void{

        Response::render('pages/cursos', [
            'nameApp'=>$nameApp, 
            'title' => $categoria
        ]);
    }
}