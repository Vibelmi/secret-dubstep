<?php
  /*
  * Here we catch the selected language from the "lang" Get parameter. 
  * If the "lang" parameter is not passed or is not an allowed language, the default language "en"
  * will be assigned.
  * The result is assigned to a global variable "language" so that it can be used in all the application.
  */
  $allowedLanguages = array("en","es");
				
  $language = "en"; //Default language
  if(isset($GLOBALS['CLEANED_GET']["lang"])){ //Get langunage
	if(in_array($GLOBALS['CLEANED_GET']["lang"], $allowedLanguages)){
		$language = $GLOBALS['CLEANED_GET']["lang"];
	}
  }
?>