<?php

if (isset($GLOBALS['CLEANED_POST']["email"]) && isset($GLOBALS['CLEANED_POST']["token"])) {
    $cont = $this->content;
    include("modules/registry/model/checkemailDAO.php");
    checkemailDAO::getInstance($cont)->validateEmail();
} elseif (isset($GLOBALS['CLEANED_POST']["data"]) && isset($GLOBALS['CLEANED_POST']["token"])) {
    $cont = $this->content;
    include("modules/registry/model/registryDAO.php");
    registryDAO::getInstance($cont)->validateall();
} elseif (isset($GLOBALS['CLEANED_GET']["id"]) && isset($GLOBALS['CLEANED_GET']["number"])) {
    $cont = $this->content;
    include("modules/registry/model/confirmationUserDAO.php");
    confirmUserlDAO::getInstance($cont)->checkValidation();
} else {
    $cont = $this->content;
    include("modules/registry/view/main.php");
}
?>
