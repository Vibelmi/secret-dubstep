<?php

include_once("modules/module/controller/module.php");

class slider extends module {

    function __construct($fPath = "modules/slider/data/content.xml") {
        $this->contentFilePath = $fPath;
        $this->position = "contentBottom";
        $this->display = true;
        $this->content = $this->getContentByLang($GLOBALS['language']);
    }

    function printContent() {
        ob_start();
        //include_once('modules/twitter/model/twitter.class.php');
        include_once("modules/slider/view/index.php");
        $returned = ob_get_contents();
        ob_end_clean();
        return $returned;
    }

}
?>

