<?php
/*
* Here all inputs will be cleaned of not appropriate content
*/
//THIS TWO ARE THE VARIABLES THAT WE MUST USE IN ALL THE APPLICATION.
$CLEANED_GET = $_GET;
$CLEANED_POST = $_POST;


function cleanInput($input){
    return htmlspecialchars(addslashes(stripslashes(strip_tags(trim($input)))));
}

function cleanGET(){
  global $CLEANED_GET;
  foreach ($CLEANED_GET as $key => $value) { 
    $CLEANED_GET[$key] = cleanInput($value);
  }
}
function cleanPOST(){
  global $CLEANED_POST;
  foreach ($CLEANED_POST as $key => $value) { 
    $CLEANED_POST[$key] = cleanInput($value);
  }
}

cleanGET();
cleanPOST();
?>