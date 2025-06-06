<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use App\Models\Module;
use DinoEngine\Http\Request;
use DinoEngine\Http\Response;

class ExistsModuleMiddleware implements HandleInterface{

    public function handle(callable $next): void{
        
        $id = Request::getUrlParams();
        $module = Module::find($id['id']);

        if(!$module)
            Response::json(['ok'=>false,'message'=>'El modulo no existe'], 404);
        
        $next();
    }
}