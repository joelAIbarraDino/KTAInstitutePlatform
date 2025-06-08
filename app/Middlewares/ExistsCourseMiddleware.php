<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\Course;

class ExistsCourseMiddleware implements HandleInterface{

    private ?string $redirectUrl = null;

    public function __construct(?string $redirectUrl = null){
        $this->redirectUrl = $redirectUrl;
    }

    public function handle(callable $next): void{
        
        $id = Request::getUrlParams();
        $course = Course::find($id['id']);

        if(!$course && is_null($this->redirectUrl))
            Response::json(['ok'=>false,'message'=>'El curso no existe'], 404);
        
        if(!$course && !is_null($this->redirectUrl))
            Response::redirect($this->redirectUrl);

        $next();
    }
}