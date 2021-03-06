<?php

class loginBll {

    static $_instance;
    private $bd;
    private $table;
    private $table_passwords;
    private $table_login_attempts;
    private $id;
    private $type;

    function __construct() {
        $this->bd = Db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function getType() {
        return $this->type;
    }

    function type($type) {
        $this->type=$type;
        if ($type === "0") { //user
            $this->table = "users";
            $this->table_passwords = "user_passwords";
            $this->table_login_attempts = "user_login_attempts";
            $this->id = "idu";
        } else { //provider
            $this->table = "providers";
            $this->table_passwords = "prov_passwords";
            $this->table_login_attempts = "prov_login_attempts";
            $this->id = "idprov";
        }
    }

    function select_attempts($idu_) { //Query to get all attemps
        $query = new SqlQueryBuilder("select");
        $query->setTable($this->table_login_attempts);

        $query->addColumn($this->id);
        $query->addColumn("time");

        $query->setWhere($this->id . " = " . "'" . $idu_ . "'");

        $resp = $this->bd->run($query->buildQuery());

        $resp1 = array();

        while ($i = $resp->fetch_assoc()) {
            array_push($resp1, $i);
        }
        return $resp1;
    }

    function select_users($email_) {
        $query = new SqlQueryBuilder("select");
        $query->setTable($this->table);

        $query->addColumn($this->id);
        $query->addColumn("name");
        $query->addColumn("status");

        $query->setWhere("email = " . "'" . $email_ . "'");
        $query->setLimit(1);

        $resp = $this->bd->run($query->buildQuery())->fetch_assoc();

        if (!empty($resp)) {
            $resp1['id'] = $resp[$this->id];
            $resp1['name'] = $resp['name'];
            $resp1['status'] = $resp['status'];
        } else {
            $resp1 = $resp;
        }

        return $resp1;
    }

    function select_passwords($idu_) {
        $query = new SqlQueryBuilder("select");
        $query->setTable($this->table_passwords);
        $query->addColumn($this->id);
        $query->addColumn("password");
        $query->setWhere($this->id . " = " . "'" . $idu_ . "'");
        $query->setLimit(1);

        $resp = $this->bd->run($query->buildQuery())->fetch_assoc();

        return $resp;
    }
    
    function select_test_numbers($idu_) {
        $query = new SqlQueryBuilder("select");
        $query->setTable('test_numbers');
        $query->addColumn('id');
       
        $query->setWhere("id = " . "'" . $idu_ . "'");
        $query->setLimit(1);

        $resp = $this->bd->run($query->buildQuery())->fetch_assoc();

        return $resp;
    }

    function update_status($status, $idu_) { // Change status BANNED or NOT BANNED
        $query = new SqlQueryBuilder("update");
        $query->setTable($this->table);

        $query->addColumn("status");
        $query->addValue($status);

        $query->setWhere($this->id . " = " . "'" . $idu_ . "'");

        $this->bd->run($query->buildQuery());
    }

    function update_password($idu_, $pass_) { // Change password
        $query = new SqlQueryBuilder("update");
        $query->setTable($this->table_passwords);

        $query->addColumn("password");
        $query->addValue($pass_);

        $query->setWhere($this->id . " = " . "'" . $idu_ . "'");

        $this->bd->run($query->buildQuery());
    }

    function insert_attempt($idu_) { //Query to insert attemps
        $query = new SqlQueryBuilder("insert");
        $query->setTable($this->table_login_attempts);

        $query->addColumn($this->id);
        $query->addColumn("time");

        $query->addValue($idu_);
        $query->addValue(time());

        $this->bd->run($query->buildQuery());
    }

    function delete_attemps($idu_) { //Query to delete attemps
        $query = new SqlQueryBuilder("delete");
        $query->setTable($this->table_login_attempts);
        $query->setWhere($this->id . " = " . "'" . $idu_ . "'");

        $this->bd->run($query->buildQuery());
    }

}

?>
