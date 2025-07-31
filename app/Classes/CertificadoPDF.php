<?php

namespace App\Classes;

use FPDF;

class CertificadoPDF extends FPDF {
    private string $nombre;
    private ?string $logo;
    private ?string $fondo;

    public function __construct(string $nombre, ?string $logo = null, ?string $fondo = null) {
        // Orientación horizontal ('L'), A4
        parent::__construct('L', 'mm', 'A4');

        //$this->AddFont('DancingScript-Regular', '', __DIR__.'/fonts/DancingScript-Regular.php');

        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->fondo = $fondo;

        $this->AddPage();
        $this->generarContenido();
    }

    function Header() {
        // Fondo
        if ($this->fondo && file_exists($this->fondo)) {
            $this->Image($this->fondo, 0, 0, 297, 210); // A4 horizontal: 297x210 mm
        }

        // Logo de la escuela
        if ($this->logo && file_exists($this->logo)) {
            $this->Image($this->logo, 10, 15, 30); // esquina superior derecha
        }

        $this->SetFont('Arial', 'B', 30);
        $this->SetTextColor(0, 0, 0); // Azul
        $this->Cell(0, 40, utf8_decode('CERTIFICADO DE FINALIZACIÓN'), 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        // $this->SetY(-30);
        // $this->SetFont('Arial', '', 10);
        // $this->SetTextColor(130, 131, 131); // Gris

        // $this->Cell(0, 10, utf8_decode('Este certificado está validado por organismos reconocidos.'), 0, 1, 'C');

        // $this->SetY(-18);
        // // Logos simbólicos
        // $this->SetFillColor(205, 160, 45); // Dorado
        // $this->Rect(100, $this->GetY(), 20, 10, 'F');
        // $this->SetFillColor(71, 54, 24); // Café
        // $this->Rect(130, $this->GetY(), 20, 10, 'F');
        // $this->SetFillColor(48, 152, 212); // Azul
        // $this->Rect(160, $this->GetY(), 20, 10, 'F');
    }

    private function generarContenido() {
        $this->SetY(70);
        $this->SetFont('Arial', '', 16);
        $this->SetTextColor(0);
        $this->MultiCell(0, 10, utf8_decode("Se certifica que:"), 0, 'C');

        $this->Ln(4);
        $this->SetFont('Arial', 'I', 40);
        $this->SetTextColor(205, 160, 45);
        $this->MultiCell(0, 15, utf8_decode($this->nombre), 0, 'C');

        $this->Ln(4);
        $this->SetFont('Arial', '', 14);
        $this->SetTextColor(0);
        $this->MultiCell(0, 10, utf8_decode("Ha completado satisfactoriamente el curso."), 0, 'C');

        // $this->Ln(10);
        // $this->SetFont('Arial', '', 12);
        // $this->SetTextColor(255, 255, 255);
        // $this->Cell(0, 10, utf8_decode("Puntaje obtenido:"), 0, 1, 'C');

        // $this->SetFont('Arial', 'B', 18);
        // $this->SetTextColor(0, 120, 0); // Verde
        // $this->Cell(0, 10, $this->score . ' / 100', 0, 1, 'C');

        // $this->Ln(10);
        // $this->SetFont('Arial', '', 12);
        // $this->SetTextColor(255, 255, 255);
        // $this->Cell(0, 10, utf8_decode("Fecha de aprobación: ") . $this->fecha, 0, 1, 'C');
    }

    public function mostrar(string $nombreArchivo = 'certificado.pdf') {
        $this->Output('I', $nombreArchivo);
    }
}