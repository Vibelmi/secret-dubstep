<?php

if (isset($GLOBALS['CLEANED_POST']["email"]) && isset($GLOBALS['CLEANED_POST']["pass"]) && isset($GLOBALS['CLEANED_POST']["token"])) {
        include("modules/login/model/validateDAO.php");
        validateDAO::getInstance()->validate($GLOBALS['CLEANED_POST']["token"]);
} else {
    $cont = $this->content;
    include("modules/login/view/main.php");
}
?>
