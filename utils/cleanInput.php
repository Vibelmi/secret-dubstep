<?php
/*
* Here all inputs will be cleaned of not appropriate content
*/
/*
//THIS TWO ARE THE VARIABLES THAT WE MUST USE IN ALL THE APPLICATION.
$CLEANED_GET = $_GET;
$CLEANED_POST = $_POST;


function cleanInput(){
    $search = array(
        '@<script[^>]*?>.*?</script>@si', 	// Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si', 		// Strip out HTML tags
        '@<style[^>]*?>.*?</style>@siU', 	// Strip style tags properly
        '@<![\s\S]*?--[ \t\n\r]*>@'         	// Strip multi-line comments
    );
    $output = preg_replace($search, '', $input);
    return $output;
}

function cleanGET(){
  foreach ($CLEANED_GET as $key => $value) { 
    $CLEANED_GET[$key] = cleanInput($value);
  }
}
function cleanPOST(){
  foreach ($CLEANED_POST as $key => $value) { 
    $CLEANED_POST[$key] = cleanInput($value);
  }
}

cleanGET();
cleanPOST();

print_r($CLEANED_GET);
*/
?>