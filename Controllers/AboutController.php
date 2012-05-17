<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AboutController
 *
 * @author Desarrollo 2
 */
class AboutController extends ControllerBase {
    //put your code here
    
    function Quienes () {
        $this->view->partial("quienes.php");
    }
    
    function Como () {
        $this->view->partial("como.php");
    }
    
    function Documentacion () {
        $this->view->partial("documentacion.php");
    }
}

?>
