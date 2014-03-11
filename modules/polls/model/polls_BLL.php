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
    }

////////////////////////////////////////////////////////////////////////////////////////
    function list_polls() {
        $polls = $this->dao->select_all_polls();
        $polls_options = $this->dao->select_options_from_polls();
//Get polls
        $poll_arr = array();
        while ($poll = $polls->fetch_assoc()) {
            array_push($poll_arr, $poll);
        }

//Get polls_options
        $poll_options_arr = array();
        while ($poll_options = $polls_options->fetch_assoc()) {
            array_push($poll_options_arr, $poll_options);
        }
        return array($poll_arr, $poll_options_arr);
    }

    function count_votes($option_id) {
        $votes = $this->dao->count_votes($option_id);
        return $votes;
    }

////////////////////////////////////////////////////////////////////////////////////////
    //Return the fields of the active poll
    function poll_active() {
        $polls = $this->dao->select_all_polls();
        $poll_active = $this->dao->poll_active($polls);

        return $poll_active;
    }

    function vote($option_id) {
        $poll_active = $this->poll_active();

        $this->dao->insert_vote($option_id, $poll_active['poll_id']);
    }

    function change_active_poll($poll_selected) {
        $this->dao->deactivate_all_polls();
        $this->dao->activate_poll($poll_selected);
        
    }

}
?>

