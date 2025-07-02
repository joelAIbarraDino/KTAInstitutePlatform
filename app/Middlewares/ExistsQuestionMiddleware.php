<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\Question;

class ExistsQuestionMiddleware implements HandleInterface{

    private ?string $redirectUrl = null;

    public function __construct(?string $redirectUrl = null){
        $this->redirectUrl = $redirectUrl;
    }

    public function handle(callable $next): void{
        
        $id = Request::getUrlParams();
        $question = Question::find($id['id']);

        if(!$question && is_null($this->redirectUrl))
            Response::json(['ok'=>false,'message'=>'La pregunta no existe'], 404);
        
        if(!$question && !is_null($this->redirectUrl))
            Response::redirect($this->redirectUrl);

        $next();
    }
}