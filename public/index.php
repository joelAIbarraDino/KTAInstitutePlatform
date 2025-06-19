<?php

require __DIR__ . '/../vendor/autoload.php';

use DinoEngine\Core\Database;
use DinoFrame\Dino;
use Dotenv\Dotenv;

use App\Middlewares\ExistsCategoryMiddleware;
use App\Middlewares\ExistsTeacherMiddleware;
use App\Middlewares\ExistsModuleMiddleware;
use App\Middlewares\ExistsCourseMiddleware;
use App\Middlewares\ExistsLessonMiddleware;
use App\Middlewares\ExistsFaqMiddleware;
use App\Middlewares\ValidIdMiddleware;

use App\Controllers\DashboardController;
use App\Controllers\CategoryController;
use App\Controllers\SlidebarController;
use App\Controllers\AccountController;
use App\Controllers\ContentController;
use App\Controllers\StudentController;
use App\Controllers\TeacherController;
use App\Controllers\CourseController;
use App\Controllers\ModuleController;
use App\Controllers\LessonController;
use App\Controllers\PagesController;
use App\Controllers\AdminController;
use App\Controllers\FaqController;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

date_default_timezone_set('America/Mexico_City');

define('APP_NAME','KTA Institute');
define('DIR_CARATULAS',__DIR__.'/assets/thumbnails/');
define('DIR_PROFESORES',__DIR__.'/assets/teachers/');
define('DIR_SLIDEBAR',__DIR__.'/assets/slidebar/');

$dbConfig = [
    "host"=>$_ENV['DB_HOST'],
    "port"=>$_ENV['DB_PORT'],
    "user"=>$_ENV['DB_USER'],
    "password"=>$_ENV['DB_PASS'],
    "database"=>$_ENV['DB_DATABASE'],
    "driver"=>Database::PDO_DRIVER
];

$dino = new Dino(dirname(__DIR__), Dino::DEVELOPMENT_MODE, $dbConfig);

//public zone
$dino->router->get('/', [PagesController::class, 'index']);
$dino->router->get('/curso/view/{id}', [PagesController::class, 'courseDetails']);
$dino->router->get('/profesor/view/{id}', [PagesController::class, 'teacherDetails']);
$dino->router->get('/curso/payment/{id}', function($id){
    echo 'proceso de pago de curso: '. $id;
});

$dino->router->get('/cursos', [PagesController::class, 'courses']);
$dino->router->get('/cursos/categoria/{category_url}', [PagesController::class, 'courseCategory']);

$dino->router->get('/nosotros', [PagesController::class, 'about']);

//login sign-in and sign-up
$dino->router->get('/login', [AccountController::class, 'login']);
$dino->router->post('/login', [AccountController::class, 'login']);

$dino->router->get('/forgot', [AccountController::class, 'forgot']);
$dino->router->post('/forgot', [AccountController::class, 'forgot']);

$dino->router->get('/sign-in', [AccountController::class, 'signin']);
$dino->router->post('/sign-in', [AccountController::class, 'signin']);

$dino->router->get('/kta-admin/dashboard', [DashboardController::class, 'index']);
$dino->router->get('/kta-admin/cursos', [DashboardController::class, 'courses']);
$dino->router->get('/kta-admin/categorias', [DashboardController::class, 'categories']);
$dino->router->get('/kta-admin/inscripciones', [DashboardController::class, 'enrollment']);
$dino->router->get('/kta-admin/slidebar', [DashboardController::class, 'slidebar']);
$dino->router->get('/kta-admin/maestros', [DashboardController::class, 'teachers']);
$dino->router->get('/kta-admin/administradores', [DashboardController::class, 'admins']);
$dino->router->get('/kta-admin/estudiantes', [DashboardController::class, 'students']);

//administración de cursos
$dino->router->get('/kta-admin/curso/create', 
    [CourseController::class, 'create'], 
    [new ExistsCategoryMiddleware('/kta-admin/categoria/create'), new ExistsTeacherMiddleware('/kta-admin/maestro/create')]
);
$dino->router->post('/kta-admin/curso/create', [CourseController::class, 'create']);

$dino->router->get('/kta-admin/curso/update/{id}', [CourseController::class, 'update']);
$dino->router->post('/kta-admin/curso/update/{id}', [CourseController::class, 'update']);

$dino->router->patch('/api/curso/privacy/{id}', [CourseController::class, 'updatePrivacy'], [ValidIdMiddleware::class, ExistsCourseMiddleware::class]);

$dino->router->delete('/api/curso/delete/{id}', [CourseController::class, 'delete']);

//administracion de contenido de curso
$dino->router->get('/kta-admin/course-content/{id}', [ContentController::class, 'content'], [ValidIdMiddleware::class, new ExistsCourseMiddleware('/kta-admin/cursos')]);
$dino->router->get('/kta-admin/course-faq/{id}', [ContentController::class, 'faq'], [ValidIdMiddleware::class, new ExistsCourseMiddleware('/kta-admin/cursos')]);

