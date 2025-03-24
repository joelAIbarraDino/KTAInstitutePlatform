<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AccountController;
use App\Controllers\AdminController;
use App\Controllers\PagesController;
use DinoEngine\Core\Database;
use DinoFrame\Dino;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$dbConfig = [
    "host"=>$_ENV['DB_HOST'],
    "port"=>$_ENV['DB_PORT'],
    "user"=>$_ENV['DB_USER'],
    "password"=>$_ENV['DB_PASS'],
    "database"=>$_ENV['DB_DATABASE'],
    "driver"=>Database::PDO_DRIVER
];

$dino = new Dino("KTA Institute", dirname(__DIR__), Dino::DEVELOPMENT_MODE, $dbConfig);

$dino->router->get('/', [PagesController::class, 'index']);


$dino->router->get('/login', [AccountController::class, 'login']);
$dino->router->post('/login', [AccountController::class, 'login']);

$dino->router->get('/forgot', [AccountController::class, 'forgot']);
$dino->router->post('/forgot', [AccountController::class, 'forgot']);

$dino->router->get('/sign-in', [AccountController::class, 'signin']);
$dino->router->post('/sign-in', [AccountController::class, 'signin']);


$dino->router->dispatch();
