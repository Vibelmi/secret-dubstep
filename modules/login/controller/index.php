<?php
$cont1 = $this->content;
if (isset($GLOBALS['CLEANED_POST']["email"]) && isset($GLOBALS['CLEANED_POST']["pass"]) && isset($GLOBALS['CLEANED_POST']["token"])) {
    include("modules/login/model/validateDAO.php");
    validateDAO::getInstance()->validate($GLOBALS['CLEANED_POST']["token"]);
} elseif (isset($GLOBALS['CLEANED_POST']["email"]) && isset($GLOBALS['CLEANED_POST']["new_pass"]) && isset($GLOBALS['CLEANED_POST']["token"])) {
    $cont = $this->content;
    include("modules/login/model/remember_passDAO.php");
    rememberDAO::getInstance($cont)->validateEmail($GLOBALS['CLEANED_POST']["token"]);
} else {
    $cont = $this->content;
    include("modules/login/view/main.php");
}
?>
