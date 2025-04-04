<?php

namespace App\Controllers;

use App\Classes\Helpers;
use App\Models\Category;
use App\Models\CourseView;
use App\Models\Enrollment;
use App\Models\EnrollmentView;
use DinoEngine\Http\Response;

class AdminController
{
    public static function index(): void{

        Response::render('admin/index', [
            'nameApp'=>APP_NAME, 
            'title' => 'Admin KTA',
            'bienvenida' => Helpers::saludo()
        ]);

    }

    public static function courses():void{

        $courses = CourseView::all();

        Response::render('admin/cursos/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin cursos',
            'courses'=>$courses
        ]);

    }

    public static function categories():void{
        
        $categories = Category::all();

        Response::render('admin/categorias/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin categorias',
            'categories'=>$categories
        ]);
    }

    public static function enrollment():void{

        $enrollment = EnrollmentView::all();

        Response::render('admin/enrollment/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin inscripciones',
            'enrollment' => $enrollment
        ]);
    }
}