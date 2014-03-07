<?php
$cont = $this->content;
if (isset($GLOBALS['CLEANED_POST']["subject"], $GLOBALS['CLEANED_POST']["description"])) {
    include("modules/create_tickets/controller/whocreatetheticket.php");
    
} else {
    include("modules/create_tickets/view/main.php"); 
}

