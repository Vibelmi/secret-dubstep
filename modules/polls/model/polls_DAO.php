<?php

class polls_DAO {

    static $_instance;
    private $bd;

    function __construct() {
        $this->bd = Db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    //Insert new poll on database
    function insert_new_poll($title, $options) {
        //Poll
        $query = new SqlQueryBuilder("insert");
        $query->setTable("polls");
        $query->addColumn("title");
        $query->addValue($title);
        $query->addColumn("active");
        $query->addValue("1");
        try {
            $this->bd->run($query->buildQuery());
            //Get id from the recent poll created.
            $last_id = $this->bd->lastID();
            foreach ($options as $option) {
                $query = new SqlQueryBuilder("insert");
                //Options           
                $query->setTable("polls_options");
                $query->addColumn("poll_id");
                $query->addValue($last_id);
                $query->addColumn("option_text");
                $query->addValue($option);
                $this->bd->run($query->buildQuery());
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    function select_all_polls() {
        $query = new SqlQueryBuilder("select");
        $query->setTable('polls');
        $query->addColumn('*');
        $query->setWhere("");
        $query->setOrderBy("poll_id DESC");
        $polls = $this->bd->run($query->buildQuery());


        return $polls;
    }

    /////
    function select_options_from_polls() {
        $query = new SqlQueryBuilder("select");
        $query->setTable('polls_options');
        $query->addColumn('*');
        $query->setWhere("");
        $options = $this->bd->run($query->buildQuery());

        return $options;
    }

    function poll_active($polls) {
        $id_poll_active;
        while ($poll = $polls->fetch_assoc()) {
            if ($poll['active']) {
                $id_poll_active = $poll;
            }
        }
        return $id_poll_active;
    }

    function count_votes($option_id) {
        $query = new SqlQueryBuilder("query");
        $query->setQuery("SELECT * ,COUNT(*) AS 'count' FROM polls_answers WHERE option_id= " . $option_id);
        $votes = $this->bd->run($query->buildQuery());
        $votes = $votes->fetch_assoc();
        return $votes;
    }

    function insert_vote($option_id, $poll_id) {
        $ip = get_client_ip();
        $query = new SqlQueryBuilder("insert");
        $query->setTable('polls_answers');
        $query->addColumn('ip');
        $query->addValue($ip);
        $query->addColumn('option_id');
        $query->addValue($option_id);
        $query->addColumn('poll_id');
        $query->addValue($poll_id);

        $this->bd->run($query->buildQuery());
    }

    function deactivate_all_polls() {
        $query = new SqlQueryBuilder("update");
        $query->setTable('polls');
        $query->addColumn("active");
        $query->addValue('0');
        $query->setWhere("");        
        $this->bd->run($query->buildQuery());
    }
    
    
    function activate_poll($poll_id) {
        $query = new SqlQueryBuilder("update");
        $query->setTable('polls');
        $query->addColumn("active");
        $query->addValue('1');
        $query->setWhere("poll_id = ".$poll_id); 
        $this->bd->run($query->buildQuery());
    }
    
    

}

?>