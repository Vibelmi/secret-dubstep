<?php

include_once("modules/module/controller/module.php");

class twitter extends module {

    function __construct($fPath = "modules/twitter/data/content.xml") {
        $this->contentFilePath = $fPath;
        $this->position = "bottomRight";
        $this->display = true;
        $this->content = $this->getContentByLang($GLOBALS['language']);
    }

    function printContent() {
        ob_start();
        $cont = $this->content;
        include_once('modules/twitter/model/twitter.class.php');
        include_once("modules/twitter/view/main.php");
        $returned = ob_get_contents();
        ob_end_clean();
        return $returned;
    }

}
?>

