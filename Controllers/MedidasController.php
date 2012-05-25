<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MedidasController
 * Clase encargada de las vistas de medidas
 *
 * @author sedinson
 */
class MedidasController extends ControllerBase {
    
    /*
     * Accion encargada de cargar la vista de medidas de centralizacion
     */
    function Centralizacion () {
        $this->view->partial("centralizacion.php");
    }
    
    /*
     * Accion encargada de cargar las medidas de variabilidad
     */
    function Variabilidad () {
        $this->view->partial("variabilidad.php");
    }
    
    /*
     * Accion encargada de cargar las medidas de posicion
     */
    function Posicion () {
        $this->view->partial("posicion.php");
    }
    
    /*
     * Accion encargada de cargar las medidas de forma
     */
    function Forma () {
        $this->view->partial("forma.php");
    }
}

?>
