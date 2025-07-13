<?php

require __DIR__ . '/../vendor/autoload.php';

use DinoEngine\Core\Database;
use DinoFrame\Dino;
use Dotenv\Dotenv;

use App\Middlewares\ExistsOptionQuestionMiddleware;
use App\Middlewares\ExistsCategoryMiddleware;
use App\Middlewares\ExistsQuestionMiddleware;
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

use App\Controllers\OptionQuestionController;
use App\Controllers\AuthProvidersController;
use App\Controllers\AnswerStudentController;
use App\Controllers\EnrollmentController;
use App\Controllers\MembershipController;
use App\Controllers\DashboardController;
use App\Controllers\PaymentController;
use App\Controllers\CategoryController;
use App\Controllers\SlidebarController;
use App\Controllers\QuestionController;
use App\Controllers\ContentController;
use App\Controllers\StudentController;
use App\Controllers\AttemptController;
use App\Controllers\TeacherController;
use App\Controllers\CourseController;
use App\Controllers\ModuleController;
use App\Controllers\LessonController;
use App\Controllers\PagesController;
use App\Controllers\AdminController;
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\QuizController;
use App\Controllers\FaqController;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

date_default_timezone_set('America/Mexico_City');

define('APP_NAME','KTA Institute');
define('DIR_CARATULAS',__DIR__.'/assets/thumbnails/');
define('DIR_FONDO_CURSO',__DIR__.'/assets/background-courses/');
define('DIR_MEMBRESIAS',__DIR__.'/assets/membresias/');
define('DIR_PROFESORES',__DIR__.'/assets/teachers/');
define('DIR_SLIDEBAR_PICTURE',__DIR__.'/assets/slidebar/');
define('DIR_GIF',__DIR__.'/assets/gifs/');
define('URI_REDIRECT_GOOGLE', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/auth/google-callback');

define('REDIRECT_SUCCESS_STRIPE', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/pago-exitoso?session_id={CHECKOUT_SESSION_ID}');
define('REDIRECT_CANCEL_STRIPE', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/cursos');

$dbConfig = [
    "host"=>$_ENV['DB_HOST'],
    "port"=>$_ENV['DB_PORT'],
    "user"=>$_ENV['DB_USER'],
    "password"=>$_ENV['DB_PASS'],
    "database"=>$_ENV['DB_DATABASE'],
    "driver"=>Database::PDO_DRIVER
];

$runMode = $_SERVER['HTTP_HOST'] == 'localhost:3000'?Dino::DEVELOPMENT_MODE:Dino::PRODUCTION_MODE;

$dino = new Dino(dirname(__DIR__), $runMode, $dbConfig);

//public zone
$dino->router->get('/', [PagesController::class, 'index']);

$dino->router->get('/cursos', [PagesController::class, 'courses']);
$dino->router->get('/cursos/categoria/{category_url}', [PagesController::class, 'courseCategory']);

$dino->router->get('/curso/view/{id}', [PagesController::class, 'courseDetails'], [new PublicCourseMiddleware('/')]);

$dino->router->get('/profesor/view/{id}', [PagesController::class, 'teacherDetails']);


$dino->router->get('/membresias', [PagesController::class, 'membership']);

//proceso de pago de curso
$dino->router->get('/curso/checkout/{id}', [PaymentController::class, 'checkoutCourse']);
$dino->router->get('/membresia/checkout/{id}', [PaymentController::class, 'checkoutMembership']);
$dino->router->get('/pago-exitoso', [PaymentController::class, 'success']);
$dino->router->post('/webhook-stripe', [PaymentController::class, 'webhook']);

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
$dino->router->get('/cursos-pasados', [UserController::class, 'endedCourses'], [new StudentLoggedMiddleware('/login')]);
$dino->router->get('/mi-perfil', [UserController::class, 'profile'], [new StudentLoggedMiddleware('/login')]);
$dino->router->get('/editar-perfil', [UserController::class, 'editProfile'], [new StudentLoggedMiddleware('/login')]);
$dino->router->get('/seguridad-acceso', [UserController::class, 'security'], [new StudentLoggedMiddleware('/login')]);

//salón virtual
$dino->router->get('/api/curso/enroll/{uuid}', [EnrollmentController::class, 'getStudentContent'], [new StudentLoggedMiddleware('/login'), EnrollExpiredMiddleware::class]);

//$dino->router->post('/api/progress/new/{uuid}', [EnrollmentController::class, 'newProgress'], [new StudentLoggedMiddleware('/login'), EnrollExpiredMiddleware::class]);

$dino->router->get('/curso/watch/{uuid}', [EnrollmentController::class, 'index'], [new StudentLoggedMiddleware('/login'), EnrollExpiredMiddleware::class]);

$dino->router->get('/quiz/attempts/{uuid}', [EnrollmentController::class, 'attempts'], [new StudentLoggedMiddleware('/login'), EnrollExpiredMiddleware::class]);
$dino->router->get('/quiz/answer/{uuid}/{id}', [AttemptController::class, 'responseQuiz'], [new StudentLoggedMiddleware('/login'), EnrollExpiredMiddleware::class, ValidIdMiddleware::class]);
$dino->router->get('/api/quiz/attempt/{id}', [AttemptController::class, 'getQuiz'], [new StudentLoggedMiddleware('/login'), ValidIdMiddleware::class]);

$dino->router->get('/quiz/success/{id}', [AttemptController::class, 'successQuiz'], [new StudentLoggedMiddleware('/login'), ValidIdMiddleware::class]);
$dino->router->get('/quiz/failed', [AttemptController::class, 'failedQuiz'], [new StudentLoggedMiddleware('/login')]);
$dino->router->get('/quiz/completed', [AttemptController::class, 'completedQuiz'], [new StudentLoggedMiddleware('/login')]);
$dino->router->get('/certificado/{id}', [AttemptController::class, 'showDiploma'], [new StudentLoggedMiddleware('/login'), ValidIdMiddleware::class]);

$dino->router->post('/attempts/create/{uuid}', [AttemptController::class, 'createAttempt'], [new StudentLoggedMiddleware('/login'), EnrollExpiredMiddleware::class]);


//login admin
$dino->router->get('/login-admin', [AuthController::class, 'loginAdmin'], [AdminLoggedMiddleware::class]);

//zona privada de administrador
$dino->router->get('/kta-admin/dashboard', [DashboardController::class, 'index'], [AdminLoggedMiddleware::class]);
$dino->router->get('/kta-admin/cursos', [DashboardController::class, 'courses'], [AdminLoggedMiddleware::class]);
$dino->router->get('/kta-admin/pago-cursos', [DashboardController::class, 'paymentCourses'], [AdminLoggedMiddleware::class]);
$dino->router->get('/kta-admin/categorias', [DashboardController::class, 'categories'], [AdminLoggedMiddleware::class]);
$dino->router->get('/kta-admin/membresias', [DashboardController::class, 'memberships'], [AdminLoggedMiddleware::class]);
$dino->router->get('/kta-admin/pago-membresias', [DashboardController::class, 'paymentMemberships'], [AdminLoggedMiddleware::class]);
$dino->router->get('/kta-admin/estudiante-membresia', [DashboardController::class, 'studentMemberships'], [AdminLoggedMiddleware::class]);
$dino->router->get('/kta-admin/inscripciones', [DashboardController::class, 'enrollment'], [AdminLoggedMiddleware::class]);
$dino->router->get('/kta-admin/slidebar', [DashboardController::class, 'slidebar'], [AdminLoggedMiddleware::class]);
$dino->router->get('/kta-admin/maestros', [DashboardController::class, 'teachers'], [AdminLoggedMiddleware::class]);
$dino->router->get('/kta-admin/administradores', [DashboardController::class, 'admins'], [AdminLoggedMiddleware::class]);
$dino->router->get('/kta-admin/estudiantes', [DashboardController::class, 'students'], [AdminLoggedMiddleware::class]);

//administración de cursos
$dino->router->get('/kta-admin/curso/create', 
    [CourseController::class, 'create'], 
    [AdminLoggedMiddleware::class, new ExistsCategoryMiddleware('/kta-admin/categoria/create'), new ExistsTeacherMiddleware('/kta-admin/maestro/create')]
);
$dino->router->post('/kta-admin/curso/create', [CourseController::class, 'create'], [AdminLoggedMiddleware::class]);

$dino->router->get('/kta-admin/curso/update/{id}', [CourseController::class, 'update'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/curso/update/{id}', [CourseController::class, 'update'], [AdminLoggedMiddleware::class]);

$dino->router->patch('/api/curso/privacy/{id}', [CourseController::class, 'updatePrivacy'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsCourseMiddleware::class]);
$dino->router->delete('/api/curso/delete/{id}', [CourseController::class, 'delete'], [AdminLoggedMiddleware::class]);

//administracion de contenido de curso
$dino->router->get('/kta-admin/course-content/{id}', [ContentController::class, 'content'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, new ExistsCourseMiddleware('/kta-admin/cursos')]);
$dino->router->get('/kta-admin/course-faq/{id}', [ContentController::class, 'faq'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, new ExistsCourseMiddleware('/kta-admin/cursos')]);
$dino->router->get('/kta-admin/course-quiz/{id}', [ContentController::class, 'quiz'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, new ExistsCourseMiddleware('/kta-admin/cursos')]);
$dino->router->get('/kta-admin/review-quiz/{id}', [ContentController::class, 'reviewAttempts'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);
$dino->router->get('/kta-admin/attempts-quiz/{id}', [ContentController::class, 'attempts'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);

//administración de modulos de curso
$dino->router->get('/api/curso/content/{id}', [ContentController::class, 'getContent'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);

$dino->router->post('/api/module/create/{id}', [ModuleController::class, 'create'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);
$dino->router->patch('/api/module/order_module/{id}', [ModuleController::class, 'updateOrder'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsModuleMiddleware::class]);
$dino->router->patch('/api/module/name/{id}', [ModuleController::class, 'updateName'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsModuleMiddleware::class]);
$dino->router->delete('/api/module/delete/{id}', [ModuleController::class, 'delete'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsModuleMiddleware::class]);

//administración de lecciones de curso
$dino->router->post('/api/lesson/create/{id}', [LessonController::class, 'create'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);
$dino->router->put('/api/lesson/update/{id}', [LessonController::class, 'update'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsLessonMiddleware::class]);
$dino->router->delete('/api/lesson/delete/{id}', [LessonController::class, 'delete'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsLessonMiddleware::class]);

//administración de FAQ de curso
$dino->router->get('/api/faq/{id}', [ContentController::class, 'getFAQ'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);
$dino->router->post('/api/faq/create/{id}', [FaqController::class, 'create'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsCourseMiddleware::class]);
$dino->router->patch('/api/faq/question/{id}', [FaqController::class, 'updateQuestion'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsFaqMiddleware::class]);
$dino->router->patch('/api/faq/answer/{id}', [FaqController::class, 'updateAnswer'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsFaqMiddleware::class]);
$dino->router->delete('/api/faq/delete/{id}', [FaqController::class, 'delete'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsFaqMiddleware::class]);

//administración de examen del curso
$dino->router->get('/api/quiz/{id}', [ContentController::class, 'getQuiz'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);
$dino->router->post('/api/quiz/create/{id}', [QuizController::class, 'create'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsCourseMiddleware::class]);
$dino->router->put('/api/quiz/update/{id}', [QuizController::class, 'update'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsQuizMiddleware::class]);

//administracion de preguntas del curso
$dino->router->post('/api/question/create/{id}', [QuestionController::class, 'create'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsQuizMiddleware::class]);
$dino->router->patch('/api/question/question/{id}', [QuestionController::class, 'updateQuestion'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsQuestionMiddleware::class]);
$dino->router->patch('/api/question/type_question/{id}', [QuestionController::class, 'updateTypeQuestion'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsQuestionMiddleware::class]);
$dino->router->delete('/api/question/delete/{id}', [QuestionController::class, 'delete'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsQuestionMiddleware::class]);

//administracion de respuestas de las preguntas del curso
$dino->router->post('/api/option_question/create/{id}', [OptionQuestionController::class, 'create'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsQuestionMiddleware::class]);
$dino->router->put('/api/option_question/update/{id}', [OptionQuestionController::class, 'update'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsOptionQuestionMiddleware::class]);
$dino->router->delete('/api/option_question/delete/{id}', [OptionQuestionController::class, 'delete'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class, ExistsOptionQuestionMiddleware::class]);

//administración de intentos de resolución de examen
$dino->router->get('/api/attempts/{id}', [ContentController::class, 'getAttempts'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);
$dino->router->get('/api/attempts/search/{id}/{attribute}/{value}', [ContentController::class, 'searchAttempts'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);
$dino->router->get('/api/review-attempts/{id}', [ContentController::class, 'getReviewAttempts'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);
$dino->router->post('/api/answer_student/{id}', [AttemptController::class, 'saveAnswerStudent'], [new StudentLoggedMiddleware('/login'), ValidIdMiddleware::class]);
$dino->router->patch('/api/attempt/checked/{id}', [AttemptController::class, 'updateChecked'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);
$dino->router->delete('/api/attempt/delete/{id}', [AttemptController::class , 'delete'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);
$dino->router->delete('/api/attempt/cancel/{id}', [AttemptController::class, 'cancelAttempt'], [new StudentLoggedMiddleware('/login'), ValidIdMiddleware::class]);

//administracion de answer student
$dino->router->patch('/api/answer_student/is_correct/{id}', [AnswerStudentController::class, 'updateCorrectAnswer'], [AdminLoggedMiddleware::class, ValidIdMiddleware::class]);

//administración de categoria
$dino->router->get('/kta-admin/categoria/create', [CategoryController::class, 'create'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/categoria/create', [CategoryController::class, 'create'], [AdminLoggedMiddleware::class]);

$dino->router->get('/kta-admin/categoria/update/{id}', [CategoryController::class, 'update'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/categoria/update/{id}', [CategoryController::class, 'update'], [AdminLoggedMiddleware::class]);

$dino->router->delete('/api/categoria/delete/{id}', [CategoryController::class, 'delete'], [AdminLoggedMiddleware::class]);

//administración de maestros
$dino->router->get('/kta-admin/maestro/create', [TeacherController::class, 'create'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/maestro/create', [TeacherController::class, 'create'], [AdminLoggedMiddleware::class]);

$dino->router->get('/kta-admin/maestro/update/{id}', [TeacherController::class, 'update'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/maestro/update/{id}', [TeacherController::class, 'update'], [AdminLoggedMiddleware::class]);

$dino->router->delete('/api/maestro/delete/{id}', [TeacherController::class, 'delete'], [AdminLoggedMiddleware::class]);

//administración de administradores
$dino->router->get('/kta-admin/administrador/create', [AdminController::class, 'create'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/administrador/create', [AdminController::class, 'create'], [AdminLoggedMiddleware::class]);

$dino->router->get('/kta-admin/administrador/update/{id}', [AdminController::class, 'update'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/administrador/update/{id}', [AdminController::class, 'update'], [AdminLoggedMiddleware::class]);

$dino->router->delete('/api/administrador/delete/{id}', [AdminController::class, 'delete'], [AdminLoggedMiddleware::class]);

//administración de estudiante
$dino->router->get('/kta-admin/estudiante/create', [StudentController::class, 'create'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/estudiante/create', [StudentController::class, 'create'], [AdminLoggedMiddleware::class]);

$dino->router->get('/kta-admin/estudiante/update/{id}', [StudentController::class, 'update'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/estudiante/update/{id}', [StudentController::class, 'update'], [AdminLoggedMiddleware::class]);

$dino->router->patch('/api/student/name/{id}', [StudentController::class, 'updateName'], [new StudentLoggedMiddleware('/login'), ValidIdMiddleware::class]);
$dino->router->patch('/api/student/password/{id}', [StudentController::class, 'updatePassword'], [new StudentLoggedMiddleware('/login'), ValidIdMiddleware::class]);


$dino->router->delete('/api/estudiante/delete/{id}', [StudentController::class, 'delete'], [AdminLoggedMiddleware::class]);

//administración de slidebar
$dino->router->get('/kta-admin/slidebar/create', [SlidebarController::class, 'create'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/slidebar/create', [SlidebarController::class, 'create'], [AdminLoggedMiddleware::class]);

$dino->router->get('/kta-admin/slidebar/update/{id}', [SlidebarController::class, 'update'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/slidebar/update/{id}', [SlidebarController::class, 'update'], [AdminLoggedMiddleware::class]);

$dino->router->delete('/api/slidebar/delete/{id}', [SlidebarController::class, 'delete'], [AdminLoggedMiddleware::class]);

//administración de membership
$dino->router->get('/kta-admin/membresia/create', [MembershipController::class, 'create'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/membresia/create', [MembershipController::class, 'create'], [AdminLoggedMiddleware::class]);

$dino->router->get('/kta-admin/membresia/update/{id}', [MembershipController::class, 'update'], [AdminLoggedMiddleware::class]);
$dino->router->post('/kta-admin/membresia/update/{id}', [MembershipController::class, 'update'], [AdminLoggedMiddleware::class]);

$dino->router->delete('/api/membresia/delete/{id}', [MembershipController::class, 'delete'], [AdminLoggedMiddleware::class]);


$dino->router->dispatch();
