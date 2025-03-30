<?php

namespace App\Controllers;

use DinoEngine\Http\Response;

use App\Models\TeacherView;
use App\Models\Category;
use App\Models\Course;

class CourseController{

    public static function create():void{

        $teachers = TeacherView::all();
        $categories = Category::all();

        Response::render('/admin/cursos/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo curso',
            'arrayStatus'=>Course::PRIVACY,
            'teachers'=> $teachers,
            'categories' => $categories
        ]);
    }
}