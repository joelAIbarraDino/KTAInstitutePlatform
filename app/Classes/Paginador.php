<?php

namespace App\Classes;


class Paginador{
    public $paginaActual;
    public $totalRegistros;
    public $registrosPorPagina;

    public function __construct($paginaActual = 1, $totalRegistros = 10, $registrosPorPagina= 10){
        $this->paginaActual = (int)$paginaActual;
        $this->totalRegistros = (int)$totalRegistros;
        $this->registrosPorPagina = (int)$registrosPorPagina;
    }

    public function offset(){
        return $this->registrosPorPagina * ($this->paginaActual - 1);
    }
    
    public function totalPaginas(){
        return ceil($this->totalRegistros / $this->registrosPorPagina);
    }

    public function paginaAnterior(){
        return ($this->paginaActual - 1 > 0) ? $this->paginaActual - 1: false;
    }

    public function paginaSiguiente(){
        return ($this->paginaActual + 1 <= $this->totalPaginas())? $this->paginaActual + 1: false;
    }

    public function enlaceAnterior(){
        $html = '';

        if($this->paginaAnterior()){
            $html .= "<a href=\"?page={$this->paginaAnterior()}\" class=\"dashboard-table__page-button\"><i class=\"bx bx-chevron-left\"></i></a>";
        }

        return $html;
    }

    public function enlaceSiguiente(){
        $html = '';

        if($this->paginaSiguiente()){
            $html .= "<a href=\"?page={$this->paginaSiguiente()}\" class=\"dashboard-table__page-button\"><i class=\"bx bx-chevron-right\"></i></a>";
        }

        return $html;
    }

    public function paginacion(){
        $html = '';

        $html.= '<div class="dashboard-table__footer">';
        $html.= '<div class="dashboard-table__pagination">';
        $html.= $this->enlaceAnterior();
        $html.= "<span class=\"dashboard-table__page-info\">Página {$this->paginaActual} de {$this->totalPaginas()}</span>";
        $html.= $this->enlaceSiguiente();
        $html.= '</div>';
        $html.= '</div>';

        return $html;
    }
}