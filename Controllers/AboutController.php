<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AboutController
 *
 * @author sedinson
 */
class AboutController extends ControllerBase {
    //put your code here
    
    /*
     * Accion que se carga al ver el acceso Quienes Colaboraron
     */
    function Quienes () {
        $this->view->partial("quienes.php");
    }
    
    /*
     * Accion que se carga al ver el acceso Como Contribuir
     */
    function Como () {
        $this->view->partial("como.php");
    }
}

?>
