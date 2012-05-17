<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GraficasController
 *
 * @author Edinson Salas
 */
class GraficasController extends ControllerBase {
    function Torta () {
        $this->view->partial("torta.php");
    }
    
    function Barra () {
        $this->view->partial("barra.php");
    }
    
    function Frecuencia () {
        $this->view->partial("frecuencia.php");
    }
    
    function FrecuenciaAcumulada () {
        $this->view->partial("frecuenciaAcumulada.php");
    }
    
    function CajayBigotes () {
        $this->view->partial("cajaybigotes.php");
    }
}

?>
