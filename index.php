<?php
  $language = "en"; //Default language
  if(isset($GLOBALS['CLEANED_GET']["lang"])){ //Get langunage
	$language = $GLOBALS['CLEANED_GET']["lang"];
  }
  //Use this file for all the includes!!
  include_once("utils/includes.php");
  //Create the object that creates the page
  $pageBuilder = new pageBuilder();
  //Print the requested page, pages are defined in the file pages.xml. 
  //If the page is not found, load the first page in pages.xml (usually the main).
  $pageBuilder->printPage($GLOBALS['CLEANED_GET']["page"]);
?>