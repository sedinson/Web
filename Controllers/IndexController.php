<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IndexController
 *
 * @author laboratorio de redes
 */
class IndexController extends ControllerBase {
    //put your code here
    function index() {
        $model = $this->getModel("Access");
        $result = $model->getAccess();
        $this->view->show("index.php", $result, $this->get[0]);
    }
    
    function subIndex() {
        $model = $this->getModel("Access");
        $result = $model->getSubAccess($this->get[0]);
        $this->view->partial("subAccess.php", $result, $this->get[0]);
    }
}
?>
