<?php
echo $_POST["subject"];
if (isset($GLOBALS['CLEANED_POST']["subject"], $GLOBALS['CLEANED_POST']["description"])) {
    include("modules/user_tickets/model/sendticket.php");
    
} else {
    $cont = $this->content;
    include("modules/user_tickets/view/main.php"); 
}

