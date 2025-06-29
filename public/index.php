<?php

require __DIR__ . '/../vendor/autoload.php';

use DinoEngine\Core\Database;
use DinoFrame\Dino;
use Dotenv\Dotenv;

use App\Middlewares\ExistsCategoryMiddleware;
use App\Middlewares\StudentLoggedMiddleware;
use App\Middlewares\EnrollExpiredMiddleware;
use App\Middlewares\ExistsTeacherMiddleware;
use App\Middlewares\PublicCourseMiddleware;
use App\Middlewares\ExistsModuleMiddleware;
use App\Middlewares\ExistsCourseMiddleware;
use App\Middlewares\ExistsLessonMiddleware;
use App\Middlewares\AdminLoggedMiddleware;
use App\Middlewares\ExistsQuizMiddleware;
use App\Middlewares\ExistsFaqMiddleware;
use App\Middlewares\ValidIdMiddleware;

use App\Controllers\AuthProvidersController;
use App\Controllers\EnrollmentController;
use App\Controllers\DashboardController;
use App\Controllers\CategoryController;
use App\Controllers\SlidebarController;
use App\Controllers\ContentController;
use App\Controllers\StudentController;
use App\Controllers\TeacherController;
use App\Controllers\CourseController;
use App\Controllers\ModuleController;
use App\Controllers\LessonController;
use App\Controllers\PagesController;
use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\FaqController;
use App\Controllers\QuizController;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

date_default_timezone_set('America/Mexico_City');

define('APP_NAME','KTA Institute');
define('DIR_CARATULAS',__DIR__.'/assets/thumbnails/');
define('DIR_PROFESORES',__DIR__.'/assets/teachers/');
define('DIR_SLIDEBAR',__DIR__.'/assets/slidebar/');
define('URI_REDIRECT_GOOGLE', 'http://localhost:3000/auth/google-callback');

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
$dino->router->get('/curso/view/{id}', [PagesController::class, 'courseDetails'], [new PublicCourseMiddleware('/')]);
$dino->router->get('/profesor/view/{id}', [PagesController::class, 'teacherDetails']);
$dino->router->get('/curso/payment/{id}', [EnrollmentController::class, 'createEnrollment'], [new StudentLoggedMiddleware('/login')]);

$dino->router->get('/cursos', [PagesController::class, 'courses']);
$dino->router->get('/cursos/categoria/{category_url}', [PagesController::class, 'courseCategory']);

$dino->router->get('/nosotros', [PagesController::class, 'about']);

//login sign-in and sign-up
$dino->router->get('/login', [AuthController::class, 'login'], [new StudentLoggedMiddleware('/login')]);


//rutas de autenticacion
$dino->router->post('/auth/login-callback', [AuthController::class, 'ktaAuth']);
$dino->router->post('/auth/login-callback-admin', [AuthController::class, 'ktaAuthAdmin']);
$dino->router->post('/auth/google-callback', [AuthProvidersController::class, 'googleAuth']);

$dino->router->get('/forgot', [AuthController::class, 'forgot'], [new StudentLoggedMiddleware('/login')]);
$dino->router->post('/forgot', [AuthController::class, 'forgot']);

$dino->router->get('/sign-in', [AuthController::class, 'signIn']);
$dino->router->post('/auth/sign-in', [StudentController::class, 'signIn']);

$dino->router->get('/logout', [AuthController::class, 'logout']);

//zona privada del estudiante
$dino->router->get('/mis-cursos', [UserController::class, 'cursos'], [new StudentLoggedMiddleware('/login')]);
$dino->router->get('/mi-perfil', [UserController::class, 'profile'], [new StudentLoggedMiddleware('/login')]);
$dino->router->get('/editar-perfil', [UserController::class, 'editProfile'], [new StudentLoggedMiddleware('/login')]);

//salón virtual
$dino->router->get('/curso/watch/{uuid}', [EnrollmentController::class, 'index'], [new StudentLoggedMiddleware('/login'), EnrollExpiredMiddleware::class]);
// $dino->router->get('/curso/watch', [EnrollmentController::class, 'index']);


//login admin
$dino->router->get('/login-admin', [AuthController::class, 'loginAdmin'], [new AdminLoggedMiddleware('/login')]);

