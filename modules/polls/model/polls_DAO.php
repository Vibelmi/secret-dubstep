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
        $polls_titles = $this->bd->run($query->buildQuery());

        return $polls_titles;
    }
    /////
    function select_options_from_polls() {
        $query = new SqlQueryBuilder("select");
        $query->setTable('polls_options');
        $query->addColumn('*');
        $query->setWhere("");
        $polls_titles = $this->bd->run($query->buildQuery());

        return $polls_titles;
    }    

}

?>