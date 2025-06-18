<?php

namespace App\Controllers;

use App\Classes\Helpers;
use App\Models\Admin;
use App\Models\Category;
use App\Models\CourseView;
use App\Models\EnrollmentView;
use App\Models\Slidebar;
use App\Models\Student;
use App\Models\Teacher;
use DinoEngine\Http\Response;

class DashboardController{
    
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

    public static function slidebar():void{
        $slidebar = Slidebar::all();

        Response::render('admin/slidebar/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin slidebar',
            'slidebar'=>$slidebar
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

    public static function teachers():void{
        
        $teachers = Teacher::all();

        Response::render('admin/maestros/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin maestros',
            'teachers' => $teachers
        ]);
    }

    public static function students():void{
        
        $students = Student::all();

        Response::render('admin/estudiantes/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin estudiantes',
            'students' => $students
        ]);
    }

    public static function admins():void{
        
        $admins = Admin::all();

        Response::render('admin/administradores/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin de super usuarios',
            'admins' => $admins
        ]);
    }
}