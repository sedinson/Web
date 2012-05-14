<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author sedinson
 */

class FormController extends ControllerBase {
    
    function addAccess () {
        $this->view->partial("addAccess.php", null);
    }
    
    function addSubAccess () {
        $this->view->partial("addSubAccess.php", null, $this->get[0]);
    }
    
    function deleteBox() {
        $this->view->partial("deleteBox.php", null, $this->get[0]);
    }
    
    function deleteBox2() {
        $this->view->partial("deleteBox2.php", null, $this->get[0]);
    }
	
	function help() {
		$model = $this->getModel("Help");
		$result = $model->getAllInformation($this->get[0]);
		$this->view->partial("editar.php", $result, $this->get[0]);
	}
	
	function example() {
		$model = $this->getModel("Example");
		$result = $model->getAllInformation($this->get[0]);
		$this->view->partial("editExample.php", $result, $this->get[0]);
	}
}
?>
