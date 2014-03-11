<?php

class registryBll {

    static $_instance;
    private $bd;
    private $table;
    private $table_passwords;
    private $id;
    private $type;

    function __construct() {
        $this->bd = Db::getInstance();
        $this->type = $GLOBALS['CLEANED_POST']["token"];
        $this->settype();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getType() {
        return $this->type;
    }

    function settype() {
        if ($this->type === "0") { //user
            $this->table = "users";
            $this->table_passwords = "user_passwords";
            $this->id = "idu";
        } else { //provider
            $this->table = "providers";
            $this->table_passwords = "prov_passwords";
            $this->id = "idprov";
        }
    }

    function select_users($email_) {
        $query = new SqlQueryBuilder("select");
        $query->setTable($this->table);

        $query->addColumn($this->id);

        $query->setWhere("email = " . "'" . $email_ . "'");
        $query->setLimit(1);

        $resp = $this->bd->run($query->buildQuery())->fetch_assoc();

        if (!empty($resp)) {
            $resp1['id'] = $resp[$this->id];
        } else {
            $resp1 = $resp;
        }

        return $resp1;
    }

    function insert_passwords($idu_, $pass_) {
        $query = new SqlQueryBuilder("insert");
        $query->setTable($this->table_passwords);

        $query->addColumn($this->id);
        $query->addColumn("password");

        $query->addValue($idu_);
        $query->addValue($pass_);

        $this->bd->run($query->buildQuery());
    }

    function insert_user($response) { //Query to insert users or providers
        $query = new SqlQueryBuilder("insert");
        $query->setTable($this->table);

        foreach ($response as $key => $value) {
            $query->addColumn($key);
            $query->addValue($value);
        }
        $query->addColumn('status');
        $query->addValue(0);

        $this->bd->run($query->buildQuery());
    }

    function insert_test_number($idu_, $number_) { //Query to insert test numbers to email confirmation
        $query = new SqlQueryBuilder("insert");
        $query->setTable('test_numbers');

        $query->addColumn('id');
        $query->addValue($idu_);
        $query->addColumn('number');
        $query->addValue($number_);

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
