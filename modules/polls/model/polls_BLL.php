<?php

class polls_BLL {

    static $_instance;
    private $dao;

    function __construct() {
        include_once("modules/polls/model/polls_DAO.php");
        $this->dao = polls_DAO::getInstance();
        
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    function insert_new_poll($title, $options) {
        $this->dao->insert_new_poll($title, $options);
        $polls_titles = $this->dao->select_all_polls();


        return $polls_titles;
    }

    function list_polls() {
        $polls=$this->dao->select_all_polls()        ;
        $polls_options=$this->dao->select_options_from_polls(); 
        return array($polls,$polls_options);
    }

}
?>

