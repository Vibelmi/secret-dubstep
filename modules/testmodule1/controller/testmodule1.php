<?php
include("modules/module/controller/module.php");
class testmodule1 extends module{
	
	function __construct() {
		$this->position = "contentTop";
		$this->display = true;
	}

	public function printContent(){
		ob_start();
		include("modules/testmodule1/view/main.php");
		$returned = ob_get_contents();
		ob_end_clean();
		return $returned;
	}

	
}
?>
