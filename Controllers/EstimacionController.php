<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Description of EstimacionController
 *
 * @author Andrés A. Pérez L.
 */

class EstimacionController extends ControllerBase{
    function Media(){
        $this->view->partial("media.php");
    }
    function Varianza(){
        $this->view->partial("varianza.php");
    }
    function Proporcion(){
        $this->view->partial("proporcion.php");        
    }
    function DiferenciaDeMedia(){
        $this->view->partial("difMedias.php");
    }
    function CoeficienteVarianzas(){
        $this->view->partial("coefVarianzas.php");
    }
    function DiferenciaProporcion(){
        $this->view->partial("difProporcion.php");
    }
    function Prediccion(){
        $this->view->partial("prediccion.php");
    }
    function Tolerancia(){
        $this->view->partial("tolerancia.php");
    }
}
?>
