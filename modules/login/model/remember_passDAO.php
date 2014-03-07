<?php

class rememberDAO {

    static $_instance;
    private $bll;
    private $email;
    private $error;
    private $idu;
    private $cont;

    function __construct($cont_) {
        $this->cont=$cont_;
        include("modules/login/model/loginBLL.php");
        $this->bll = loginBll::getInstance();
        $this->email = $GLOBALS['CLEANED_POST']["email"];
    }

    public static function getInstance($cont) {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self($cont);
        }
        return self::$_instance;
    }

    function validateEmail($type) {
        $this->bll->type($type);

        //Simple validation email
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

        if ($this->error === 2) { //Check the email in the database
            $resp = $this->bll->select_users($this->email);
            if (empty($resp)) { //The email is not in the database
                $this->error = 0;
            } else { //The email is in the database
                $this->idu = $resp['id'];
                $this->error = 2;
            }
        }

        if ($this->error === 2) {
            $this->changePass();
        }
       echo $this->error;
    }

    function changePass() {
        $pass_ = ""; // generate password
        //$this->bll->update_password($this->idu, $pass_);
        //send password
        //include 'modules/login/controller/index.php';
        $this->error = $this->cont->changepass;
    }

}

?>