//zona privada de administrador
$dino->router->get('/kta-admin/dashboard', [DashboardController::class, 'index'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->get('/kta-admin/cursos', [DashboardController::class, 'courses'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->get('/kta-admin/categorias', [DashboardController::class, 'categories'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->get('/kta-admin/inscripciones', [DashboardController::class, 'enrollment'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->get('/kta-admin/slidebar', [DashboardController::class, 'slidebar'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->get('/kta-admin/maestros', [DashboardController::class, 'teachers'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->get('/kta-admin/administradores', [DashboardController::class, 'admins'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->get('/kta-admin/estudiantes', [DashboardController::class, 'students'], [new AdminLoggedMiddleware('/login-admin')]);

//administración de cursos
$dino->router->get('/kta-admin/curso/create', 
    [CourseController::class, 'create'], 
    [new AdminLoggedMiddleware('/login-admin'), new ExistsCategoryMiddleware('/kta-admin/categoria/create'), new ExistsTeacherMiddleware('/kta-admin/maestro/create')]
);
$dino->router->post('/kta-admin/curso/create', [CourseController::class, 'create'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->get('/kta-admin/curso/update/{id}', [CourseController::class, 'update'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->post('/kta-admin/curso/update/{id}', [CourseController::class, 'update'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->patch('/api/curso/privacy/{id}', [CourseController::class, 'updatePrivacy'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, ExistsCourseMiddleware::class]);

$dino->router->delete('/api/curso/delete/{id}', [CourseController::class, 'delete'], [new AdminLoggedMiddleware('/login-admin')]);

//administracion de contenido de curso
$dino->router->get('/kta-admin/course-content/{id}', [ContentController::class, 'content'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, new ExistsCourseMiddleware('/kta-admin/cursos')]);
$dino->router->get('/kta-admin/course-faq/{id}', [ContentController::class, 'faq'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, new ExistsCourseMiddleware('/kta-admin/cursos')]);
$dino->router->get('/kta-admin/course-quiz/{id}', [ContentController::class, 'quiz'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, new ExistsCourseMiddleware('/kta-admin/cursos')]);

//administración de modulos de curso
$dino->router->get('/api/curso/content/{id}', [ContentController::class, 'getContent'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class]);

$dino->router->post('/api/module/create/{id}', [ModuleController::class, 'create'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class]);

$dino->router->patch('/api/module/order_module/{id}', [ModuleController::class, 'updateOrder'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, ExistsModuleMiddleware::class]);
$dino->router->patch('/api/module/name/{id}', [ModuleController::class, 'updateName'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, ExistsModuleMiddleware::class]);

$dino->router->delete('/api/module/delete/{id}', [ModuleController::class, 'delete'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, ExistsModuleMiddleware::class]);

//administración de lecciones de curso
$dino->router->post('/api/lesson/create/{id}', [LessonController::class, 'create'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class]);

$dino->router->put('/api/lesson/update/{id}', [LessonController::class, 'update'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, ExistsLessonMiddleware::class]);

$dino->router->delete('/api/lesson/delete/{id}', [LessonController::class, 'delete'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, ExistsLessonMiddleware::class]);

//administración de FAQ de curso
$dino->router->get('/api/faq/{id}', [ContentController::class, 'getFAQ'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class]);

$dino->router->post('/api/faq/create/{id}', [FaqController::class, 'create'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, ExistsCourseMiddleware::class]);

$dino->router->patch('/api/faq/question/{id}', [FaqController::class, 'updateQuestion'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, ExistsFaqMiddleware::class]);
$dino->router->patch('/api/faq/answer/{id}', [FaqController::class, 'updateAnswer'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, ExistsFaqMiddleware::class]);

$dino->router->delete('/api/faq/delete/{id}', [FaqController::class, 'delete'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, ExistsFaqMiddleware::class]);

//administración de preguntas en el quiz del curso
$dino->router->get('/api/quiz/{id}', [ContentController::class, 'getQuiz'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class]);

$dino->router->post('/api/quiz/create/{id}', [QuizController::class, 'create'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, ExistsCourseMiddleware::class]);

$dino->router->put('/api/quiz/update/{id}', [QuizController::class, 'update'], [new AdminLoggedMiddleware('/login-admin'), ValidIdMiddleware::class, ExistsQuizMiddleware::class]);

//administración de categoria
$dino->router->get('/kta-admin/categoria/create', [CategoryController::class, 'create'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->post('/kta-admin/categoria/create', [CategoryController::class, 'create'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->get('/kta-admin/categoria/update/{id}', [CategoryController::class, 'update'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->post('/kta-admin/categoria/update/{id}', [CategoryController::class, 'update'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->delete('/api/categoria/delete/{id}', [CategoryController::class, 'delete'], [new AdminLoggedMiddleware('/login-admin')]);

//administración de maestros
$dino->router->get('/kta-admin/maestro/create', [TeacherController::class, 'create'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->post('/kta-admin/maestro/create', [TeacherController::class, 'create'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->get('/kta-admin/maestro/update/{id}', [TeacherController::class, 'update'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->post('/kta-admin/maestro/update/{id}', [TeacherController::class, 'update'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->delete('/api/maestro/delete/{id}', [TeacherController::class, 'delete'], [new AdminLoggedMiddleware('/login-admin')]);

//administración de administradores
$dino->router->get('/kta-admin/administrador/create', [AdminController::class, 'create'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->post('/kta-admin/administrador/create', [AdminController::class, 'create'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->get('/kta-admin/administrador/update/{id}', [AdminController::class, 'update'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->post('/kta-admin/administrador/update/{id}', [AdminController::class, 'update'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->delete('/api/administrador/delete/{id}', [AdminController::class, 'delete'], [new AdminLoggedMiddleware('/login-admin')]);

//administración de estudiante
$dino->router->get('/kta-admin/estudiante/create', [StudentController::class, 'create'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->post('/kta-admin/estudiante/create', [StudentController::class, 'create'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->get('/kta-admin/estudiante/update/{id}', [StudentController::class, 'update'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->post('/kta-admin/estudiante/update/{id}', [StudentController::class, 'update'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->delete('/api/estudiante/delete/{id}', [StudentController::class, 'delete'], [new AdminLoggedMiddleware('/login-admin')]);


//administración de slidebar
$dino->router->get('/kta-admin/slidebar/create', [SlidebarController::class, 'create'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->post('/kta-admin/slidebar/create', [SlidebarController::class, 'create'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->get('/kta-admin/slidebar/update/{id}', [SlidebarController::class, 'update'], [new AdminLoggedMiddleware('/login-admin')]);
$dino->router->post('/kta-admin/slidebar/update/{id}', [SlidebarController::class, 'update'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->delete('/api/slidebar/delete/{id}', [SlidebarController::class, 'delete'], [new AdminLoggedMiddleware('/login-admin')]);

$dino->router->dispatch();
