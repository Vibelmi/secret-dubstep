<?php

$_SESSION['token'] = 2;

if ($_SESSION['token'] === 0) {
    include("modules/user_tickets/model/sendticketuser.php");
} elseif ($_SESSION['token'] === 1) {
    include("modules/user_tickets/model/sendticketprov.php");
} else {
    include("modules/user_tickets/model/sendticketguest.php");
}