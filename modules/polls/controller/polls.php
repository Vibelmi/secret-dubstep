<?php

include_once("modules/module/controller/module.php");
class polls extends module {

    public $page = '';

    function __construct($fPath = "modules/polls/data/content.xml") {
        $this->isPage();
        $this->contentFilePath = $fPath;
        if ($this->page === 'admin_polls') {
            $this->position = "contentCenter";
        } else {
            $this->position = "bottomLeft";
        }
        $this->display = true;
        $this->content = $this->getContentByLang($GLOBALS['language']);
    }

    /**
     * Check the actual page and save on variable $page.
     */
    function isPage() {
        if (isset($GLOBALS['CLEANED_GET']["page"])) {
            $this->page = $GLOBALS['CLEANED_GET']["page"];
        }
    }

    function printContent() {
        ob_start();
        $cont = $this->content;

        if ($this->page === 'admin_polls') {
            //  include_once('modules/polls/model/polls.class.php');
            include_once("modules/polls/view/list_polls.php");
            include_once("modules/polls/view/new_poll.php");   
        } else {
            echo ('Noooo');
        };

        $returned = ob_get_contents();
        ob_end_clean();
        return $returned;
    }

}

?>
