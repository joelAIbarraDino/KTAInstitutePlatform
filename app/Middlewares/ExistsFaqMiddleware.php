<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\FAQ;

class ExistsFaqMiddleware implements HandleInterface{

    public function handle(callable $next):void{
        $id = Request::getUrlParams();
        $faq = FAQ::find($id['id']);

        if(!$faq)
            Response::json(['ok'=>false, 'message'=>'La FAQ no existe'], 404);

        $next();
    }
}