<?php

namespace App\Controllers;

use App\Models\Course;
use App\Models\Live;
use App\Models\Membership;
use App\Models\MembershipCourse;
use App\Models\MembershipLive;
use DinoEngine\Helpers\Helpers;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use Exception;

class MembershipContentController{

    public static function CurseContent(int $id):void{

        $membership = Membership::find($id);
        $cursos = Course::querySQL('SELECT * FROM course WHERE privacy = "Público"');
        $finalcourses = [];

        
        foreach($cursos as $curso){
            $finalcourses [] = new Course($curso);
        }
        
        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        Response::render('/admin/contenido-membresia/cursos', [
            'nameApp'=> APP_NAME,
            'title'=>'Contenido de membresía',
            'membership'=>$membership,
            'courses'=>$finalcourses
        ]);

    }

    public static function LiveContent(int $id):void{
        $membership = Membership::find($id);
        $lives = Live::querySQL('SELECT * FROM live WHERE privacy = "Público"');
        $finalLives = [];

        foreach($lives as $live){
            $finalLives [] = new Live($live);
        }


        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        Response::render('/admin/contenido-membresia/lives', [
            'nameApp'=> APP_NAME,
            'title'=>'Contenido de membresía',
            'membership'=>$membership,
            'lives'=>$finalLives
        ]);
    }

    public static function getCourses(int $id):void{
        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $courses = MembershipCourse::belongsTo('id_membership', $id)??[];
            $finalcourses = [];

            foreach($courses as $course){
                $courseReg = Course::find($course->id_course);
                $finalcourses[] = [
                    'id_membership_course'=>$course->id_membership_course,
                    'id_membership'=>$course->id_membership,
                    'id_course'=>$courseReg->id_course,
                    'name'=>$courseReg->name
                ];
            }

            Response::json([
                'lives'=>$finalcourses,
            ]);      
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function createLive():void{
        if(!Request::isPOST())
            Response::json(['ok'=>true,'message'=>"Método no soportado"], 404);

        try {
            $membershipLive = new MembershipLive;
            
            //sincronizamos datos enviados por js para la nueva clase
            $dataPost = Request::getPostData();
            $membershipLive->sincronize($dataPost);

            //validamos entrada de datos
            $membershipLive->validateAPI();
            $membershipLive->liveExists($dataPost['id_membership'], $dataPost['id_live']);

            //registramos modulo y devolvemos ID
            $id = $membershipLive->save();
            $live = Live::find($membershipLive->id_live);
            if(!$id)
                Response::json(['ok'=>false,'message'=>'Error al registrar el curso, intente mas tarde']);

            Response::json([
                'ok'=>true,
                'id'=>$id,
                'name'=>$live->name,
                'message'=>'Curso agregado con exito'
            ]);
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function getLives(int $id):void{
        if(!Request::isGET())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $lives = MembershipLive::belongsTo('id_membership', $id)??[];
            $finalLives = [];

            foreach($lives as $live){
                $liveReg = Live::find($live->id_live);
                $finalLives[] = [
                    'id_membership_live'=>$live->id_membership_live,
                    'id_membership'=>$live->id_membership,
                    'id_live'=>$liveReg->id_live,
                    'name'=>$liveReg->name
                ];
            }

            Response::json([
                'lives'=>$finalLives,
            ]);      
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function createCourse():void{
        if(!Request::isPOST())
            Response::json(['ok'=>true,'message'=>"Método no soportado"], 404);

        try {
            $membershipCourse = new MembershipCourse;
            
            //sincronizamos datos enviados por js para la nueva clase
            $dataPost = Request::getPostData();
            $membershipCourse->sincronize($dataPost);

            //validamos entrada de datos
            $membershipCourse->validateAPI();
            $membershipCourse->courseExists($dataPost['id_membership'], $dataPost['id_course']);

            //registramos modulo y devolvemos ID
            $id = $membershipCourse->save();
            $course = Course::find($membershipCourse->id_course);
            if(!$id)
                Response::json(['ok'=>false,'message'=>'Error al registrar el curso, intente mas tarde']);

            Response::json([
                'ok'=>true,
                'id'=>$id,
                'name'=>$course->name,
                'message'=>'Curso agregado con exito'
            ]);
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }       
    }

    public static function deleteLive(int $id):void{
                if(!Request::isDELETE())
            Response::json(['ok'=>false,'message'=>"Método no soportado"]);

        try {
            $live = MembershipLive::find($id);

            //elimino el modulo
            $rowAffected = $live->delete();

            //en caso de que no se elimine cancelo el siguiente paso
            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al eliminar la lección, intente mas tarde'], 404);

            //regreso respuesta para ver que me regresa el querySQL
            Response::json(['ok'=>true]);

        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }

    public static function deleteCourse(int $id):void{
                if(!Request::isDELETE())
            Response::json(['ok'=>false,'message'=>"Método no soportado"]);

        try {
            $course = MembershipCourse::find($id);

            //elimino el modulo
            $rowAffected = $course->delete();

            //en caso de que no se elimine cancelo el siguiente paso
            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al eliminar la lección, intente mas tarde'], 404);

            //regreso respuesta para ver que me regresa el querySQL
            Response::json(['ok'=>true]);

        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }
    }
}