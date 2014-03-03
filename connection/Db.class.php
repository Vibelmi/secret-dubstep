<?php

/* Class responsible for managing connections to the database */

class Db {

    private $server;
    private $user;
    private $password;
    private $database;
    private $link;
    private $stmt;
    private $array;
    static $_instance;

    /* The construct function is private to prevent the object to be created by new */

    private function __construct() {
        $this->setConnection();
        $this->connect();
    }

    /* Method for setting the parameters of the connection */

    private function setConnection() {
        $conf = Conf::getInstance();
        $this->server = $conf->getHostDB();
        $this->database = $conf->getDB();
        $this->user = $conf->getUserDB();
        $this->password = $conf->getPassDB();
    }

    /* We avoid cloning the object. Singleton pattern */

    private function __clone() {
        
    }

    /* Function responsible for creating, if necessary, the object. 
     * This is the function that must be called from outside the class to instantiate the object, and thus able to use their methods */

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    /* Connects to the database. */

    private function connect() {
        $this->link = new mysqli($this->server, $this->user, $this->password);
        mysqli_select_db($this->link, $this->database);
    }

    /* Method to execute a sql statement */

    public function run($sql) {
        $this->stmt = mysqli_query($this->link, $sql);
        return $this->stmt;
    }

    /* Method to get a result row of sql statement */

    public function get_row($stmt, $row) {
        if ($row == 0) {
            $this->array = mysqli_fetch_array($stmt);
        } else {
            mysqli_data_seek($stmt, $row);
            $this->array = mysqli_fetch_array($stmt);
        }
        return $this->array;
    }

    //Returns the last insert id introduced
    public function lastID() {
        return mysqli_insert_id($this->link);
    }

}

?>
