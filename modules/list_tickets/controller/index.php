<?php

$cont = $this->content;
if (isset($_SESSION['email'])) {
    if ((isset($GLOBALS['CLEANED_GET']["idtu"])) && ($_SESSION['token'] == 0)) {
        include("modules/list_tickets/model/userticket.php");
    } elseif ((isset($GLOBALS['CLEANED_GET']["idtp"])) && ($_SESSION['token'] == 1)) {
        include("modules/list_tickets/model/provticket.php");
    } elseif ($_SESSION['token'] == 0) {
        include("modules/list_tickets/view/mainuser.php");
    } elseif ($_SESSION['token'] == 1) {
        include("modules/list_tickets/view/mainprov.php");
    } elseif ($_SESSION['token'] == 10) {
        include("modules/list_tickets/view/mainadmin.php");
    }
} elseif ((isset($GLOBALS['CLEANED_GET']["idtg"], $GLOBALS['CLEANED_POST']["passwordt"]))||(isset($GLOBALS['CLEANED_GET']["idtg"], $_SESSION["response_password"]))) {
    include("modules/list_tickets/model/guesttickets.php");
} elseif (isset($GLOBALS['CLEANED_GET']["idtg"])) {
    include("modules/list_tickets/view/mainguest.php");
} else {
    //fail
}