<?php

$bd = Db::getInstance();

session_start();

//$_SESSION['email'] = "test@test.com";
$_SESSION['idu'] = 1;

if (isset($GLOBALS['CLEANED_POST']["subject"], $GLOBALS['CLEANED_POST']["description"])) {
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    
    //Select id from an email
    /*$email = strval($_SESSION['email']);

    $query = new SqlQueryBuilder("select");
    $query->setTable("users");

    $query->addColumn("idu");
    $query->setWhere("email = '$email'");

    $query->setLimit(1);

    $id = $bd->run($query->buildQuery())->fetch_assoc();
    $idu = $id["idu"];
    */
    
    $idu = $_SESSION['idu'];
    $query2 = new SqlQueryBuilder("insert");
    $query2->setTable("user_tickets");

    $query2->addColumn("idu");
    $query2->addColumn("subject");
    $query2->addColumn("description");

    $query2->addValue("$idu");
    $query2->addValue("'$subject'");
    $query2->addValue("'$description'");

    $bd->run($query2->buildQuery());
    echo "TICKET DE USUARIO INTRODUCIDO CORRECTAMENTE";
}else{
    echo "ERROR AL INTRODUCIR EL TICKET";
}
?>