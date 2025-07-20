<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\LiveView;

class PublicLiveMiddleware implements HandleInterface{

    private ?string $redirectUrl = null;

    public function __construct(?string $redirectUrl = null){
        $this->redirectUrl = $redirectUrl;
    }

    public function handle(callable $next): void{
        
        $id = Request::getUrlParams();
        $live = LiveView::where('url', '=', $id['id']);

        if(!$live && is_null($this->redirectUrl))
            Response::json(['ok'=>false,'message'=>'El live no existe'], 404);
        
        if($live->privacy != 'Público' && is_null($this->redirectUrl))
            Response::json(['ok'=>false,'message'=>'El live no es publico'], 403);

        if(!$live && !is_null($this->redirectUrl))
            Response::redirect($this->redirectUrl);

        if($live->privacy != 'Público' && !is_null($this->redirectUrl))
            Response::redirect($this->redirectUrl);

        $next();
    }
}