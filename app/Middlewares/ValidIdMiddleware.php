<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Request;
use DinoEngine\Http\Response;

class ValidIdMiddleware implements HandleInterface{

    public function handle(callable $next): void{
        
        $id = Request::getUrlParams();

        if(is_numeric($id))
            Response::json(['ok'=>false,'message'=>'Invalid ID param'], 404);
        
        $next();
    }
}