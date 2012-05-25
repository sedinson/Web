<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExampleController
 *
 * @author sedinson
 */
class ExampleController extends ControllerBase {
	
    /*
     * Accion encargada de cargar la ayuda. Tra la informacion de ExampleModel
     */
	public function load() {
            $model = $this->getModel("Example");
            $result = $model->getInformation($this->get[0]);
            $this->view->partial("content.php", $result);
	}
}
?>