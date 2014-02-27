<?php
  $allowedLanguages = array("en","es");
				
  $language = "en"; //Default language
  if(isset($GLOBALS['CLEANED_GET']["lang"])){ //Get langunage
	if(in_array($GLOBALS['CLEANED_GET']["lang"], $allowedLanguages)){
		$language = $GLOBALS['CLEANED_GET']["lang"];
	}
  }
?>