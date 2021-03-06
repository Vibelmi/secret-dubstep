<?php
include_once("modules/module/controller/module.php");
include_once("modules/list_tickets/model/functions.php");

class list_tickets extends module{
	
	function __construct($fPath = "modules/list_tickets/data/content.xml") {
		$this->contentFilePath = $fPath;
		$this->position = "contentCenter";
		$this->display = true;
		$this->content = $this->getContentByLang($GLOBALS['language']);
	}

	public function printContent(){
		ob_start();
                include("modules/list_tickets/controller/index.php");
		$returned = ob_get_contents();
		ob_end_clean();
		return $returned;
	}

	
}
?>
