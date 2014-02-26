<?php
include("modules/module/controller/module.php");
class testmodule1 extends module{
	
	function __construct($fPath = "modules/testmodule1/data/content.xml") {
		$this->contentFilePath = $fPath;
		$this->position = "contentTop";
		$this->display = true;
		$this->content = $this->getContentByLang($GLOBALS['language']);
	}

	public function printContent(){
		ob_start();
		include("modules/testmodule1/view/main.php");
		$returned = ob_get_contents();
		ob_end_clean();
		$returned .= $this->content->name ." ".$this->content->age;
		return $returned;
	}

	
}
?>
