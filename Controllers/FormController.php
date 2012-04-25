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
}
?>
