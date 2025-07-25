<?php

namespace App\Controllers;

use App\Classes\FacturaPDF;
use App\Classes\Email;
use App\Classes\Helpers;
use App\Models\Payment;
use App\Models\Student;

use DinoEngine\Http\Response;
use DinoEngine\Http\Request;

use Exception;

class ComprobanteController{
    
        public static function comprobantePago($id_payment, $id_student):void{
        $payment = Payment::find($id_payment);
        $student = Student::find($id_student);

        $comprobante = new FacturaPDF($student, $payment);
        $pdfBinary = $comprobante->generarPDFString();
        $pdfBase64 = base64_encode($pdfBinary);

        Response::render('admin/comprobante/comprobante', [
            'nameApp' => APP_NAME,
            'title' => 'Comprobante de pago de live',
            'pdfBase64'=>$pdfBase64,
            'id_payment'=>$id_payment,
            'id_student'=>$id_student
        ]);
    }

    public static function mailPago():void{

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