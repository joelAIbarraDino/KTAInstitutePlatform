<?php

namespace App\Controllers;

use App\Classes\Auth;
use App\Classes\Email;
use App\Classes\FacturaPDF;
use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Membership;
use App\Models\MembershipStudent;
use App\Models\Payment;
use App\Models\Student;
use App\Classes\Helpers;
use Ramsey\Uuid\Uuid;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Exception\UnexpectedValueException;
use Stripe\Checkout\Session;
use Stripe\Webhook;
use Stripe\Stripe;
use \Stripe\PaymentIntent;
use Exception;

Stripe::setApiKey($_ENV['CLIENT_SECRET_STRIPE']);

class PaymentController{

    public static function checkoutCourse(string $id):void{

        if(!Request::isGET())
            Response::json(['ok'=>false, 'message'=> 'Metodo no soportado'], 400);

        $curso = Course::where('url', '=', $id);
        $precio = (int) round($curso->price * 100);

        $session = Session::create([
            'payment_method_types' => ['card', 'afterpay_clearpay'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $curso->name,
                        'images' => [(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http').'://'.$_SERVER['HTTP_HOST'].'/assets/thumbnails/'.$curso->thumbnail]
                    ],
                    'unit_amount' => $precio,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'metadata' => [
                'product_id' => $curso->id_course,
                'type_product'=>'course'
            ],
            'success_url' => REDIRECT_SUCCESS_STRIPE,
            'cancel_url' => REDIRECT_CANCEL_STRIPE,
        ]);

        Response::redirect($session->url);
    }

    public static function checkoutMembership(int $id):void{
        if(!Request::isGET())
            Response::json(['ok'=>false, 'message'=> 'Metodo no soportado'], 400);

        $membership = Membership::find($id);
        $precio = (int) round($membership->price * 100);

        $session = Session::create([
            'payment_method_types' => ['card', 'afterpay_clearpay'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => "Membresía ".$membership->type,
                        
                    ],
                    'unit_amount' => $precio,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'metadata' => [
                'product_id' => $membership->id_membership,
                'type_product'=>'membership'
            ],
            'success_url' => REDIRECT_SUCCESS_STRIPE,
            'cancel_url' => REDIRECT_CANCEL_STRIPE,
        ]);

        Response::redirect($session->url);
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
            }


            Response::render('/public/checkout/success', [
                'nameApp'=>APP_NAME,
                'title'=>'Nueva orden exitosa',
                'transparente'=>false,
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
                
                $student = Student::where('email', '=', $email);

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

                $payment = Payment::where('stripe_id', '=', $session_id);

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
                }else{
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
                    $newEnrollment->id_student = $student->id_student;
                    $newEnrollment->id_payment = $payment->id_payment;

                    $rows = $newEnrollment->save();

                    if(!$rows)
                        Response::json(['ok'=>false, 'message'=> 'Inscripcion incorrecta'], 400);

                }else if($type_product == 'membership'){
                    $membership = new MembershipStudent;
                    $membership->id_membership = $product_id;
                    $membership->id_student = $student->id_student;
                    $membership->id_payment = $payment->id_payment;

                    $rows = $membership->save();

                    if(!$rows)
                        Response::json(['ok'=>false, 'message'=> 'Inscripcion incorrecta'], 400);

                }else if($type_product == 'live'){
                    
                }

                Response::json(['ok'=>true, 'message'=>'Proceso completado']);
            }

            Response::json(['ok'=>true, 'message'=>'Evento recibido: '. $event->type]);

        }catch(UnexpectedValueException $e){
            Response::json(['ok'=>false, 'message'=> $e->getMessage()], 400);
        }catch(SignatureVerificationException $e){
            Response::json(['ok'=>false, 'message'=> $e->getMessage()], 400);
        }
    }

}