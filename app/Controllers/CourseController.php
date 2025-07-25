<?php

namespace App\Controllers;

use App\Classes\Email;
use App\Classes\FacturaPDF;
use App\Classes\Helpers;
use DinoEngine\Exceptions\QueryException;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\FAQ;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\OptionQuestion;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Teacher;
use App\Models\Payment;
use App\Models\Student;
use Exception;

class CourseController{

    public static function create():void{

        $alerts = [];
        $teachers = Teacher::all();
        $categories = Category::all();
        $course = new Course;

        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData(['details']);

            
            $course->sincronize($datosEnviados);

            $alerts = $course->validate();
            $alerts = $course->validateFileThumbnail($_FILES);
            $alerts = $course->validateFileBackground($_FILES);

            if(empty($alerts)){
                $course->uploadImageThumbnail($_FILES['thumbnail'], 1000, 1000);
                $course->uploadImageBackground($_FILES['background'], 1280, 720);
                $course->generateURL();
                
                $id = $course->save();
                if($id){
                    $atributosTraducibles = ['name', 'watchword', 'description', 'details']; 
                    Helpers::traducirYGuardarJson("course", $id, $course, null, $atributosTraducibles, "html");

                    Response::redirect("/kta-admin/course-content/$id");
                }else{
                    $alerts['error'][] = 'error al registrar el curso, intente mas tarde';
                }
            }


        }

