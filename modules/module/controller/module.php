<?php
/*
* This is the main class for the modules.
*/
class module{
	protected $position; //The position where the module will be placed
	protected $display; //Enable or disable the module

	
	function __construct() {
		$this->position = "";
		$this->display = false;
	}

	public function printContent(){
		include("modules/module/view/main.php");
	}
	//Return if the enabled
	public function isActive(){
		return $this->display;
	}
	//Return the position of the module
	public function getPosition(){
		return $this->position;
	}

	
}
?>
