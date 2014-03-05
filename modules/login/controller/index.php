<?php

if (isset($GLOBALS['CLEANED_POST']["email"]) && isset($GLOBALS['CLEANED_POST']["pass"]) && isset($GLOBALS['CLEANED_POST']["token"])) {
    if ($GLOBALS['CLEANED_POST']["token"] === "0") { //user
        include("modules/login/model/checkuser.php");
    } else { //provider
        include("modules/login/model/checkprovider.php");
    }
} else {
    $cont = $this->content;
    include("modules/login/view/main.php");
}
?>
