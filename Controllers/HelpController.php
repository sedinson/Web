<?php
class HelpController extends ControllerBase {
	
	public function load() {
		$model = $this->getModel("Help");
        $result = $model->getInformation($this->get[0]);
        $this->view->partial("content.php", $result);
	}
}
?>