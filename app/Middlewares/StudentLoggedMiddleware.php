<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Response;

class StudentLoggedMiddleware implements HandleInterface{
    private string $redirectUrl;
    private ?string $loggedUrl = null;

    public function __construct(string $redirectUrl = '/', ?string $loggedUrl = null){
        $this->redirectUrl = $redirectUrl;
        $this->loggedUrl = $loggedUrl;
    }

    public function handle(callable $next): void{
        if (!$this->userLogged())
            Response::redirect($this->redirectUrl);
        
        $next();
    }

    private function userLogged(): bool{
        if(!isset($_SESSION)) {
            session_start();
        }
        
        if(!isset($_SESSION['id_student'])) {
            return false;
        }
        
        return true;
    }
}