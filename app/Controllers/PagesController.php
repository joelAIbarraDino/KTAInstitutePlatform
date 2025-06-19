<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\CourseView;
use App\Models\FAQ;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Slidebar;
use App\Models\Teacher;
use DinoEngine\Http\Response;

class PagesController{

    public static function index(): void{

        $sliders = Slidebar::all();
        $courses = CourseView::all(15);
        
        Response::render('public/index', [
            'nameApp'=>APP_NAME, 
            'title' => 'Inicio',
            'sliders'=>$sliders,
            'courses'=>$courses,
            'transparente'=>true
        ]);
    }

    public static function about(): void{
        
        Response::render('public/about', [
            'nameApp'=>APP_NAME, 
            'title' => 'Nosotros',
            'transparente'=>false
        ]);
    }

    public static function courses():void{

        $courses = CourseView::all();
        $categories = Category::all();
        
        if(!$courses)
            Response::redirect('/');

        if(!$categories)
            Response::redirect('/');
        
        Response::render('/public/courses', [
            'nameApp'=>APP_NAME,
            'title'=>'Cursos',
            'courses'=>$courses,
            'categories'=>$categories,
            'transparente'=>false
        ]);
    }

    public static function courseCategory($category_url):void{
        $courses = CourseView::belongsTo('id_category', $category_url);
        $categories = Category::all();
        
        if(!$courses)
            Response::redirect('/');

        if(!$categories)
            Response::redirect('/');
        
        Response::render('/public/courses', [
            'nameApp'=>APP_NAME,
            'title'=>'Cursos',
            'courses'=>$courses,
            'categories'=>$categories,
            'category_url'=>$category_url,
            'transparente'=>false
        ]);
    }
    
    public static function courseDetails($id):void{

        $course = CourseView::where('url', '=', $id);

        if(!$course)
            Response::redirect('/');

        $teacher = Teacher::where('id_teacher', '=', $course->id_teacher);

        if(!$teacher)
            Response::redirect('/');

        $modules = Module::belongsTo('id_course', $course->id_course, "order_module", 'ASC')??[];
        $faq = FAQ::belongsTo('id_course', $course->id_course);
        $modulesLessons = [];
        
        //por cada modulo obtengo sus lecciones que tiene
        foreach($modules as $module){
            //consulto las lecciones que tiene el modulo
            $lessons =  Lesson::belongsTo('id_module', $module->id_module, 'order_lesson', 'ASC')??[];
            
            //lleno los datos del modulo a mi array final y los cursos del modulo que tiene
            $modulesLessons[] = [
                'name'=>$module->name,
                'lessons'=>array_map(fn($obj) => $obj->name, $lessons )
            ];

        }

        Response::render('public/courseDetails', [
            'nameApp'=>APP_NAME,
            'title'=>$course->name,
            'course'=>$course,
            'teacher'=>$teacher,
            'modules'=>$modulesLessons,
            'faq'=>$faq,
            'transparente'=>true
        ]);
    }

    public static function teacherDetails($id):void{

        $teacher = Teacher::where('id_teacher', '=', $id);

        if(!$teacher)
            Response::redirect('/');
        
        $courses = CourseView::belongsTo('id_teacher', $teacher->id_teacher);

        if(!$courses)
            Response::redirect('/');

        Response::render('public/teacherDetails', [
            'nameApp'=>APP_NAME, 
            'title' => $teacher->name,
            'teacher'=>$teacher,
            'courses'=>$courses,
            'transparente'=>false
        ]);
    }

}