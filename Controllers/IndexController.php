<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 * Este controlador se encarga de cargar por primera vez la página. Es el primero
 * que se abre cuando se refresca la pagina o se ingresa por primera vez
 *
 * @author laboratorio de redes
 */
class IndexController extends ControllerBase {
    /*
     * Accion encargada de cargar todos los accesos iniciales
     */
    function index() {
        $model = $this->getModel("Access");
        $result = $model->getAccess();
        $this->view->show("index.php", $result, $this->get[0]);
    }
    
    /*
     * Accion para cargar todos los subaccesos que se ven al abrir un acceso
     */
    function subIndex() {
        $model = $this->getModel("Access");
        $result = $model->getSubAccess($this->get[0]);
        $this->view->partial("subAccess.php", $result, $this->get[0]);
    }
}
?>
