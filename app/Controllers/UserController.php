<?php

namespace App\Controllers;

use App\Models\CourseView;
use App\Models\EnrollmentView;
use App\Models\Membership;
use App\Models\MembershipStudent;
use App\Models\MembershipView;
use App\Models\Student;
use DinoEngine\Helpers\Helpers;
use DinoEngine\Http\Response;

class UserController{

    public static function cursos():void{

        if(!isset($_SESSION))
            session_start();

        $idStudent = $_SESSION['student']['id_student'];
        $currentDate = strtotime(date('Y-m-d'));

        $myCourses = EnrollmentView::belongsTo('id_student', $idStudent)??[];
        $courses = CourseView::all(5, 'created_at', 'ASC');

        $finalCourses = [];

        if(!empty($myCourses)){
            foreach($myCourses as $course){
                $limitDate = strtotime("+".$course->max_months_enroll. " months", strtotime($course->enrollment_at));

                if($currentDate < $limitDate)
                    $finalCourses[]  = $course;
            }
        }        

        Response::render('/student/courses/myCourses',[
            'nameApp'=>APP_NAME,
            'title'=>'Mis cursos',
            'myCourses'=>$finalCourses,
            'courses'=>$courses
        ]);
        
    }

    public static function endedCourses():void{
        
        if(!isset($_SESSION))
            session_start();

        $idStudent = $_SESSION['student'];
        $currentDate = strtotime(date('Y-m-d'));

        $myCourses = EnrollmentView::belongsTo('id_student', $idStudent['id_student'])??[];

        $finalCourses = [];

        if(!empty($myCourses)){
            foreach($myCourses as $course){
                $limitDate = strtotime("+".$course->max_months_enroll. " months", strtotime($course->enrollment_at));

                if($currentDate > $limitDate)
                    $finalCourses[]  = $course;
            }
        }        

        Response::render('/student/courses/endedCourses',[
            'nameApp'=>APP_NAME,
            'title'=>'Cursos tomados',
            'myCourses'=>$finalCourses
        ]);
    }

    public static function profile():void{

        if(!isset($_SESSION))
            session_start();

        $idStudent = $_SESSION['student']['id_student'];

        $student = Student::where('id_student', '=', $idStudent);
        $memberships = MembershipView::belongsTo('id_student', $idStudent)??[];
        
        $activeMembership = null;
        
        foreach($memberships as $membership){
            $valido = strtotime(date('Y-m-d')) < strtotime('+'.$membership->max_time_membership.' months', strtotime($membership->created_at));

            if($valido){
                $activeMembership = $membership;
                break;
            }
            
        }
        
        Response::render('/student/profile/profile',[
            'nameApp'=>APP_NAME,
            'title'=>'Mi perfil',
            'student'=>$student,
            'membership'=> $activeMembership
        ]);
    }

    public static function editProfile():void{

        if(!isset($_SESSION))
            session_start();

        $idStudent = $_SESSION['student']['id_student'];

        $student = Student::where('id_student', '=', $idStudent);

        Response::render('/student/profile/editProfile',[
            'nameApp'=>APP_NAME,
            'title'=>'Editar perfil',
            'student'=>$student
        ]);
    }

    public static function editDirection():void{

        if(!isset($_SESSION))
            session_start();

        $idStudent = $_SESSION['student']['id_student'];

        $student = Student::where('id_student', '=', $idStudent);

        Response::render('/student/profile/editDirection',[
            'nameApp'=>APP_NAME,
            'title'=>'Editar dirección',
            'student'=>$student
        ]);
    }

    public static function security():void{

        if(!isset($_SESSION))
            session_start();

        $idStudent = $_SESSION['student']['id_student'];

        $student = Student::where('id_student', '=', $idStudent);

        Response::render('/student/security/security',[
            'nameApp'=>APP_NAME,
            'title'=>'Seguridad en acceso',
            'student'=>$student
        ]);
    }

}