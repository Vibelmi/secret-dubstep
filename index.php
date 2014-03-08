<?php

  //Use this file for all the includes!!
  include_once("utils/includes.php");
  
  //The current url
  $URL = $_SERVER['REQUEST_URI'];
  $home=explode("?",$URL); 
  /*<?php echo $GLOBALS['home'][0]; ?>*/
  
  //This is the global variable to use the mail system. You can call it as $GLOBALS['mailer']
  $mailer = new mailer();
  
  //This is the global variable to use Smarty. You can call it as $GLOBALS['smarty']
  $smarty = new Smarty();
  $smarty->setTemplateDir('views/templates');
  $smarty->setCompileDir('views/templates_c');
  $smarty->assign('globals', $GLOBALS);
  
  //Create the object that creates the page
  $pageBuilder = new pageBuilder();
  
  //Print the requested page, pages are defined in the file pages.xml. 
  //If the page is not found, load the first page in pages.xml (usually the main).

  if(isset($GLOBALS['CLEANED_POST']["ajax"])){
      $pageBuilder->printModule($GLOBALS['CLEANED_POST']["ajax"]);
  }else{
    $page = "";
    if (isset($GLOBALS['CLEANED_GET']["page"])) { //Get langunage
        $page = $GLOBALS['CLEANED_GET']["page"];
    }
    $pageBuilder->printPage($page);
}
  
?>