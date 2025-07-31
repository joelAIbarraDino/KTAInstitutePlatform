<?php

namespace App\Controllers;

use DinoEngine\Http\Response;
use DinoEngine\Http\Request;
use Exception;

use App\Classes\FacturaPDF;
use App\Classes\Helpers;
use App\Classes\Email;
use App\Classes\Auth;

use Stripe\Exception\SignatureVerificationException;
use Stripe\Exception\UnexpectedValueException;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\Webhook;
use Stripe\Stripe;

use Ramsey\Uuid\Uuid;

use App\Models\MembershipStudent;
use App\Models\MembershipCourse;
use App\Models\MembershipLive;
use App\Models\StudentLive;
use App\Models\Membership;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Course;
use App\Models\Live;


Stripe::setApiKey($_ENV['CLIENT_SECRET_STRIPE']);

class PaymentController{

    public static function checkout(string $type, string $id):void{
        $id_product = 0;
        $product = null;
        $precio = 0;
        $caratula = null;
        $name = null;

        if($type == "course"){
            $product = Course::where('url', '=', $id);
            $id_product = $product->id_course;
            $caratula = '/assets/thumbnails/courses/'.$product->thumbnail;
            $name = $product->name;
        }elseif($type == "membership"){
            $product = Membership::find((int)$id);
            $caratula = '/assets/membresias/'.$product->photo;
            $id_product = $product->id_membership;
            $name = "Membresía ".$product->type;
        }elseif($type == "live"){
            $product = Live::where('url', '=', $id);
            $caratula = '/assets/thumbnails/lives/'.$product->thumbnail;
            $id_product = $product->id_live;
            $name = $product->name;
        }

        $precio = (int) round($product->price * 100);

        if(Request::isPOST()){
            $dataRequest = Request::getPostData();

            $session = Session::create([
                'payment_method_types' => ['card', 'afterpay_clearpay'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $name,
                            'images' => [(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].$caratula]
                        ],
                        'unit_amount' => $precio,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'metadata' => [
                    'product_id' => $id_product,
                    'type_product'=>$type,
                    'email'=>$dataRequest['email'],
                    'name'=>$dataRequest['name']
                ],
                'customer_email' => $dataRequest['email'],
                'success_url' => REDIRECT_SUCCESS_STRIPE,
                'cancel_url' => REDIRECT_CANCEL_STRIPE,
            ]);

            Response::redirect($session->url);
        }

        Response::render('public/checkout/form', [
            'nameApp'=>APP_NAME,
            'title'=>'Finalizar compra',
            'type_product'=>$type,
            'caratula'=>$caratula,
            'nameProducto'=>$name,
            'price'=>$precio/100
        ]);
    }

    public static function success():void{
        if (!isset($_GET['session_id'])) {
            echo "Sesión inválida.";
            return;
        }

        $session_id = $_GET['session_id'];

        try {
            $session = Session::retrieve($session_id);

            $email= $session->customer_details->email;
            $name = $session->customer_details->name;
            $type_product = $session->metadata->type_product;
            $product_id = $session->metadata->product_id;

            if($type_product == "course"){
                $product = Course::find($product_id);
            }elseif($type_product == "membership"){
                $product = Membership::find($product_id);
            }elseif($type_product == "live"){
                $product = Live::find($product_id);
            }


            Response::render('/public/checkout/success', [
                'nameApp'=>APP_NAME,
                'title'=>'Nueva orden exitosa',
                'product'=>$product,
                'type_product'=>$type_product,
                'name'=>$name,
                'email'=>$email
            ]);

        } catch (Exception $e) {
            echo "Error al obtener la sesión: " . $e->getMessage();
        }

        
    }

