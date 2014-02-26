<?php
/*
* This is the main class for the modules.
*/
class module{
	protected $position; //The position where the module will be placed
	protected $display; //Enable or disable the module
	protected $content;
	protected $contentFilePath;
	
	function __construct($fPath = "modules/module/data/content.xml") {
		$this->contentFilePath = $fPath;
		$this->position = "";
		$this->display = false;
		$this->content = $this->getContentByLang($GLOBALS['language']);
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
	protected function getContent(){
		$xml = new xmlRead($this->contentFilePath);
		return $xml->getXml();
	}
	protected function getContentByLang($lang){
		$xml = new xmlRead($this->contentFilePath);
		$cont = $xml->getXml();
		foreach($cont->translation as $trans){
			if($trans["language"] == $lang){
				return $trans;
			}
		}
		return false;
	}

	
}
?>
