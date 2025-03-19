<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AccountController;
use App\Controllers\AdminController;
use App\Controllers\PagesController;
use DinoFrame\Dino;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$dino = new Dino("KTA Institute", dirname(__DIR__), Dino::DEVELOPMENT_MODE, null, null);

$dino->router->get('/', [PagesController::class, 'index']);


$dino->router->get('/login', [AccountController::class, 'login']);
$dino->router->post('/login', [AccountController::class, 'login']);

$dino->router->get('/forgot', [AccountController::class, 'forgot']);
$dino->router->post('/forgot', [AccountController::class, 'forgot']);

$dino->router->get('/upload', [AdminController::class , 'index']);
$dino->router->post('/upload', [AdminController::class, 'index']);

$dino->router->get('/test', [AdminController::class , 'test']);

$dino->router->dispatch();
