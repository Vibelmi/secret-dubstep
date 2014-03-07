<?php

class validateDAO {

    static $_instance;
    private $bll;
    private $email;
    private $pass;
    private $error;
    private $idu;
    private $status;

    function __construct() {
        include("modules/login/model/loginBLL.php");
        $this->bll = loginBll::getInstance();
        $this->email = $GLOBALS['CLEANED_POST']["email"];
        $this->pass = $GLOBALS['CLEANED_POST']["pass"];
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function validate($type) {
        $this->bll->type($type);

        //Simple validation email
        $this->simple_email_validation();

        if ($this->error === 2) { //Simple validation password
            $this->simple_password_validation();
        }

        $this->isAdmin();

        if ($this->error === 2) { //Check the email in the database
            $resp = $this->bll->select_users($this->email);
            if (empty($resp)) { //The email is not in the database
                $this->error = 0;
            } else { //The email is in the database
                $this->idu = $resp['id'];
                $this->status = $resp['status'];
                $this->check_email_database();
            }
        }

        if ($this->error === 2) { //Check password in Database
            $resp = $this->bll->select_passwords($this->idu, $this->pass);
            if (empty($resp)) { //Password no matches
                $this->check_password_database();
            } else { //The password is the that is in the database, delete last attemts if it have
                $this->bll->delete_attemps($this->idu);
                $this->error = 2;
                $this->all_correct();
            }
        }
        echo $this->error;
    }

    function simple_email_validation() {
        if (empty($this->email)) { //Email is empty
            $this->error = 0;
        } else { //Email isn't empty
            //Filter to validate email
            if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) { //Email don't pass the validation
                $this->error = 0;
            } else { //Email pass the validation
                $this->error = 2;
            }
        }
    }

    function simple_password_validation() {
        $passReg = '/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%? "]).*$/';
        if (empty($this->pass)) { //Password empty
            $this->error = 1;
        } else { //Password isn't empty'
            if (!preg_match($passReg, $this->pass)) { //Password don't pass the validation'
                $this->error = 1;
            } else { // Password pass the validation
                $this->error = 2;
            }
        }
    }

    function isAdmin() {
        include("modules/login/model/adminLogin.inc.php");
        if ($this->email === $emailAdmin && $this->pass === $password) {
            $_SESSION['token'] = 10;
            $_SESSION['email'] = $this->email;
            $this->error = 4;
        }
    }

    function check_email_database() {
        if ($this->status) { //The user isn't banned
            $this->error = 2;
        } else { //Check when the user was banned
            $resp1 = $this->bll->select_attempts($this->idu);
            $time = 0;
            for ($i = 0; $i < sizeof($resp1); $i++) {//Take the most recent time
                if ($resp1[$i]['time'] > $time) {
                    $time = $resp1[$i]['time'];
                }
            }
            if ((time() - $time) < 1800) { //Check the time that passed from the user was banned
                $this->error = 3;
            } else {
                $this->error = 2;
                $this->bll->update_status(1, $this->idu);
                $this->bll->delete_attemps($this->idu);
            }
        }
    }

    function check_password_database() {
        $this->error = 1;
        $resp1 = $this->bll->select_attempts($this->idu);

        if (empty($resp1) || sizeof($resp1) < 2) { //Less than 2 attempts
            $this->error = 1;
            $this->bll->insert_attempt($this->idu);
        } else { //More than 2 attempts
            $this->error = 1;
            $time = 0;
            for ($i = 0; $i < sizeof($resp1); $i++) { //Take the most recent time
                if ($resp1[$i]['time'] > $time) {
                    $time = $resp1[$i]['time'];
                }
            }
            $this->bll->insert_attempt($this->idu);

            if ((time() - $time) < 1800) { //3 attempts in minus than 30 minuts BANNED
                $this->error = 3;
                //User banned
                $this->bll->update_status(0, $this->idu);
            } else {
                $this->error = 1;
                $this->bll->delete_attemps($this->idu);
            }
        }
    }

    function all_correct() {
        $_SESSION['token'] = $this->bll->getType();
        $_SESSION['email'] = $this->email;
        $_SESSION['id'] = $this->idu;
    }

}

?>