<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\PagesController;
use DinoFrame\Dino;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$dino = new Dino("KTA Institute", dirname(__DIR__), Dino::DEVELOPMENT_MODE, null, null);

$dino->router->get('/', [PagesController::class, 'index']);
$dino->router->get('/login', [PagesController::class, 'login']);
$dino->router->post('/login', [PagesController::class, 'login']);

$dino->router->dispatch();
