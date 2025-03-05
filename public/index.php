<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\PagesController;
use DinoFrame\Dino;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$emailConfig = [
    "from"=>$_ENV['MAIL_DEBUG_FROM'],
    "to"=>$_ENV['MAIL_DEBUG_TO'],
    "name"=>$_ENV['MAIL_DEBUG_NAME'],
    "host"=>$_ENV['MAIL_DEBUG_HOST'],
    "user"=>$_ENV['MAIL_DEBUG_USER'],
    "password"=>$_ENV['MAIL_DEBUG_PASS'],
    "port"=>$_ENV['MAIL_DEBUG_PORT']
];

$dino = new Dino("KTA Institute", dirname(__DIR__), Dino::DEVELOPMENT_MODE, null, $emailConfig);

$dino->router->get('/', [PagesController::class, 'index']);

$dino->router->dispatch();