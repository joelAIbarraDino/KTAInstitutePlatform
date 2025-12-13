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
use App\Classes\Paginador;
use App\Models\BannerAsesoria;
use App\Models\Membership;
use App\Models\PaymentCourseView;
use App\Models\PaymentMembershipView;
use DinoEngine\Helpers\Helpers as DinoEngineHelpers;
use DinoEngine\Http\Request;

class DashboardController{
    
    public static function index(): void{

        Response::render('admin/index', [
            'nameApp'=>APP_NAME, 
            'title' => 'Admin KTA',
            'bienvenida' => Helpers::saludo()
        ]);

    }

    public static function courses():void{

        $queryParams = Request::getQueryParams();
        $paginaActual = filter_var($queryParams['page']??'', FILTER_VALIDATE_INT);

        if(!$paginaActual || $paginaActual < 1){
            Response::redirect('/kta-admin/cursos?page=1');
        }

        $total = CourseView::count('id_course', 'type', '=', 'grabado');
        $paginacion = new Paginador($paginaActual, $total);

        if($paginacion->totalPaginas() < $paginaActual){
            Response::redirect('/kta-admin/cursos?page=1');
        }

        $courses = CourseView::pagination($paginacion->registrosPorPagina, $paginacion->offset(), 'type', '=', 'grabado')??[];

        Response::render('admin/cursos/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin cursos',
            'courses'=>$courses,
            'paginacion'=>$paginacion->paginacion()
        ]);

    }

    public static function paymentCourses():void{

        $queryParams = Request::getQueryParams();
        $paginaActual = filter_var($queryParams['page']??'', FILTER_VALIDATE_INT);

        if(!$paginaActual || $paginaActual < 1){
            Response::redirect('/kta-admin/pago-cursos?page=1');
        }

        $total = PaymentCourseView::count('id_enrollment', 'type', '=', 'grabado');
        $paginacion = new Paginador($paginaActual, $total);

        if($paginacion->totalPaginas() < $paginaActual){
            Response::redirect('/kta-admin/pago-cursos?page=1');
        }

        $pagos = PaymentCourseView::querySQL("SELECT * FROM payment_course_view WHERE from_membership = 0 AND type = 'grabado' LIMIT ".$paginacion->registrosPorPagina." OFFSET ".$paginacion->offset())??[];
        $finalPagos = [];

        foreach($pagos as $pago){
            $finalPagos[] = new PaymentCourseView($pago)??[];
        }
        
        Response::render('admin/cursos/pagos', [
            'nameApp' => APP_NAME,
            'title' => 'Pagos cursos',
            'pagos'=>$finalPagos,
            'paginacion'=>$paginacion->paginacion()
        ]);
    }

    public static function lives():void{

        $queryParams = Request::getQueryParams();
        $paginaActual = filter_var($queryParams['page']??'', FILTER_VALIDATE_INT);

        if(!$paginaActual || $paginaActual < 1){
            Response::redirect('/kta-admin/lives?page=1');
        }

        $total = CourseView::count('id_course', 'type', '=', 'live');
        $paginacion = new Paginador($paginaActual, $total, 1);

        if($paginacion->totalPaginas() < $paginaActual){
            Response::redirect('/kta-admin/lives?page=1');
        }

        $lives = CourseView::pagination($paginacion->registrosPorPagina, $paginacion->offset(), 'type', '=', 'live')??[];


        Response::render('admin/lives/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin lives',
            'lives'=>$lives,
            'paginacion'=>$paginacion->paginacion()
        ]);

    }

    public static function paymentLives():void{

        $queryParams = Request::getQueryParams();
        $paginaActual = filter_var($queryParams['page']??'', FILTER_VALIDATE_INT);

        if(!$paginaActual || $paginaActual < 1){
            Response::redirect('/kta-admin/pago-lives?page=1');
        }

        $total = PaymentCourseView::count('id_enrollment', 'type', '=', 'live');
        $paginacion = new Paginador($paginaActual, $total);

        if($paginacion->totalPaginas() < $paginaActual){
            Response::redirect('/kta-admin/pago-lives?page=1');
        }

        $pagos = PaymentCourseView::querySQL("SELECT * FROM payment_course_view WHERE from_membership = 0 AND type = 'live' LIMIT ".$paginacion->registrosPorPagina." OFFSET ".$paginacion->offset())??[];
        $finalPagos = [];

        foreach($pagos as $pago){
            $finalPagos[] = new PaymentCourseView($pago)??[];
        }

        Response::render('admin/lives/pagos', [
            'nameApp' => APP_NAME,
            'title' => 'Pagos lives',
            'pagos'=>$finalPagos,
            'paginacion'=>$paginacion->paginacion()
        ]);
    }

    public static function categories():void{
        
        $queryParams = Request::getQueryParams();
        $paginaActual = filter_var($queryParams['page']??'', FILTER_VALIDATE_INT);

        if(!$paginaActual || $paginaActual < 1){
            Response::redirect('/kta-admin/categorias?page=1');
        }

        $total = Category::count('id_category');
        $paginacion = new Paginador($paginaActual, $total);

        if($paginacion->totalPaginas() < $paginaActual){
            Response::redirect('/kta-admin/categorias?page=1');
        }

        $categories = Category::pagination($paginacion->registrosPorPagina, $paginacion->offset())??[];
        


        Response::render('admin/categorias/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin categorias',
            'categories'=>$categories,
            'paginacion'=>$paginacion->paginacion()
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
        
        $queryParams = Request::getQueryParams();
        $paginaActual = filter_var($queryParams['page']??'', FILTER_VALIDATE_INT);

        if(!$paginaActual || $paginaActual < 1){
            Response::redirect('/kta-admin/pago-membresias?page=1');
        }

        $total = PaymentMembershipView::count('id_membership_student');
        $paginacion = new Paginador($paginaActual, $total);

        if($paginacion->totalPaginas() < $paginaActual){
            Response::redirect('/kta-admin/pago-membresias?page=1');
        }

        $pagos = PaymentMembershipView::pagination($paginacion->registrosPorPagina, $paginacion->offset())??[];


        Response::render('admin/membresia/pagos', [
            'nameApp' => APP_NAME,
            'title' => 'Pagos membresias',
            'pagos'=>$pagos,
            'paginacion'=>$paginacion->paginacion()
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

        $queryParams = Request::getQueryParams();
        $paginaActual = filter_var($queryParams['page']??'', FILTER_VALIDATE_INT);

        if(!$paginaActual || $paginaActual < 1){
            Response::redirect('/kta-admin/maestros?page=1');
        }

        $total = Teacher::count('id_teacher');
        $paginacion = new Paginador($paginaActual, $total);

        if($paginacion->totalPaginas() < $paginaActual){
            Response::redirect('/kta-admin/maestros?page=1');
        }

        $teachers = Teacher::pagination($paginacion->registrosPorPagina, $paginacion->offset())??[];
        
        Response::render('admin/maestros/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin maestros',
            'teachers' => $teachers,
            'paginacion'=>$paginacion->paginacion()
        ]);
    }

    public static function students():void{

        $queryParams = Request::getQueryParams();
        $paginaActual = filter_var($queryParams['page']??'', FILTER_VALIDATE_INT);

        if(!$paginaActual || $paginaActual < 1){
            Response::redirect('/kta-admin/estudiantes?page=1');
        }

        $total = Student::count('id_student');
        $paginacion = new Paginador($paginaActual, $total);

        if($paginacion->totalPaginas() < $paginaActual){
            Response::redirect('/kta-admin/estudiantes?page=1');
        }

        $students = Student::pagination($paginacion->registrosPorPagina, $paginacion->offset())??[];
    
        Response::render('admin/estudiantes/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin estudiantes',
            'students' => $students,
            'paginacion'=>$paginacion->paginacion()
        ]);
    }

    public static function admins():void{

        $queryParams = Request::getQueryParams();
        $paginaActual = filter_var($queryParams['page']??'', FILTER_VALIDATE_INT);

        if(!$paginaActual || $paginaActual < 1){
            Response::redirect('/kta-admin/administradores?page=1');
        }

        $total = Admin::count('id_admin');
        $paginacion = new Paginador($paginaActual, $total);

        if($paginacion->totalPaginas() < $paginaActual){
            Response::redirect('/kta-admin/administradores?page=1');
        }

        $admins = Admin::pagination($paginacion->registrosPorPagina, $paginacion->offset())??[];
        
        Response::render('admin/administradores/index', [
            'nameApp' => APP_NAME,
            'title' => 'Admin de super usuarios',
            'admins' => $admins,
            'paginacion'=>$paginacion->paginacion()
        ]);
    }
}