<?php

$cont = $this->content;
if ((isset($GLOBALS['CLEANED_POST']["subject"], $GLOBALS['CLEANED_POST']["description"]))||(isset($_SESSION['response_subject'], $GLOBALS['CLEANED_POST']["description"]))) {
    include("modules/create_tickets/controller/whocreatetheticket.php");
} elseif ((isset($GLOBALS['CLEANED_POST']["passwordt"])) || (isset($GLOBALS['CLEANED_GET']["idtu"])) || (isset($GLOBALS['CLEANED_GET']["idtp"]))) {
    include("modules/create_tickets/view/response.php");
} elseif (!isset($GLOBALS['CLEANED_GET']["idtg"])) {
    include("modules/create_tickets/view/main.php");
}

