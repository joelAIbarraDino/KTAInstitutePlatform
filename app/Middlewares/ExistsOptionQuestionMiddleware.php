<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\OptionQuestion;


class ExistsOptionQuestionMiddleware implements HandleInterface{

    private ?string $redirectUrl = null;

    public function __construct(?string $redirectUrl = null){
        $this->redirectUrl = $redirectUrl;
    }

    public function handle(callable $next): void{
        
        $id = Request::getUrlParams();
        $optionQuestion = OptionQuestion::find($id['id']);

        if(!$optionQuestion && is_null($this->redirectUrl))
            Response::json(['ok'=>false,'message'=>'La respuesta no existe'], 404);
        
        if(!$optionQuestion && !is_null($this->redirectUrl))
            Response::redirect($this->redirectUrl);

        $next();
    }
}