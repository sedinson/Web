<?php

/**
 * Controlador para la Unidad de Distribuciones
 *
 * @author David Seija Duque
 */

class ProbabilityController extends ControllerBase
{
    /*
     *Accion para la Distribucion Binomial
     */
    function Binomial ()
    {
        $this->view->partial("binomial.php");
    }
    
    /*
     *Accion para la Distribucion Geometrica
     */
    function Geometrica ()
    {
        $this->view->partial("geometrica.php");
    }
    
    /*
     *Accion para la Distribucion Binomial Negativa
     */
    function BinomialNegativa ()
    {
        $this->view->partial("binomialnegativa.php");
    }
    
    /*
     *Accion para la Distribucion HiperGeometrica
     */
    function HiperGeometrica ()
    {
        $this->view->partial("hipergeometrica.php");
    }
    
    /*
     *Accion para la Distribucion Poisson
     */
    function Poisson ()
    {
        $this->view->partial("poisson.php");
    }
    
    /*
     *Accion para la Distribucion Uniforme Discreta
     */
    function UniformeDiscreta ()
    {
        $this->view->partial("uniformediscreta.php");
    }
    
    /*
     *Accion para la Distribucion Normal
     */
    function Normal ()
    {
        $this->view->partial("normal.php");
    }
    
    /*
     *Accion para la Distribucion Normal Estandar
     */
    function NormalEstandar ()
    {
        $this->view->partial("normalestandar.php");
    }
    
    /*
     *Accion para la Distribucion Uniforme Continua
     */
    function UniformeContinua ()
    {
        $this->view->partial("uniformecontinua.php");
    }
    
    /*
     *Accion para la Distribucion Exponencial
     */
    function Exponencial ()
    {
        $this->view->partial("exponencial.php");
    }
}

?>
