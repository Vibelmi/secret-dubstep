<?php

/*
* This class:
  -Loads dinamically all the modules
  -Get the pages structure from pages.xml
  -Creates and print the page
*/

class pageBuilder{
	//Array of modules
	private $modules;
	//Dinamic content by position (hooks)
	private $displayAreas;
	private $pages;
	function __construct(){

		$this->loadModules();

		$this->displayAreas = array("header" => "",
						"footer" => "",
						"contentTop" => "",
						"contentCenter" => "",
						"contentBottom" => "",
						"bottomLeft" => "",
						"bottomCenter" => "",
						"bottomRight" => "",);

		$xml = new xmlRead("modules/pages.xml");
		$this->pages = $xml->getXml();
	}
	/*
	* This method is the __autoload() for the modules
	*/
	static public function autoLoadModule($class_name) {
		include ("modules/".$class_name."/controller/".$class_name . '.php');
	}
	
	/*
	* This method loads all active modules in the modules folder as objects.
	*/
	function loadModules(){
		$modulesDirectorys = scandir("modules");
		foreach($modulesDirectorys as $moduleName){
			if($moduleName != "." && $moduleName != ".." && $moduleName != "pages.xml" && $moduleName != "module"){
				$module = new $moduleName();
				$this->modules[$moduleName] = $module;
			}
		}
	}

	/*
	* This method load the contents of the modules into the displayAreas array.
	*/
	function createPage($requestedPage){
		$page = $this->searchPage($requestedPage);
		foreach($page->module as $module){
			$module = (string)$module;
			if($this->modules[$module]->isActive()){
				$this->addContent($this->modules[$module]->getPosition(),$this->modules[$module]->printContent());
			}
			
		}
	}
	/*
	* This method print the page. Use Smarty to give the displayAreas array of content to the tpl.
	*/
	function printPage($requestedPage){
		$this->createPage($requestedPage);
		
		/*
		$smarty = new Smarty;

		$smarty->assign('Content', $this->displayAreas);
		$smarty->display('views/index.tpl');
		*/
		echo '
			<html>
			<head>
			<link rel="stylesheet" type="text/css" href="css/hooks.css">
			</head>
			<body>
			<header></header>
			<section class="contentTop">'.$this->displayAreas["contentTop"].'</section>
			<section class="contentCenter">'.$this->displayAreas["contentCenter"].'</section>
			<section class="contentBottom">'.$this->displayAreas["contentBottom"].'</section>
			<aside class="bottomLeft">'.$this->displayAreas["bottomLeft"].'</aside>
			<aside class="bottomCenter">'.$this->displayAreas["bottomCenter"].'</aside>
			<aside class="bottomRight">'.$this->displayAreas["bottomRight"].'</aside>
			</body>
			</html>
		';
	}

	/*
	* This method search a page into our pages variable, that reads from the pages.xml
	* If the page is not founded returns the first one.
	*/
	function searchPage($pageToSearch){
		foreach($this->pages->page as $page){
			if($page["name"] == $pageToSearch){
				return $page;
			}
		}
		return $this->pages->page[0];
	}
	/*
	* This method add the $content to the corresponding position in the displayAreas array
	*/
	function addContent($position, $content){
		if(array_key_exists($position,$this->displayAreas)){
			$this->displayAreas[$position] .= $content;
		}
	}
}

//This enable our custom __autoload() (named autoLoadModule).
// IS VERY IMPORTANT!!
spl_autoload_register('\pageBuilder::autoLoadModule');
?>





