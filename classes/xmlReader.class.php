<?php
class xmlRead{
	private $xml;
	function __construct($xmlFile){
		$this->xml = simplexml_load_file($xmlFile);
	}
	function getXml(){
		return $this->xml;
	}
}
?>
