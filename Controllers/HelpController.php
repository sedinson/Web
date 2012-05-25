<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HelpController
 * Contiene el controlador encargado de cargar el contenido de la ayuda
 *
 * @author sedinson
 */
class HelpController extends ControllerBase {
	
    /*
     * Accion encargada de cargar y mostrar la ayuda
     */
    public function load() {
        $model = $this->getModel("Help");
        $result = $model->getInformation($this->get[0]);
        $this->view->partial("content.php", $result);
    }
}
?>