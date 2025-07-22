<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\CourseView;
use App\Models\EnrollmentView;
use App\Models\FAQ;
use App\Models\Lesson;
use App\Models\LiveView;
use App\Models\Membership;
use App\Models\Module;
use App\Models\Slidebar;
use App\Models\Teacher;
use App\Classes\Helpers;
use DinoEngine\Helpers\Helpers as HelpersHelpers;
use DinoEngine\Http\Response;

class PagesController{

    public static function index(): void{

        $sliders = Slidebar::all();
        $courses = CourseView::all(5, 'id_course', 'DESC');
        $teachers = Teacher::all()??[];
        
        Response::render('public/index', [
            'nameApp'=>APP_NAME, 
            'title' => 'Inicio',
            'sliders'=>$sliders,
            'courses'=>$courses,
            'teachers'=>$teachers
        ]);
    }

    public static function about(): void{

        $teachers = Teacher::all()??[];
        
        Response::render('public/whoarewe', [
            'nameApp'=>APP_NAME, 
            'title' => 'Nosotros',
            'teachers'=>$teachers
        ]);
    }

    public static function courses():void{

        $courses = CourseView::all();
        $categories = Category::all();
        
        if(!$courses)
            Response::redirect('/');

        if(!$categories)
            Response::redirect('/');
        
        Response::render('/public/courses/courses', [
            'nameApp'=>APP_NAME,
            'title'=>'Cursos',
            'courses'=>$courses,
            'categories'=>$categories,
            'transparente'=>false
        ]);
    }

    public static function terminos():void {
        Response::render('/public/terminos', [
            'nameApp'=>APP_NAME,
            'title'=>'Terminos y condiciones'
        ]);
    }

    public static function politica():void {
        Response::render('/public/politica', [
            'nameApp'=>APP_NAME,
            'title'=>'Política de privacidad'
        ]);
    }

    public static function courseCategory($category_url):void{
        $courses = CourseView::belongsTo('id_category', $category_url)??[];
        $categories = Category::all();
        
        if(!$categories)
            Response::redirect('/');
        
        Response::render('/public/courses/courses', [
            'nameApp'=>APP_NAME,
            'title'=>'Cursos',
            'courses'=>$courses,
            'categories'=>$categories,
            'category_url'=>$category_url,
            'transparente'=>false
        ]);
    }
    
    public static function courseDetails($id):void{

        session_start();
        
        $inscrito = false;
        $enroll_url = null;

        //si un estudiante tiene la sesion iniciada
        if(isset($_SESSION['student'])){
            $id_student = $_SESSION['student']['id_student'];
            $currentDate = strtotime(date("Y-m-d"));
            
            $enrollment = EnrollmentView::multiWhere(['id_student'=>$id_student, 'course_url'=>$id]);
            $enrollment = EnrollmentView::querySQL(
                'SELECT * FROM enrollment_view WHERE id_student = :id_student AND course_url = :course_url',
                [':id_student'=>$id_student, ':course_url'=>$id]
            );

            if($enrollment){
                foreach($enrollment as $enroll){
                    $enrollDate = strtotime("+".$enroll['max_months_enroll']. " months", strtotime($enroll['enrollment_at']));
                    $inscrito = $currentDate < $enrollDate?true:false;

                    if($inscrito){
                        $enroll_url = $enroll['enroll_url'];
                        break;
                    }
                }
            }        
        }

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

        Response::render('public/courses/courseDetails', [
            'nameApp'=>APP_NAME,
            'title'=>$course->name,
            'course'=>$course,
            'teacher'=>$teacher,
            'modules'=>$modulesLessons,
            'faq'=>$faq,
            'transparente'=>true,
            'cursoInscrito'=>$inscrito,
            'enroll_url'=>$enroll_url
        ]);
    }

    public static function lives():void{
        $lives = LiveView::all();
        $categories = Category::all();
                
        if(!$lives)
            Response::redirect('/');

        if(!$categories)
            Response::redirect('/');
        
        Response::render('/public/lives/lives', [
            'nameApp'=>APP_NAME,
            'title'=>'Cursos',
            'lives'=>$lives,
            'categories'=>$categories
        ]);
    }

    public static function liveCategory(string $category_url):void{
        $lives = LiveView::belongsTo('id_category', $category_url)??[];
        $categories = Category::all();
        
        if(!$categories)
            Response::redirect('/');
        
        Response::render('/public/lives/lives', [
            'nameApp'=>APP_NAME,
            'title'=>'Cursos en vivo',
            'lives'=>$lives,
            'categories'=>$categories,
            'category_url'=>$category_url
        ]);
    }

    public static function liveDetails($id):void{
    
        $live = LiveView::where('url', '=', $id);

        if(!$live)
            Response::redirect('/');

        Response::render('public/lives/liveDetails', [
            'nameApp'=>APP_NAME,
            'title'=>$live->name,
            'live'=>$live
        ]);
    }

    public static function membership():void{
        
        $membresias = Membership::all()??[];

        if(empty($membresias))
            Response::redirect('/');

        Response::render('/public/membresias', [
            'nameApp'=>APP_NAME,
            'title'=>'Membresias',
            'membresias'=>$membresias,
            'transparente'=>false
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

    public static function calendario():void{

        Response::render('public/lives/calendario', [
            'nameApp'=>APP_NAME,
            'title'=>'Calendario de eventos'
        ]);
        
    }
}