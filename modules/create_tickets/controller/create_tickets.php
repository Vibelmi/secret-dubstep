<?php
include_once("modules/module/controller/module.php");
class create_tickets extends module{
	
	function __construct($fPath = "modules/create_tickets/data/content.xml") {
		$this->contentFilePath = $fPath;
		$this->position = "contentCenter";
		$this->display = true;
		$this->content = $this->getContentByLang($GLOBALS['language']);
	}

	public function printContent(){
		ob_start();
                include("modules/create_tickets/controller/index.php");
		$returned = ob_get_contents();
		ob_end_clean();
		return $returned;
	}

	
}
?>
