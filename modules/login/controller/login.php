<?php

include_once ("modules/module/controller/module.php");

class login extends module {

    function __construct($fPath = "modules/login/data/content.xml") {
        $this->contentFilePath = $fPath;
        $this->position = "header";
        $this->display = true;
        $this->content = $this->getContentByLang($GLOBALS['language']);
    }

    public function printContent() {
        ob_start();
        //$cont=$this->content;
        include("modules/login/controller/index.php");
        $returned = ob_get_contents();
        ob_end_clean();
        $returned .= $this->content->name . " " . $this->content->age;
        return $returned;
    }

}

?>
