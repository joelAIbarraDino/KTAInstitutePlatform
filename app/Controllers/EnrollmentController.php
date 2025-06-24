<?php

namespace App\Controllers;

use DinoEngine\Http\Response;

class EnrollmentController{

    public static function index(){
    
        Response::render('/student/virtualAula', [
            'nameApp'=>APP_NAME,
            'title'=>'Curso'
        ]);
    
    }
}