<?php

class ProbabilityController extends ControllerBase
{
    function Binomial ()
    {
        $this->view->partial("binomial.php");
    }
    
    function Geometrica ()
    {
        $this->view->partial("geometrica.php");
    }
    
    function BinomialNegativa ()
    {
        $this->view->partial("binomialnegativa.php");
    }
    
    function HiperGeometrica ()
    {
        $this->view->partial("hipergeometrica.php");
    }
    
    function Poisson ()
    {
        $this->view->partial("poissongeometrica.php");
    }
    
    function UniformeDiscreta ()
    {
        $this->view->partial("uniformediscreta.php");
    }
    
    function Normal ()
    {
        $this->view->partial("normal.php");
    }
    
    function NormalEstandar ()
    {
        $this->view->partial("normalestandar.php");
    }
    
    function UniformeContinua ()
    {
        $this->view->partial("uniformecontinua.php");
    }
    
    function Exponencial ()
    {
        $this->view->partial("exponencial.php");
    }
}

?>
