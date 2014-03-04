<?php

  //Use this file for all the includes!!
  include_once("utils/includes.php");
  //Create the object that creates the page
  $pageBuilder = new pageBuilder();
  //The current url
  $URL = $_SERVER['REQUEST_URI'];
  //Print the requested page, pages are defined in the file pages.xml. 
  //If the page is not found, load the first page in pages.xml (usually the main).
  $page = "";
  if(isset($GLOBALS['CLEANED_GET']["page"])){ //Get langunage
	$page = $GLOBALS['CLEANED_GET']["page"];
  }
  $pageBuilder->printPage($page);
?>