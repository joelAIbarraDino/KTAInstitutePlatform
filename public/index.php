<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Middlewares\ExistsCategoryMiddleware;
use App\Middlewares\ExistsTeacherMiddleware;
use App\Controllers\CategoryController;
use App\Controllers\AccountController;
use App\Controllers\CourseController;
use App\Controllers\PagesController;
use App\Controllers\AdminController;
use App\Controllers\AdminsController;
use App\Controllers\ContentController;
use App\Controllers\SlidebarController;
use App\Controllers\StudentController;
use App\Controllers\TeacherController;
use App\Middlewares\ExistsCourseMiddleware;
use App\Middlewares\ExistsModuleMiddleware;
use App\Middlewares\ValidIdMiddleware;
use DinoEngine\Core\Database;
use DinoFrame\Dino;
use Dotenv\Dotenv;

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

$dino->router->get('/kta-admin/dashboard', [AdminController::class, 'index']);
$dino->router->get('/kta-admin/cursos', [AdminController::class, 'courses']);
$dino->router->get('/kta-admin/categorias', [AdminController::class, 'categories']);
$dino->router->get('/kta-admin/inscripciones', [AdminController::class, 'enrollment']);
$dino->router->get('/kta-admin/slidebar', [AdminController::class, 'slidebar']);
$dino->router->get('/kta-admin/maestros', [AdminController::class, 'teachers']);
$dino->router->get('/kta-admin/administradores', [AdminController::class, 'admins']);
$dino->router->get('/kta-admin/estudiantes', [AdminController::class, 'students']);

//administración de cursos
$dino->router->get('/kta-admin/curso/create', 
    [CourseController::class, 'create'], 
    [new ExistsCategoryMiddleware('/kta-admin/categoria/create'), new ExistsTeacherMiddleware('/kta-admin/maestro/create')]
);
$dino->router->post('/kta-admin/curso/create', [CourseController::class, 'create']);

$dino->router->get('/kta-admin/curso/update/{id}', [CourseController::class, 'update']);
$dino->router->post('/kta-admin/curso/update/{id}', [CourseController::class, 'update']);

$dino->router->delete('/api/curso/delete/{id}', [CourseController::class, 'delete']);

//administracion de contenido de curso
$dino->router->get('/kta-admin/course-content/{id}', [ContentController::class, 'content'], [ValidIdMiddleware::class, new ExistsCourseMiddleware('/kta-admin/cursos')]);
// $dino->router->get('/kta-admin/vimeo-test', [ContentController::class, 'testVimeo']);

//administración de modulos de curso
$dino->router->get('/api/modules/get/{id}', [ContentController::class, 'getModules'], [ValidIdMiddleware::class]);

$dino->router->post('/api/module/create/{id}', [ContentController::class, 'createModule'], [ValidIdMiddleware::class]);

$dino->router->patch('/api/module/order_module/{id}', [ContentController::class, 'updateOrderModule'], [ValidIdMiddleware::class, ExistsModuleMiddleware::class]);
$dino->router->patch('/api/module/name/{id}', [ContentController::class, 'updateNameModule'], [ValidIdMiddleware::class, ExistsModuleMiddleware::class]);

$dino->router->delete('/api/module/delete/{id}', [ContentController::class, 'deleteModule'], [ValidIdMiddleware::class, ExistsModuleMiddleware::class]);

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
$dino->router->get('/kta-admin/administrador/create', [AdminsController::class, 'create']);
$dino->router->post('/kta-admin/administrador/create', [AdminsController::class, 'create']);

$dino->router->get('/kta-admin/administrador/update/{id}', [AdminsController::class, 'update']);
$dino->router->post('/kta-admin/administrador/update/{id}', [AdminsController::class, 'update']);

$dino->router->delete('/api/administrador/delete/{id}', [AdminsController::class, 'delete']);

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
