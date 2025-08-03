<?php

namespace App\Controllers;

use App\Models\Attempt;
use App\Models\CourseView;
use App\Models\EnrollmentView;
use App\Models\Membership;
use App\Models\MembershipStudent;
use App\Models\MembershipView;
use App\Models\Module;
use App\Models\ProgressEnrollment;
use App\Models\Quiz;
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
                
                if($currentDate < $limitDate){
                    $lessonsCount = Module::querySQL("select count(*) as no_lessons from module m join lesson l ON m.id_module  = l.id_module join course c ON m.id_course = c.id_course where c.id_course  = :id_course", [
                        ':id_course'=>$course->id_course
                    ]);
                    $noLessons = $lessonsCount[0]['no_lessons'];
                    $lessonsProgress = ProgressEnrollment::querySQL("select count(*) as no_progress from progress_enrollment WHERE completed = 1 AND id_enrollment = :id_enrollment", [
                        ':id_enrollment'=>$course->id_enrollment
                    ]);
                    $completedLessons = $lessonsProgress[0]['no_progress'];
                    
                    $progressPercentage = ($completedLessons/$noLessons) * 100;

                    $finalCourses[]  = [$course, $progressPercentage];
                }
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

    public static function certificados():void{
        
        if(!isset($_SESSION))
            session_start();

        $idStudent = $_SESSION['student'];

        $courses = EnrollmentView::belongsTo('id_student', $idStudent['id_student'])??[];
        
        $certificados = [];

        foreach($courses as $course){
            $quiz = Quiz::where('id_course', '=', $course->id_course)??[];

            if($quiz){
                //veo si tiene un examen aprobado
                $attempts = Attempt::belongsTo('id_enrollment', $course->id_enrollment, 'is_approved', 'DESC')??[];
                
                $attemptsApproved = array_filter($attempts, function($attempt){
                    return $attempt->is_approved == 1;
                });

                if($attemptsApproved){

                    usort($attemptsApproved, function($a, $b){
                        return $b->score - $a->score;
                    });

                    $certificados[] = [
                        'name_course'=>$course->course,
                        'thumbnail'=>$course->thumbnail,
                        'date'=>$attemptsApproved[0]->date,
                        'method'=>"Examen",
                        'url'=>$course->enroll_url
                    ];

                }

            }else{

                //veo si ya tiene todo el progreso del curso
                $lessonsCount = Module::querySQL("select count(*) as no_lessons from module m join lesson l ON m.id_module  = l.id_module join course c ON m.id_course = c.id_course where c.id_course  = :id_course", [
                    ':id_course'=>$course->id_course
                ]);
                $noLessons = $lessonsCount[0]['no_lessons'];
                $lessonsProgress = ProgressEnrollment::querySQL("select count(*) as no_progress from progress_enrollment WHERE completed = 1 AND id_enrollment = :id_enrollment", [
                    ':id_enrollment'=>$course->id_enrollment
                ]);
                $completedLessons = $lessonsProgress[0]['no_progress'];
                
                $progressPercentage = ($completedLessons/$noLessons) * 100;

                if($progressPercentage == 100){
                    $certificados[] = [
                        'name_course'=>$course->course,
                        'thumbnail'=>$course->thumbnail,
                        'date'=>date('Y-d-m'),
                        'method'=>"Curso terminado",
                        'url'=>$course->enroll_url
                    ];
                }
            }

        }

        Response::render('/student/courses/certificados',[
            'nameApp'=>APP_NAME,
            'title'=>'Mis certificados',
            'certificados'=>$certificados
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