//administración de modulos de curso
$dino->router->get('/api/curso/content/{id}', [ContentController::class, 'getContent'], [ValidIdMiddleware::class]);

$dino->router->post('/api/module/create/{id}', [ModuleController::class, 'create'], [ValidIdMiddleware::class]);

$dino->router->patch('/api/module/order_module/{id}', [ModuleController::class, 'updateOrder'], [ValidIdMiddleware::class, ExistsModuleMiddleware::class]);
$dino->router->patch('/api/module/name/{id}', [ModuleController::class, 'updateName'], [ValidIdMiddleware::class, ExistsModuleMiddleware::class]);

$dino->router->delete('/api/module/delete/{id}', [ModuleController::class, 'delete'], [ValidIdMiddleware::class, ExistsModuleMiddleware::class]);

//administración de lecciones de curso
$dino->router->post('/api/lesson/create/{id}', [LessonController::class, 'create'], [ValidIdMiddleware::class]);

$dino->router->put('/api/lesson/update/{id}', [LessonController::class, 'update'], [ValidIdMiddleware::class, ExistsLessonMiddleware::class]);

$dino->router->delete('/api/lesson/delete/{id}', [LessonController::class, 'delete'], [ValidIdMiddleware::class, ExistsLessonMiddleware::class]);

//administración de FAQ de curso
$dino->router->get('/api/faq/{id}', [ContentController::class, 'getFAQ'], [ValidIdMiddleware::class]);

$dino->router->post('/api/faq/create/{id}', [FaqController::class, 'create'], [ValidIdMiddleware::class, ExistsCourseMiddleware::class]);

$dino->router->patch('/api/faq/question/{id}', [FaqController::class, 'updateQuestion'], [ValidIdMiddleware::class, ExistsFaqMiddleware::class]);
$dino->router->patch('/api/faq/answer/{id}', [FaqController::class, 'updateAnswer'], [ValidIdMiddleware::class, ExistsFaqMiddleware::class]);

$dino->router->delete('/api/faq/delete/{id}', [FaqController::class, 'delete'], [ValidIdMiddleware::class, ExistsFaqMiddleware::class]);

//administración de categoria
$dino->router->get('/kta-admin/categoria/create', [CategoryController::class, 'create']);
$dino->router->post('/kta-admin/categoria/create', [CategoryController::class, 'create']);

$dino->router->get('/kta-admin/categoria/update/{id}', [CategoryController::class, 'update']);
$dino->router->post('/kta-admin/categoria/update/{id}', [CategoryController::class, 'update']);

$dino->router->delete('/api/categoria/delete/{id}', [CategoryController::class, 'delete']);

//administración de maestros
$dino->router->get('/kta-admin/maestro/create', [TeacherController::class, 'create']);
$dino->router->post('/kta-admin/maestro/create', [TeacherController::class, 'create']);

$dino->router->get('/kta-admin/maestro/update/{id}', [TeacherController::class, 'update']);
$dino->router->post('/kta-admin/maestro/update/{id}', [TeacherController::class, 'update']);

$dino->router->delete('/api/maestro/delete/{id}', [TeacherController::class, 'delete']);

//administración de administradores
$dino->router->get('/kta-admin/administrador/create', [AdminController::class, 'create']);
$dino->router->post('/kta-admin/administrador/create', [AdminController::class, 'create']);

$dino->router->get('/kta-admin/administrador/update/{id}', [AdminController::class, 'update']);
$dino->router->post('/kta-admin/administrador/update/{id}', [AdminController::class, 'update']);

$dino->router->delete('/api/administrador/delete/{id}', [AdminController::class, 'delete']);

//administración de estudiante
$dino->router->get('/kta-admin/estudiante/create', [StudentController::class, 'create']);
$dino->router->post('/kta-admin/estudiante/create', [StudentController::class, 'create']);

$dino->router->get('/kta-admin/estudiante/update/{id}', [StudentController::class, 'update']);
$dino->router->post('/kta-admin/estudiante/update/{id}', [StudentController::class, 'update']);

$dino->router->delete('/api/estudiante/delete/{id}', [StudentController::class, 'delete']);


//administración de slidebar
$dino->router->get('/kta-admin/slidebar/create', [SlidebarController::class, 'create']);
$dino->router->post('/kta-admin/slidebar/create', [SlidebarController::class, 'create']);

$dino->router->get('/kta-admin/slidebar/update/{id}', [SlidebarController::class, 'update']);
$dino->router->post('/kta-admin/slidebar/update/{id}', [SlidebarController::class, 'update']);

$dino->router->delete('/api/slidebar/delete/{id}', [SlidebarController::class, 'delete']);

$dino->router->dispatch();