    public static function webhook():void{

        $endpoint_secret = $_SERVER['HTTP_HOST']=='localhost:3000'?$_ENV['LOCAL_SIGN_WEBHOOK_COURSE']:$_ENV['SIGN_WEBHOOK_COURSE'];

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

        try{
            
            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );


            if($event->type == 'checkout.session.completed'){
                $session = $event->data->object;

                $session_id = $session->id;
                $monto = $session->amount_total / 100;
                $moneda = strtoupper($session->currency);

                $payment_intent_id = $session->payment_intent;
                $payment_intent = PaymentIntent::retrieve($payment_intent_id);
                $metodo_pago = $payment_intent->payment_method_types[0];

                $type_product = $session->metadata->type_product;
                $product_id = $session->metadata->product_id;

                $email = $session->customer_details->email;
                $name = $session->customer_details->name;

                $student = Student::where('email', '=', $email)??[];

                if(!$student){
                    $tempPassword = Helpers::generate_password();

                    $student = new Student;
                    $student->name = $name;
                    $student->email = $email;
                    $student->password = Auth::encriptPassword($tempPassword);
                    $student->photo = null;
                    $student->oauth_id = null;
                    $student->oauth_provider = null;
                    $student->user_confirmed = 1;

                    //creamos el nuevo usuario
                    $student->id_student = $student->save();

                    if(!$student->id_student)
                        Response::json(['ok'=>false, 'message'=> 'Estudiante no registrado'], 400);

                    //enviamos correo con el acceso a su cuenta
                    $html = Helpers::newUserPaymentHTML();

                    $html = str_replace('{NOMBRE_USUARIO}', Helpers::getFirstName($name), $html);
                    $html = str_replace('{CONTRASENA_GENERADA}', $tempPassword, $html);
                    $html = str_replace('{URL_TUTORIAL}', 'https://www.youtube.com/watch?v=NpEaa2P7qZI&ab_channel=TristanBrehaut', $html);
                    $html = str_replace('{EMAIL_SOPORTE}', 'soporte@ktainstitute.com', $html);


                    $newUserEmail = new Email($email, $name, 'Bienvenido a KTA Institute', $html);

                    $newUserEmail->sendEmail();

                }

                $payment = Payment::where('stripe_id', '=', $session_id)??[];

                if(!$payment){
                    $payment = new Payment;

                    $payment->amount = $monto;
                    $payment->currency = $moneda;
                    $payment->method = $metodo_pago; 
                    $payment->status = 'pagado';
                    $payment->stripe_id = $session_id;

                    $payment->id_payment = $payment->save();

                    //pago no registrado
                    if(!$payment->id_payment)
                        Response::json(['ok'=>false, 'message'=> 'Pago no registrado'], 400);

                    //creamos comprobante PDF
                    $comprobantePDF = new FacturaPDF($student, $payment);
                    $pdfData = $comprobantePDF->generarPDFString();

                    //enviamos correo con el comprobante de compra
                    $html = Helpers::facturaHTML();
                    
                    $html = str_replace('{NOMBRE_USUARIO}', Helpers::getFirstName($name), $html);
                    $html = str_replace('{URL_SOPORTE}', 'https://api.whatsapp.com/send/?phone=17866124893&text=Hola%20KTA,%20tengo%20una%20duda%20y%20necesito%20ayuda', $html);


                    $newFacturaEmail = new Email($email, $name, 'Comprobante de compra', $html, [['data'=>$pdfData, 'name'=>'factura.pdf']]);

                    $newFacturaEmail->sendEmail();
                }
                
                if($type_product == 'course'){
                    
                    $newEnrollment = new Enrollment;
                    $newEnrollment->url = Uuid::uuid4();
                    $newEnrollment->id_course = $product_id;
                    $newEnrollment->from_membership = 0;
                    $newEnrollment->id_student = $student->id_student;
                    $newEnrollment->id_payment = $payment->id_payment;

                    $rows = $newEnrollment->save();

                    if(!$rows)
                        Response::json(['ok'=>false, 'message'=> 'Inscripcion incorrecta'], 400);

                }else if($type_product == 'live'){
                    
                    $studentLive = new StudentLive;
                    $studentLive->id_live = $product_id;
                    $studentLive->from_membership = 0;
                    $studentLive->id_student = $student->id_student;
                    $studentLive->id_payment = $payment->id_payment;

                    $rows = $studentLive->save();

                    if(!$rows)
                        Response::json(['ok'=>false, 'message'=> 'Inscripcion incorrecta'], 400);

                }else if($type_product == 'membership'){
                    $membership = new MembershipStudent;
                    $membership->id_membership = $product_id;
                    $membership->id_student = $student->id_student;
                    $membership->id_payment = $payment->id_payment;

                    $rows = $membership->save();

                    //consultar curso de cursos y lives
                    $courses = MembershipCourse::belongsTo('id_membership', $product_id)??[];
                    $lives = MembershipLive::belongsTo('id_membership', $product_id)??[];

                    //registro de acceso a curso
                    foreach($courses as $course){
                        $newEnrollment = new Enrollment;
                        $newEnrollment->url = Uuid::uuid4();
                        $newEnrollment->id_course = $course->id_course;
                        $newEnrollment->from_membership = 1;
                        $newEnrollment->id_student = $student->id_student;
                        $newEnrollment->id_payment = $payment->id_payment;

                        $rows = $newEnrollment->save();

                        if(!$rows)
                            Response::json(['ok'=>false, 'message'=> 'Inscripcion incorrecta'], 400);
                    }

                    //registro de acceso a live
                    foreach($lives as $live){
                        $studentLive = new StudentLive;
                        $studentLive->id_live = $live->id_live;
                        $studentLive->from_membership = 1;
                        $studentLive->id_student = $student->id_student;
                        $studentLive->id_payment = $payment->id_payment;

                        $rows = $studentLive->save();

                        if(!$rows)
                            Response::json(['ok'=>false, 'message'=> 'Inscripcion incorrecta'], 400);    
                    }

                    if(!$rows)
                        Response::json(['ok'=>false, 'message'=> 'Inscripcion incorrecta'], 400);

                }

                Response::json(['ok'=>true, 'message'=>'Proceso completado']);
            }
            
        }catch(UnexpectedValueException $e){
            Response::json(['ok'=>false, 'message'=> $e->getMessage()], 400);

        }catch(SignatureVerificationException $e){
            Response::json(['ok'=>false, 'message'=> $e->getMessage()], 400);
        }
    }

}