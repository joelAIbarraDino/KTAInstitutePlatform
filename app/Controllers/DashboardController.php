<?php

namespace App\Controllers;

use DinoEngine\Http\Response;
use App\Models\MembershipView;
use App\Models\EnrollmentView;
use App\Models\CourseView;
use App\Models\Category;
use App\Models\Slidebar;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Admin;
use App\Models\Gif;
use App\Classes\Helpers;
use App\Models\BannerAsesoria;
use App\Models\Membership;
use App\Models\PaymentCourseView;
use App\Models\PaymentMembershipView;

class DashboardController{
    
    public static function index(): void{

        Response::render('admin/index', [
            'nameApp'=>APP_NAME, 
            'title' => 'Admin KTA',
            'bienvenida' => Helpers::saludo()
        ]);

    }

    public static function courses():void{

        $courses = CourseView::belongsTo('type', 'grabado', 'id_course', 'ASC')??[];

        Response::render('admin/cursos/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin cursos',
            'courses'=>$courses
        ]);

    }

    public static function paymentCourses():void{

        $pagos = PaymentCourseView::querySQL("SELECT * FROM payment_course_view WHERE from_membership = 0 AND type = 'grabado'")??[];
        $finalPagos = [];

        foreach($pagos as $pago){
            $finalPagos[] = new PaymentCourseView($pago)??[];
        }
        
        Response::render('admin/cursos/pagos', [
            'nameApp' => APP_NAME,
            'title' => 'Pagos cursos',
            'pagos'=>$finalPagos
        ]);
    }

    public static function lives():void{

        $lives = CourseView::belongsTo('type', 'live', 'id_course', 'ASC')??[];

        Response::render('admin/lives/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin lives',
            'lives'=>$lives
        ]);

    }

    public static function paymentLives():void{

        $pagos = PaymentCourseView::querySQL("SELECT * FROM payment_course_view WHERE from_membership = 0 AND type = 'live'")??[];
        $finalPagos = [];

        foreach($pagos as $pago){
            $finalPagos[] = new PaymentCourseView($pago)??[];
        }


        Response::render('admin/lives/pagos', [
            'nameApp' => APP_NAME,
            'title' => 'Pagos lives',
            'pagos'=>$finalPagos
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

    public static function memberships():void{
        
        $membresias = Membership::all();

        Response::render('admin/membresia/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin membresias',
            'memberships'=>$membresias
        ]);
    }

    public static function paymentMemberships():void{
        
        $pagos = PaymentMembershipView::all();

        Response::render('admin/membresia/pagos', [
            'nameApp' => APP_NAME,
            'title' => 'Pagos membresias',
            'pagos'=>$pagos
        ]);
    }

    public static function studentMemberships():void{
        
        $membresias = MembershipView::all(0, 'created_at', 'DESC');

        Response::render('admin/membresia/subs', [
            'nameApp' => APP_NAME,
            'title' => 'Membresias registradas',
            'membresias'=>$membresias
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

    public static function gifs():void{
        $gifs = Gif::all();

        Response::render('admin/gifs/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin gif',
            'gifs'=>$gifs
        ]);
    }

    public static function bannerAsesoria():void{
        $bannerAsesorias = BannerAsesoria::all();

        Response::render('admin/bannerAsesoria/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin asesoría',
            'bannerAsesorias'=>$bannerAsesorias
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