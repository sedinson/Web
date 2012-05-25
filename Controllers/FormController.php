<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 * Esta clase es la encargada de cargar las vistas de los formularios y si es necesario
 * tambien contenido que debe tener previamente estos.
 *
 * @author sedinson
 */

class FormController extends ControllerBase {
    
    /*
     * Accion para agregar un nuevo acceso (botones con simbolo + grande)
     */
    function addAccess () {
        $this->view->partial("addAccess.php", null);
    }
    
    /*
     * Accion para agregar un nuevo subacceso (botones con el + dentro de los accesos
     */
    function addSubAccess () {
        $this->view->partial("addSubAccess.php", null, $this->get[0]);
    }
    
    /*
     * Accion para eliminar un acceso
     */
    function deleteBox() {
        $this->view->partial("deleteBox.php", null, $this->get[0]);
    }
    
    /*
     * Accion para eliminar un subacceso
     */
    function deleteBox2() {
        $this->view->partial("deleteBox2.php", null, $this->get[0]);
    }
	
    /*
     * Accion para mostrar el formulario de edicion y de nueva ayuda
     */
    function help() {
        $model = $this->getModel("Help");
        $result = $model->getAllInformation($this->get[0]);
        $this->view->partial("editar.php", $result, $this->get[0]);
    }

    /*
     * Accion para mostrar el formulario de edicion y de nuevo ejemplo
     */
    function example() {
        $model = $this->getModel("Example");
        $result = $model->getAllInformation($this->get[0]);
        $this->view->partial("editExample.php", $result, $this->get[0]);
    }
}
?>
