<?php

namespace App\Middlewares;

use DinoEngine\Http\Middleware\HandleInterface;
use App\Models\EnrollmentView;
use DinoEngine\Helpers\Helpers;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

class EnrollExpiredMiddleware implements HandleInterface{

    public function handle(callable $next): void{
        
        
        $urlParams = Request::getUrlParams();
        $currentDate = strtotime(date("Y-m-d"));
        $enrollment = EnrollmentView::where('enroll_url', '=', $urlParams['uuid']);

        if(!$enrollment)
            Response::redirect('/mis-cursos');
    
        $enrollDate = strtotime($enrollment->enrollment_at."+ ".$enrollment->max_months_enroll. " months");
        $inscrito = $currentDate < $enrollDate?true:false;

        if(!$inscrito)
            Response::redirect('/mis-cursos');

        $next();
    }
}