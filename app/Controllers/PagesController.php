<?php

namespace App\Controllers;

use App\Models\CourseView;
use App\Models\Slidebar;
use DinoEngine\Http\Response;

class PagesController
{
    public static function index(): void{

        $sliders = Slidebar::all();
        $courses = CourseView::all(15);
        
        Response::render('public/index', [
            'nameApp'=>APP_NAME, 
            'title' => 'Inicio',
            'sliders'=>$sliders,
            'courses'=>$courses
        ]);
    }

    public static function courseDetails($id):void{

        $course = CourseView::where('id_course', '=', $id);

        if(!$course)
            Response::redirect('/');

        Response::render('public/courseDetails', [
            'nameApp'=>APP_NAME,
            'title'=>$course->name,
            'course'=>$course,
            'isTransparent'=>true
        ]);
    }

}