        Response::render('/admin/cursos/nuevo', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo curso',
            'arrayStatus'=>Course::PRIVACY,
            'course'=>$course,
            'teachers'=> $teachers,
            'categories' => $categories,
            'alerts'=>$alerts
        ]);

    }

    public static function update($id):void{
        
        $course = Course::find($id);
        $original = clone $course;
        $alerts = [];

        if(!$course)
            Response::redirect('/kta-admin/cursos');
        
        $teachers = Teacher::all();
        $categories = Category::all();
        $modules = [];

        if(Request::isPOST()){
            $alerts = [];
            $datosEnviados = Request::getPostData(['details']);

            $course->name = $datosEnviados['name'];
            $course->watchword = $datosEnviados['watchword'];
            $course->max_months_enroll = $datosEnviados['max_months_enroll'];
            $course->price = $datosEnviados['price'];
            $course->discount = $datosEnviados['discount'];
            $course->discount_ends_date = $datosEnviados['discount_ends_date'];
            $course->discount_ends_time = $datosEnviados['discount_ends_time'];
            $course->id_teacher = $datosEnviados['id_teacher'];
            $course->id_category = $datosEnviados['id_category'];
            $course->description = $datosEnviados['description'];
            $course->details = $datosEnviados['details'];

            $alerts = $course->validate();

            if($_FILES['thumbnail']['size'] > 0)
                $alerts = $course->validateFileThumbnail($_FILES);

            if($_FILES['background']['size'] > 0)
                $alerts = $course->validateFileBackground($_FILES);

            
            if(empty($alerts)){
                //subir la nueva imagen si se subio una
                if($_FILES['thumbnail']['size'] > 0)
                    $course->uploadImageThumbnail($_FILES['thumbnail'], 1000, 1000);

                if($_FILES['background']['size'] > 0)
                    $course->uploadImageBackground($_FILES['background'], 1280, 720);
                
                $id = $course->save();

                if($id){
                    Helpers::setSwalAlert('success', '¡Genial!', 'Curso actualizado con exito');
                    
                    $atributosTraducibles = ['name', 'watchword', 'description', 'details']; 
                    Helpers::traducirYGuardarJson("course", $course->id_course, $course, $original, $atributosTraducibles, "html");

                    Response::redirect('/kta-admin/cursos');
                }else{
                    $alerts['error'][] = 'Eror al actualizar el curso, intente mas tarde';
                }

            }
            

        }

        Response::render('/admin/cursos/update', [
            'nameApp'=> APP_NAME,
            'title'=>'Nuevo curso',
            'arrayStatus'=>Course::PRIVACY,
            'course'=>$course,
            'modules'=>$modules,
            'teachers'=> $teachers,
            'categories' => $categories,
            'alerts'=>$alerts
        ]);
    }

    public static function updatePrivacy(int $id):void{
        if(!Request::isPATCH())
            Response::json(['ok'=>true,'message'=>"Método no soportado"]);

        try {
            $course = Course::find($id);
            $dataSend = Request::getBody();
            $course->privacy = $dataSend['privacy'];

            //validamos que no nos hayan enviado un nombre vacio
            if(!$course->privacy)
                Response::json(['ok'=>false,'message'=>'El nivel de privacidad es obligatorio'], 400);

            //verificamos que el curso tenga contenido
            $modules = Module::belongsTo('id_course', $course->id_course)??[];
            
            if(empty($modules))
                Response::json(['ok'=>false,'message'=>'El curso no tiene modulos agregados para poder publicarse'], 400);
            
            foreach($modules as $module){
                $lessions = Lesson::belongsTo('id_module', $module->id_module)??[];

                if(empty($lessions))
                    Response::json(['ok'=>false,'message'=>'El modulo "'. $module->name .'" no tiene lecciones agregadas para poder publicarse'], 400);
            }

            
            $faq = FAQ::belongsTo('id_course', $course->id_course)??[];

            if(empty($faq))
                Response::json(['ok'=>false,'message'=>'El curso no tiene preguntas frecuentes para poder publicarse'], 400);

            //verificamos si hay un quiz creado
            $quiz = Quiz::where('id_course', '=', $course->id_course)??[];

            if(!empty($quiz)){
                $questions = Question::belongsTo('id_quiz', $quiz->id_quiz)??[];

                if(empty($questions))
                    Response::json(['ok'=>false,'message'=>'El curso tiene un quiz sin preguntas'], 400);

                foreach($questions as $question){
                    if($question->type_question == "multiple"){
                        $answers = OptionQuestion::belongsTo('id_question', $question->id_question)??[];
                        
                        if(empty($answers))
                            Response::json(['ok'=>false,'message'=>'La pregunta "'.$question->question.'" no tiene respuestas agregadas'], 400);
                    }
                }
            }

            //guardamos los cambios
            $rowAffected = $course->save();

            if($rowAffected === 0)
                Response::json(['ok'=>false,'message'=>'Error al actualizar la privacidad del curso, intente mas tarde'], 404);

            Response::json(['ok'=>true,'message'=>'Privacidad actualizada con exito']);
        } catch (Exception $e) {
            Response::json(['ok'=>false,'message'=>'Ha ocurrido un error inesperado: '.$e->getMessage()]);
        }    
    }

    public static function delete($id):void{
        
        if(Request::isDELETE()){
            try {
                $course = Course::find($id);

                if(!$course)
                    Response::json(['ok'=>false]);

                //guardo el nombre de la imagen antes de eliminar del DB
                $photoFile = $course->thumbnail;
                $rows = $course->delete();

                if($rows == 0)
                    Response::json(['ok'=>false]);

                //se elimina la foto del servidor
                unlink(DIR_CARATULAS.$photoFile);
                Response::json(['ok'=>true]);
            } catch (QueryException) {
                Response::json(['ok'=>false]);
            }

        }
    }

    public static function comprobantePagoCurso($id_payment, $id_student):void{
        $payment = Payment::find($id_payment);
        $student = Student::find($id_student);

        $comprobante = new FacturaPDF($student, $payment);
        $pdfBinary = $comprobante->generarPDFString();
        $pdfBase64 = base64_encode($pdfBinary);

        Response::render('admin/cursos/comprobante', [
            'nameApp' => APP_NAME,
            'title' => 'Comprobante de pago de curso',
            'pdfBase64'=>$pdfBase64,
            'id_payment'=>$id_payment,
            'id_student'=>$id_student
        ]);
    }

    public static function mailPagoCurso():void{

        if(!Request::isPOST())
            Response::json(['ok'=>false,'message'=>"Método no soportado"]);

        try{
            $datosEnviados = Request::getPostData();

            $student = Student::find($datosEnviados['id_student']);
            $payment = Payment::find($datosEnviados['id_payment']);
    
            $comprobante = new FacturaPDF($student, $payment);
            $pdfData = $comprobante->generarPDFString();

            $html = Helpers::facturaHTML();
                    
            $html = str_replace('{NOMBRE_USUARIO}', Helpers::getFirstName($student->name), $html);
            $html = str_replace('{URL_SOPORTE}', 'https://api.whatsapp.com/send/?phone=17866124893&text=Hola%20KTA,%20tengo%20una%20duda%20y%20necesito%20ayuda', $html);


            $newFacturaEmail = new Email($student->email, $student->name, 'Comprobante de compra', $html, [['data'=>$pdfData, 'name'=>'factura.pdf']]);
            $send = $newFacturaEmail->sendEmail();

            if(!$send)
                response::json(['ok'=>false]);

            response::json(['ok'=>true]);
        }catch(Exception){
            response::json(['ok'=>false]);
        }
        
        
    }
}