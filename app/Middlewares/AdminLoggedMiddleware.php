<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Request;
use DinoEngine\Http\Response;

class AdminLoggedMiddleware implements HandleInterface{
    private string $redirectUrl;

    public function __construct(string $redirectUrl = '/'){
        $this->redirectUrl = $redirectUrl;
    }

    public function handle(callable $next): void{

        $currentURL = Request::getURL();

        //si entro a la url /login y ya me autentique, regreso a mis cursos
        if($currentURL == '/login-admin' && $this->adminLogged())
            Response::redirect('/kta-admin/dashboard');
    
        //si estoy en cualquier otra url protegida, reviso si no estoy autenticado y me redirige a /login en caso de que no
        if($currentURL != '/login-admin' && !$this->adminLogged())
            Response::redirect($this->redirectUrl);

        $next();
    }

    private function adminLogged(): bool{
        if(!isset($_SESSION)) {
            session_start();
        }
        
        return isset($_SESSION['admin']);
    }
}