<?php

namespace App\Middlewares;

use App\Models\Lesson;
use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Request;
use DinoEngine\Http\Response;

class ExistsLessonMiddleware implements HandleInterface{

    public function handle(callable $next):void{
        $id = Request::getUrlParams();
        $lesson = Lesson::find($id['id']);

        if(!$lesson)
            Response::json(['ok'=>false, 'message'=>'La lección no existe'], 404);

        $next();
    }
}
