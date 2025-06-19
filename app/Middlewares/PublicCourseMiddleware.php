<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\CourseView;

class PublicCourseMiddleware implements HandleInterface{

    private ?string $redirectUrl = null;

    public function __construct(?string $redirectUrl = null){
        $this->redirectUrl = $redirectUrl;
    }

    public function handle(callable $next): void{
        
        $id = Request::getUrlParams();
        $course = CourseView::where('url', '=', $id['id']);

        if(!$course && is_null($this->redirectUrl))
            Response::json(['ok'=>false,'message'=>'El curso no existe'], 404);
        
        if($course->privacy != 'Público' && is_null($this->redirectUrl))
            Response::json(['ok'=>false,'message'=>'El curso no es publico'], 403);

        if(!$course && !is_null($this->redirectUrl))
            Response::redirect($this->redirectUrl);

        if($course->privacy != 'Público' && !is_null($this->redirectUrl))
            Response::redirect($this->redirectUrl);

        $next();
    }
}