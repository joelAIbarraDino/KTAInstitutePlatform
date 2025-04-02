<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use App\Models\Category;
use DinoEngine\Http\Response;

class ExistsCategoryMiddleware implements HandleInterface{
    private string $redirectUrl;

    public function __construct(string $redirectUrl = '/'){
        $this->redirectUrl = $redirectUrl;
    }

    public function handle(callable $next): void{
        if (!$this->categoriesExists())
            Response::redirect($this->redirectUrl);
        
        $next();
    }

    private function categoriesExists(): bool
    {
        $categories = Category::all();
        return count($categories) > 0;
    }
}