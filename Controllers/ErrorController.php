<?php
    class ErrorController extends ControllerBase {
        
        public function index() {
            $this->view->partial('error.php');
        }
    }
?>
