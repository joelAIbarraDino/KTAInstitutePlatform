<?php

namespace App\Classes;

use App\Models\Payment;
use App\Models\Student;
use DateTime;
use FPDF;


class FacturaPDF extends FPDF {

    protected Student $student;
    protected Payment $payment;

    public function __construct(Student $student, Payment $payment) {
        parent::__construct();
        $this->student = $student;
        $this->payment = $payment;
    }

    function Footer() {
        $fecha = DateTime::createFromFormat('Y-m-d H:i', date("Y-m-d H:i"));
        $fechaFormateada = strftime('%d de %b de %Y a las %H:%M', $fecha->getTimestamp());
        
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Comprobante generado el: '.$fechaFormateada), 0, 0, 'L');
    }

    public function generarPDFString() {
        ob_start(); // Captura la salida para evitar errores

        $this->AddPage('P', 'Letter');

        // Logo
        $this->Image(__DIR__.'/../../public/assets/images/logoKTA.png', 10, 5, 30);

        // Información KTA en la esquina superior derecha
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->SetXY(120, 8); // Ajusta según lo necesites
        $this->MultiCell(80, 5, utf8_decode("KTA & ASSOCIATE LLC\n220 W Brandon Blvd, suite 201\nBrandon FL 33511"), 0, 'R');

        $this->Ln(20);
        // Título
        $this->SetFont('Arial', 'B', 20);
        $this->SetTextColor(205, 160, 45); // #CDA02D
        $this->Cell(0, 10, 'Comprobante de pago', 0, 1, 'L');

       // Nombre
       $this->SetFont('Arial', 'B', 12);
       $this->SetTextColor(0, 0, 0);
        $this->Write(7, utf8_decode("Nombre: "));
        $this->SetFont('Arial', '', 12);
        $this->Write(7, utf8_decode("{$this->student->name}\n"));

        // Correo
        $this->SetFont('Arial', 'B', 12);
        $this->Write(7, utf8_decode("Correo: "));
        $this->SetFont('Arial', '', 12);
        $this->Write(7, utf8_decode("{$this->student->email}\n"));

        if (!empty($this->student->phone)) {
            $this->SetFont('Arial', 'B', 12);
            $this->Write(7, utf8_decode("Teléfono: "));
            $this->SetFont('Arial', '', 12);
            $this->Write(7, utf8_decode("{$this->student->phone}\n"));
        }

        // Dirección
        $direccion = [];
        if (!empty($this->student->street)) $direccion[] = $this->student->street;
        if (!empty($this->student->number_street)) $direccion[] = "N° ".$this->student->number_street;
        if (!empty($this->student->state)) $direccion[] = $this->student->state;
        if (!empty($this->student->cp)) $direccion[] = "CP ".$this->student->cp;

        if ($direccion) {
            $this->SetFont('Arial', 'B', 12);
            $this->Write(7, utf8_decode("Dirección: "));
            $this->SetFont('Arial', '', 12);
            $this->MultiCell(0, 7, utf8_decode(implode(', ', $direccion)), 0);
        }

        $this->Ln(3);
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(205, 160, 45);
        $this->Cell(0, 10, 'Pagos realizados', 0, 1, 'L');

        // Tabla encabezado
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(0, 0, 0); // Encabezado azul oscuro
        $this->SetTextColor(255, 255, 255);
        $this->Cell(50, 10, 'Fecha', 1, 0, 'C', true);
        $this->Cell(50, 10, 'Hora', 1, 0, 'C', true);
        $this->Cell(50, 10, utf8_decode('Método'), 1, 0, 'C', true);
        $this->Cell(40, 10, 'Monto', 1, 1, 'C', true);

        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(0, 0, 0);


        
        $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $this->payment->created_at);
        $fechaStr = $fecha->format('d/m/Y');
        $horaStr = $fecha->format('H:i');

        $this->SetFillColor(245, 196, 71);

        $this->Cell(50, 10, $fechaStr, 0, 0, 'C', true);
        $this->Cell(50, 10, $horaStr, 0, 0, 'C', true);
        $this->Cell(50, 10, utf8_decode(ucfirst($this->payment->method)), 0, 0, 'C', true);
        $this->Cell(40, 10, "$".number_format($this->payment->amount, 2)." {$this->payment->currency}", 0, 1, 'C', true);
    
        // Total
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(255, 255, 255);
        $this->SetTextColor(205, 160, 45);
        $this->Cell(150, 10, 'Total pagado', 0, 0, 'R', true);

        $this->SetFillColor(0, 0, 0);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(40, 10, "$".number_format($this->payment->amount, 2)." {$this->payment->currency}", 1, 1, 'C', true);

        $this->Ln(10);
        $this->SetTextColor(0, 0, 0);
        $this->SetFillColor(245, 196, 71);
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 7, utf8_decode("Gracias por su pago. En caso de dudas o aclaraciones, comuníquese con nosotros."));

        // Obtener el contenido como string binario
        $pdfData = $this->Output('S');
        ob_end_clean(); // Limpia el buffer de salida

        return $pdfData;
    }
}
