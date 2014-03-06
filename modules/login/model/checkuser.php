<?php

$email = $GLOBALS['CLEANED_POST']["email"];
$pass = $GLOBALS['CLEANED_POST']["pass"];
$passReg = '/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%? "]).*$/';
$error = 0;

if (empty($email)) {
    $error = 0;
} else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 0;
    } else {
        $error = 2;
    }
}

if ($error === 2) {
    if (empty($pass)) {
        $error = 1;
    } else {
        if (!preg_match($passReg, $pass)) {
            $error = 1;
        } else {
            $error = 2;
        }
    }
}

if ($error === 2) {

    $bd = Db::getInstance();

    $query = new SqlQueryBuilder("select");
    $query->setTable("users");
    $query->addColumn("idu");
    $query->addColumn("status");
    $query->setWhere("email = " . "'" . $email . "'");
    $query->setLimit(1);

    $resp = $bd->run($query->buildQuery())->fetch_assoc();

    $idu = $resp['idu'];
    $status = $resp['status']; ///si pasa de mija hora desbanejar al usuari (falta fer)

    if (empty($resp)) { //No matches
        $error = 0;
    } else {
        if ($status) { //The user isn't banned
            $error = 2;
        } else { //The user is banned?
            $query = new SqlQueryBuilder("select");
            $query->setTable("user_login_attempts");
            $query->addColumn("idu");
            $query->addColumn("time");
            $query->setWhere("idu = " . "'" . $idu . "'");

            $resp = $bd->run($query->buildQuery());

            $resp1 = array();

            while ($i = $resp->fetch_assoc()) {
                array_push($resp1, $i);
            }
            $time = 0;
            for ($i = 0; $i < sizeof($resp1); $i++) {
                if ($resp1[$i]['time'] > $time) {
                    $time = $resp1[$i]['time'];
                }
            }
            if ((time() - $time) < 1800) {
                $error = 3;
            } else {
                $error = 2;

                $query = new SqlQueryBuilder("update");
                $query->setTable("users");
                $query->addColumn("status");
                $query->addValue(1);
                $query->setWhere("idu = " . "'" . $idu . "'");

                $bd->run($query->buildQuery());

                $query = new SqlQueryBuilder("delete");
                $query->setTable("user_login_attempts");
                $query->setWhere("idu = " . "'" . $idu . "'");

                $bd->run($query->buildQuery());
            }
        }
    }
}

if ($error === 2) {
    $query = new SqlQueryBuilder("select");
    $query->setTable("user_passwords");
    $query->addColumn("idu");
    $query->addColumn("password");
    $query->setWhere("idu = " . "'" . $idu . "'" . " AND " . "password = " . "'" . $pass . "'");
    $query->setLimit(1);

    $resp = $bd->run($query->buildQuery())->fetch_assoc();

    if (empty($resp)) { //Password no matches
        $error = 1;

        $query = new SqlQueryBuilder("select");
        $query->setTable("user_login_attempts");
        $query->addColumn("idu");
        $query->addColumn("time");
        $query->setWhere("idu = " . "'" . $idu . "'");

        $resp = $bd->run($query->buildQuery());

        $resp1 = array();

        while ($i = $resp->fetch_assoc()) {
            array_push($resp1, $i);
        }

        if (empty($resp1) || sizeof($resp1) < 2) { //Less than 2 attempts
            $error = 1;

            $query = new SqlQueryBuilder("insert");
            $query->setTable("user_login_attempts");

            $query->addColumn("idu");
            $query->addColumn("time");

            $query->addValue($idu);
            $query->addValue(time());

            $bd->run($query->buildQuery());
        } else { //More than 2 attempts
            $error = 1;
            $time = 0;
            for ($i = 0; $i < sizeof($resp1); $i++) {
                if ($resp1[$i]['time'] > $time) {
                    $time = $resp1[$i]['time'];
                }
            }

            $query = new SqlQueryBuilder("insert");
            $query->setTable("user_login_attempts");

            $query->addColumn("idu");
            $query->addColumn("time");

            $query->addValue($idu);
            $query->addValue(time());

            $bd->run($query->buildQuery());

            if ((time() - $time) < 18) { //3 attempts in minus than 30 minuts BANNED
                $error = 3;

                //User banned
                $query = new SqlQueryBuilder("update");
                $query->setTable("users");
                $query->addColumn("status");
                $query->addValue(0);
                $query->setWhere("idu = " . "'" . $idu . "'");

                $bd->run($query->buildQuery());
            } else {
                $error = 1;
                
                $query = new SqlQueryBuilder("delete");
                $query->setTable("user_login_attempts");
                $query->setWhere("idu = " . "'" . $idu . "'");

                $bd->run($query->buildQuery());
            }
        }
    } else {
        $error = 2;
    }
}
echo $error;

//funcio delete i contemplar tots es casos (falta fer)
?>
