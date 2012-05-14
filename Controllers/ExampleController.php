<?php
class ExampleController extends ControllerBase {
	
	public function load() {
		$model = $this->getModel("Example");
        $result = $model->getInformation($this->get[0]);
        $this->view->partial("content.php", $result);
	}
}
?>