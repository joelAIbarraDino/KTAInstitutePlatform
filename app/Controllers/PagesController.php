<?php

namespace App\Controllers;

use App\Models\BannerAsesoria;
use App\Models\EnrollmentView;
use App\Models\CourseView;
use App\Models\Membership;
use App\Models\Category;
use App\Models\LiveView;
use App\Models\Slidebar;
use App\Models\Teacher;
use App\Models\Review;
use App\Models\Module;
use App\Models\Lesson;
use App\Models\FAQ;
use App\Models\Gif;
use DinoEngine\Helpers\Helpers;

use DinoEngine\Http\Response;

class PagesController{

    public static function home():void{
        $currentDate = time();
        $sliders = Slidebar::all();
        $courses = CourseView::all(5, 'id_course', 'DESC');
        $lives = LiveView::all();
        $membresias = Membership::all()??[];
        $teachers = Teacher::all()??[];
        $categories = Category::all()??[];
        $reviews = Review::all(20);
        
        $gifs = Gif::all();
        $gif = null;

        $finalLives = [];

        foreach ($lives as $live) {

            $fechasArray = json_decode($live->dates_times, true);

            if (!is_array($fechasArray)) continue;

            foreach ($fechasArray as $fecha) {
                
                
                if ($currentDate < $fecha) {
                    $finalLives[] = $live;
                    break;
                }
            }
        };


        if(count($gifs) > 0){
            $gif = array_shift($gifs);
        }
        
        Response::render('public/home', [
            'nameApp'=>APP_NAME, 
            'title' => 'Inicio',
            'sliders'=>$sliders,
            'courses'=>$courses,
            'reviews'=>$reviews,
            'teachers'=>$teachers,
            'categories'=>$categories,
            'membresias'=>$membresias,
            'lives'=>$finalLives,
            'gif'=>$gif
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

    public static function courses():void{

        $categories = Category::all();
        $banners = BannerAsesoria::all()??[];
        $bannerAsesoria = array_pop($banners);
        
        if(!$categories)
            Response::redirect('/');
        
        Response::render('/public/courses/courses', [
            'nameApp'=>APP_NAME,
            'title'=>'Cursos Self Study',
            'categories'=>$categories,
            'bannerAsesoria'=>$bannerAsesoria
        ]);
    }

    public static function courseCategory($category_url):void{
        $coursesTmpt = CourseView::querySQL('SELECT * FROM course_view WHERE type="grabado" AND privacy ="Público" AND id_category = :id_category', [
            ':id_category'=>$category_url
        ])??[];
        
        $courses = array_map(fn($row) => new CourseView($row), $coursesTmpt);

        $categories = Category::all();
        $banners = BannerAsesoria::all()??[];
        $bannerAsesoria = array_pop($banners);
        
        if(!$categories)
            Response::redirect('/');
        
        Response::render('/public/courses/courses', [
            'nameApp'=>APP_NAME,
            'title'=>'Cursos',
            'courses'=>$courses,
            'categories'=>$categories,
            'category_url'=>$category_url,
            'bannerAsesoria'=>$bannerAsesoria
        ]);
    }
    
    public static function courseDetails($id):void{

        session_start();

        $inscrito = false;
        $enroll_url = null;

        // Si hay sesión de estudiante
        if (!empty($_SESSION['student'])) {

            $id_student  = $_SESSION['student']['id_student'];
            $currentDate = strtotime(date("Y-m-d"));

            $enrollments = EnrollmentView::querySQL('SELECT * FROM enrollment_view WHERE id_student = :id_student AND course_url = :course_url',[
                ':id_student' => $id_student,
                ':course_url' => $id
            ])??[];

            foreach ($enrollments as $enroll) {

                $enrollDate = strtotime("+" . $enroll['max_months_enroll'] . " months", strtotime($enroll['enrollment_at']));

                if ($currentDate < $enrollDate) {
                    $inscrito   = true;
                    $enroll_url = $enroll['enroll_url'];
                    break;
                }
            }
        }

        // Consulta del curso
        $course = CourseView::where('url', '=', $id);

        if (!$course) {
            Response::redirect('/');
        }

        // Consulta del profesor
        $teacher = Teacher::where('id_teacher', '=', $course->id_teacher);

        if (!$teacher) {
            Response::redirect('/');
        }

        // Módulos del curso
        $modules = Module::belongsTo('id_course', $course->id_course, 'order_module', 'ASC') ?? [];
        $faq = FAQ::belongsTo('id_course', $course->id_course);

        $modulesLessons = array_map(function($module) {

            $lessons = Lesson::belongsTo('id_module', $module->id_module, 'order_lesson', 'ASC') ?? [];

            return [
                'name'    => $module->name,
                'lessons' => array_map(fn($obj) => $obj->name, $lessons)
            ];

        }, $modules);


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
        $categories = Category::all();
        $banners = BannerAsesoria::all()??[];
        $bannerAsesoria = array_pop($banners);

        if(!$categories)
            Response::redirect('/');
        
        Response::render('/public/lives/lives', [
            'nameApp'=>APP_NAME,
            'title'=>'Cursos en vivo',
            'categories'=>$categories,
            'bannerAsesoria'=>$bannerAsesoria
        ]);
    }

    public static function liveCategory($category_url):void{
        $coursesTmpt = CourseView::querySQL('SELECT * FROM course_view WHERE type="live" AND privacy ="Público" AND id_category = :id_category', [
            ':id_category'=>$category_url
        ])??[];
        
        $courses = array_map(fn($row) => new CourseView($row), $coursesTmpt);

        $categories = Category::all();
        $banners = BannerAsesoria::all()??[];
        $bannerAsesoria = array_pop($banners);
        
        if(!$categories)
            Response::redirect('/');
        
        Response::render('/public/lives/lives', [
            'nameApp'=>APP_NAME,
            'title'=>'Cursos en vivo',
            'courses'=>$courses,
            'categories'=>$categories,
            'category_url'=>$category_url,
            'bannerAsesoria'=>$bannerAsesoria
        ]);
    }

    public static function liveDetails($id):void{
    
        // $live = CourseView::where('url', '=', $id);

        // if(!$live)
        //     Response::redirect('/');

        // Response::render('public/lives/liveDetails', [
        //     'nameApp'=>APP_NAME,
        //     'title'=>$live->name,
        //     'live'=>$live
        // ]);
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
        
        $courses = CourseView::belongsTo('id_teacher', $teacher->id_teacher)??[];


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

    public static function testimonios():void{
        $reviews = Review::all();

        Response::render('public/testimonios', [
            'nameApp'=>APP_NAME,
            'title'=>'Testimonios',
            'reviews'=>$reviews
        ]);  
    }
}