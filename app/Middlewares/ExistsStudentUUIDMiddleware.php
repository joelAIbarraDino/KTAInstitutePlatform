<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\Student;

class ExistsStudentUUIDMiddleware implements HandleInterface{
    private string $redirectUrl;

    public function __construct(string $redirectUrl = '/'){
        $this->redirectUrl = $redirectUrl;
    }

    public function handle(callable $next): void{
        $id = Request::getUrlParams();
        $student = Student::where('profile_url', '=', $id['uuid']);

        if(!$student && is_null($this->redirectUrl))
            Response::json(['ok'=>false,'message'=>'El estudiante no existe'], 404);
        
        if(!$student && !is_null($this->redirectUrl))
            Response::redirect($this->redirectUrl);

        $next();
    }

}