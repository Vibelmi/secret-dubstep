<?php

class registryDAO {

    static $_instance;
    private $bll;
    private $data;
    private $name;
    private $surname;
    private $fiscalid;
    private $email;
    private $pass;
    private $pass_2;
    private $idu;
    private $response = array();
    private $cont;

    function __construct($cont_) {
        $this->cont = $cont_;
        include("modules/registry/model/registryBLL.php");
        $this->bll = registryBll::getInstance();
        $this->data = $GLOBALS['CLEANED_POST']["data"];
        $this->setVariables();
    }

    public static function getInstance($cont) {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self($cont);
        }
        return self::$_instance;
    }

    function setVariables() {
        $array = json_decode($this->data, TRUE);
        foreach ($array as $key => $value) {
            $this->$key = $value;
        }
    }

    function validateall() {
        //Validation Name
        $this->validateString("name");

        //Validation Surname
        $this->validateString("surname");

        //Validation FiscalID
        $this->validateString("fiscalid");

        //Validation email
        $this->validateEmail();

        //Validation pass1
        $this->validatePassword();

        //Validation pass2
        $this->validatePassword2();

        $this->database();

        echo json_encode($this->response);
    }

    function validateString($string) {
        $value = $this->$string;
        if (!empty($value)) {
            if (strlen($value) > 2) {
                $this->response[$string] = $value;
            }
        }
    }

    function validateEmail() {
        //Simple validation email
        if (!empty($this->email)) { //Email is empty
            //Filter to validate email
            if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) { //Email don't pass the validation
                $resp = $this->bll->select_users($this->email);
                if (empty($resp)) { //The email is not in the database
                    $this->response['email'] = $this->email;
                }
            }
        }
    }

    function validatePassword() {
        $passReg = '/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%? "]).*$/';
        if (!empty($this->pass)) { //Password not empty
            if (preg_match($passReg, $this->pass)) { //Password pass the validation
                $this->response['pass'] = $this->pass;
            }
        }
    }

    function validatePassword2() {
        if (!empty($this->pass)) {
            if (!empty($this->pass_2)) {
                if ($this->pass === $this->pass_2) {
                    $this->response['pass_2'] = $this->pass;
                }
            }
        }
    }

    function database() {
        $size = sizeof($this->response);
        if (array_key_exists("fiscalid", $this->response)) {
            $size--;
        }
        if ($size === 5) {
            $send = $this->response;
            $this->pass = $this->encryptPassword($this->pass);
            unset($send['pass']);
            unset($send['pass_2']);
            $this->bll->insert_user($send);
            $id = $this->bll->select_users($this->email);
            $this->idu = $id['id'];
            $this->bll->insert_passwords($this->idu, $this->pass);
            if ($this->bll->getType() === "0") { //send user email
                $number = substr(md5(microtime()), 1, 10);
                $this->bll->insert_test_number($this->idu, $number);
                $GLOBALS['mailer']->mailValidateAccount($this->idu,$number);
            } else { //send provider email
                //email to confirm the admin all data
            }
            $this->response['email'] = $this->cont->registryok;
        }
    }

    function encryptPassword($pass) {
        $key = '-32AX25am-';

        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);

        $encrypted = base64_encode($iv . mcrypt_encrypt(MCRYPT_RIJNDAEL_256, hash('sha256', $key, true), $pass, MCRYPT_MODE_CBC, $iv));

        return $encrypted;
    }

}

?>