<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MedidasController
 *
 * @author sedinson
 */
class MedidasController extends ControllerBase {
    
    function Centralizacion () {
        $this->view->partial("centralizacion.php");
    }
    
    function Variabilidad () {
        $this->view->partial("variabilidad.php");
    }
    
    function Posicion () {
        $this->view->partial("posicion.php");
    }
    
    function Forma () {
        $this->view->partial("forma.php");
    }
}

?>
