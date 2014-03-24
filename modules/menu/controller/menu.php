<?php
include_once ("modules/module/controller/module.php");
class menu extends module{
	function __construct($fPath = "modules/menu/data/content.xml") {
		$this->contentFilePath = $fPath;
		$this->position = "headerCenter";
		$this->display = true;
		$this->content = $this->getContentByLang($GLOBALS['language']);
	}

	public function printContent(){
		ob_start();
                include("modules/menu/view/main.php");
                $returned = ob_get_contents();
                ob_end_clean();
                return $returned;
	}
}
?>
