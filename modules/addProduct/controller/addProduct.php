<?php
include_once("modules/module/controller/module.php");
class addProduct extends module{
	
	function __construct($fPath = "modules/addProduct/data/content.xml") {
		$this->contentFilePath = $fPath;
		$this->position = "contentCenter";
		$this->display = true;
		$this->content = $this->getContentByLang($GLOBALS['language']);
	}

	public function printContent(){
		ob_start();
                include("modules/addProduct/controller/index.php");
		$returned = ob_get_contents();
		ob_end_clean();
		return $returned;
	}

	
}
?>
