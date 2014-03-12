<?php

class confirmUserlDAO {

    static $_instance;
    private $bll;
    private $id;
    private $number;

    function __construct() {
        include("modules/registry/model/registryBLL.php");
        $this->bll = registryBll::getInstance();
        $this->id = $GLOBALS['CLEANED_GET']["id"];
        $this->number = $GLOBALS['CLEANED_GET']["number"];
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    //example link: http://localhost/NetBeans_Projects/Final_project/index.php?page=registry&id=25&number=20edab2cbb
    function checkValidation() {
        $resp = $this->bll->select_test_numbers($this->id, $this->number);
        if (!empty($resp)) {
            $resp = $this->bll->select_users_id($this->id);
            $this->bll->delete_test_numbers($this->id);
            $_SESSION['token'] = 0;
            $_SESSION['email'] = $resp['email'];
            $_SESSION['id'] = $this->id;
            $_SESSION['name'] = $resp['name'];
        }
        header('Location: index.php');
    }

}

?>
