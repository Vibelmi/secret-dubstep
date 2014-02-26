<?php
include_once("modules/module/controller/module.php");
class testmodule3 extends module{
	
	function __construct() {
		$this->position = "contentBottom";
		$this->display = true;
	}

	public function printContent(){
		ob_start();
		include("modules/testmodule3/view/main.php");
		$returned = ob_get_contents();
		ob_end_clean();
		return $returned;
	}

	
}
?>
