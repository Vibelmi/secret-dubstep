<?php
if (isset($GLOBALS['CLEANED_POST']["subject"], $GLOBALS['CLEANED_POST']["description"])) {
    include("modules/create_tickets/controller/whocreatetheticket.php");
    
} else {
    $cont = $this->content;
    include("modules/create_tickets/view/main.php"); 
}

