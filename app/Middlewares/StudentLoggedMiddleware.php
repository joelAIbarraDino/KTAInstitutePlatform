<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Request;
use DinoEngine\Http\Response;

class StudentLoggedMiddleware implements HandleInterface{
    private string $redirectUrl;

    public function __construct(string $redirectUrl = '/'){
        $this->redirectUrl = $redirectUrl;
    }

    public function handle(callable $next): void{

        $currentURL = Request::getURL();

        //si entro a la url /login y ya me autentique, regreso a mis cursos
        if($currentURL == '/login' && $this->studentLogged())
            Response::redirect('/mis-cursos');
    
        //si estoy en cualquier otra url protegida, reviso si no estoy autenticado y me redirige a /login en caso de que no
        if($currentURL != '/login' && !$this->studentLogged())
            Response::redirect($this->redirectUrl);

        $next();
    }

    private function studentLogged(): bool{
        if(!isset($_SESSION)) {
            session_start();
        }
        
        return isset($_SESSION['student']);
    }
}