<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AccountController;
use App\Controllers\AdminController;
use App\Controllers\CourseController;
use App\Controllers\PagesController;
use DinoEngine\Core\Database;
use DinoFrame\Dino;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

date_default_timezone_set('America/Mexico_City');
define('APP_NAME','KTA Institute');
define('DIR_CARATULAS',__DIR__.'/assets/thumbnails/');

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

//login sign-in and sign-up
$dino->router->get('/login', [AccountController::class, 'login']);
$dino->router->post('/login', [AccountController::class, 'login']);

$dino->router->get('/forgot', [AccountController::class, 'forgot']);
$dino->router->post('/forgot', [AccountController::class, 'forgot']);

$dino->router->get('/sign-in', [AccountController::class, 'signin']);
$dino->router->post('/sign-in', [AccountController::class, 'signin']);

$dino->router->get('/admin', [AdminController::class, 'index']);
$dino->router->get('/cursos', [AdminController::class, 'courses']);
$dino->router->get('/categorias', [AdminController::class, 'categories']);

//administración de cursos
$dino->router->get('/admin/curso/create', [CourseController::class, 'formCreate']);
$dino->router->post('/api/curso/create', [CourseController::class, 'create']);
$dino->router->post('/api/curso/update/{id}', [CourseController::class, 'update']);
$dino->router->delete('/api/curso/delete/{id}', [CourseController::class, 'delete']);


$dino->router->dispatch();
