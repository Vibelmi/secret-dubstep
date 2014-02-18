<?php
include_once("modules/module/controller/module.php");
class testmodule2 extends module{
	
	function __construct() {
		$this->position = "bottomRight";
		$this->display = true;
	}

	public function printContent(){
		ob_start();
		include("modules/testmodule2/view/main.php");
		$returned = ob_get_contents();
		ob_end_clean();
		return $returned;
	}

	
}
?>
