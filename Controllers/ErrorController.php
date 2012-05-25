<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorController
 *
 * @author sedinson
 */
    class ErrorController extends ControllerBase {
        
        /*
         * Si ocurre un error se dispara este evento.
         * Un error puede ocurrir cuando se intenta cargar una pagina con un
         * controlador que no existe.
         */
        public function index() {
            $this->view->partial('error.php');
        }
    }
?>
