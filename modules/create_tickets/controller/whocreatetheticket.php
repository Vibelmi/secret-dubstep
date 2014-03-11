<?php

if (isset($_SESSION['token'])) {
    if ($_SESSION['token'] == 0) {
        include("modules/create_tickets/model/sendticketuser.php");
    } elseif ($_SESSION['token'] == 1) {
        include("modules/create_tickets/model/sendticketprov.php");
    } else {
        include("modules/create_tickets/model/sendticketguest.php");
    }
}else{
    include("modules/create_tickets/model/sendticketguest.php");
}