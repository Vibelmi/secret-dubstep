<?php

  //Use this file for all the includes!!
  include_once("utils/includes.php");
  
  //The current url
  $URL = $_SERVER['REQUEST_URI'];
  $HOST = $_SERVER['HTTP_HOST'];
  $home=explode("?",$URL);
  $SUBFOLDER = explode("index",$URL);
  $SUBFOLDER = $SUBFOLDER[0];
  /*<?php echo $GLOBALS['home'][0]; ?>*/
  
  session_start();
  
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
    if (isset($GLOBALS['CLEANED_GET']["page"])) {
        $page = $GLOBALS['CLEANED_GET']["page"];
    }
    $pageBuilder->printPage($page);
}
  
?>