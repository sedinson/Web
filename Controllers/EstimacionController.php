<?php

/**
 * Controlador para la Unidad de Estimacion
 *
 * @author Andrés A. Pérez L.
 */

class EstimacionController extends ControllerBase{
    /*
     *Accion para el intervalo de confianza para la Media
     */
    function Media(){
        $this->view->partial("media.php");
    }
    /*
     *Accion para el intervalo de confianza para la Varianza
     */
    function Varianza(){
        $this->view->partial("varianza.php");
    }
    /*
     *Accion para el intervalo de confianza para la Proporcion
     */
    function Proporcion(){
        $this->view->partial("proporcion.php");        
    }
    /*
     *Accion para el intervalo de confianza para la Diferencia de Medias
     */
    function DiferenciaDeMedia(){
        $this->view->partial("difMedias.php");
    }
    /*
     *Accion para el intervalo de confianza para el Cociente de Varianzas
     */
    function CocienteVarianzas(){
        $this->view->partial("cocienteVarianzas.php");
    }
    /*
     *Accion para el intervalo de confianza para la Diferencia de Medias
     */
    function DiferenciaProporcion(){
        $this->view->partial("difProporcion.php");
    }
    /*
     *Accion para el Intervalo de Prediccion
     */
    function Prediccion(){
        $this->view->partial("prediccion.php");
    }
    /*
     *Accion para el Intervalo de Tolerancia
     */
    function Tolerancia(){
        $this->view->partial("tolerancia.php");
    }
}
?>
