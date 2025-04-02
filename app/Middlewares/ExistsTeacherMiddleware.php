<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Response;
use App\Models\Teacher;

class ExistsTeacherMiddleware implements HandleInterface{
    private string $redirectUrl;

    public function __construct(string $redirectUrl = '/'){
        $this->redirectUrl = $redirectUrl;
    }

    public function handle(callable $next): void{
        if (!$this->teacherExists())
            Response::redirect($this->redirectUrl);
        
        $next();
    }

    private function teacherExists(): bool
    {
        $teachers = Teacher::all();
        return count($teachers) > 0;
    }
}