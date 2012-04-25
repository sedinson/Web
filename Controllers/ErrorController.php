<?php
    class ErrorController extends ControllerBase {
        
        public function index() {
            $this->view->show('error.php', null);
        }
    }
?>
