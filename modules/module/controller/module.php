<?php
/*
* This is the main class for the modules.
*/
class module{
	protected $position; //The position where the module will be placed
	protected $display; //Enable or disable the module
	protected $content; //Multilanguage content
	protected $contentFilePath; //Multilanguage content file path
	
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
        /*
         * This method load the content from the multilanguage content file in the module object so it can be used
         */
	protected function getContent(){
		$xml = new xmlRead($this->contentFilePath);
		return $xml->getXml();
	}
        /*
         * This method load the content of the gived language from the multilanguage content file in the module object so it can be used
         * This is by default called in the constructor to load the content of the current selected language
         */
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
