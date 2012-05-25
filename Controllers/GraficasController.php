<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GraficasController
 * Esta accion es la encargada de cargar las vistas de cada grafica mostrada por el
 * programa. Todas las vistas poseen las mismas caracteristicas, solo cambia algunos
 * datos que carga la clase Graph (JS) que es la que decide que grafico pintar.
 *
 * @author Edinson Salas
 */
class GraficasController extends ControllerBase {
    
    /*
     * Accion para cargar el grafico de torta
     */
    function Torta () {
        $this->view->partial("torta.php");
    }
    
    /*
     * Accion para cargar el grafico de Barra (Histograma realmente, barra no se hizo)
     */
    function Barra () {
        $this->view->partial("barra.php");
    }
    
    /*
     * Accion para cargar la grafica de frecuencia
     */
    function Frecuencia () {
        $this->view->partial("frecuencia.php");
    }
    
    /*
     * Accion para cargar la ojiva
     */
    function FrecuenciaAcumulada () {
        $this->view->partial("frecuenciaAcumulada.php");
    }
    
    /*Accion para cargar el diagrama de caja y bigotes*/
    function CajayBigotes () {
        $this->view->partial("cajaybigotes.php");
    }
    
    /*
     * Accion para cargar el diagrama de pareto
     */
    function Pareto () {
        $this->view->partial("pareto.php");
    }
    
    /*
     * Accion para cargar el Poligono de frecuencia
     */
    function PoligonoFrecuencia () {
        $this->view->partial("poligonoFrecuencia.php");
    }
    
    /*
     * Accion para cargar el diagrama de Puntos
     */
    function Puntos() {
        $this->view->partial("puntos.php");
    }
    
    /*
     * Accion para cargar la vista que contiene el formulario en el cual se agregan
     * los datos manualmente a la aplicacion (especial para las vistas de medicion
     * y las vistas de graficos. Los datos quedan almacenados en memoria)
     */
    function Datos () {
        $this->view->partial("ingresarDatos.php");
    }
    
    /*
     * Accion para cargar el diagrama de tallo y hojas
     */
    function TalloyHojas () {
        $this->view->partial("talloyhojas.php");
    }
}
?>
