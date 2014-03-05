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
	//Pages saved in the pages.xml configuration file
	private $pages;
	//Module's styles
	private $styles;
	function __construct(){
	
		$this->loadModules();
		$this->loadModuleStyles();


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
	* This method loads all modules in the modules folder as objects.
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
	* This method loads all the css files of the modules. This css files may be in the "css" file inside the module file.
	*/
	function loadModuleStyles(){
		$this->styles = "";
		$modulesDirectorys = scandir("modules");
		foreach($modulesDirectorys as $moduleName){
			if($moduleName != "." && $moduleName != ".." && $moduleName != "pages.xml" && $moduleName != "module"){
				if(file_exists("modules/".$moduleName."/css")){
                                    $styleFiles = scandir("modules/".$moduleName."/css");
                                    foreach($styleFiles as $styleFile){
                                            if(strpos($styleFile ,'.css') !== false){
                                                    $this->styles .= '<link rel="stylesheet" type="text/css" href="modules/'.$moduleName.'/css/'.$styleFile.'">';
                                            }
                                    }
                                }

				
			}
		}
	}
        function printModule($moduleName){
            if(array_key_exists($moduleName, $this->modules)){
                echo $this->modules[$moduleName]->printContent();
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
		include("views/header.php");
		
		$this->createPage($requestedPage);
		
		$GLOBALS['smarty']->assign('Content', $this->displayAreas);
		$GLOBALS['smarty']->assign('Styles', $this->styles);				
		$GLOBALS['smarty']->display('index.tpl');
		
		include("views/footer.php");
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





