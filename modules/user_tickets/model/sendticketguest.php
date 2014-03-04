<?php

$bd = Db::getInstance();

session_start();

$_SESSION['email'] = "guest@guest.com";

if (isset($GLOBALS['CLEANED_POST']["subject"], $GLOBALS['CLEANED_POST']["description"])) {
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $email = strval($_SESSION['email']);

    $query = new SqlQueryBuilder("select");
    $query->setTable("guests");

    $query->addColumn("idg");
    $query->setWhere("email = '$email'");

    $query->setLimit(1);

    $id = $bd->run($query->buildQuery())->fetch_assoc();
    $idg = $id["idg"];

    $query2 = new SqlQueryBuilder("insert");
    $query2->setTable("guest_tickets");

    $query2->addColumn("idg");
    $query2->addColumn("subject");
    $query2->addColumn("description");

    $query2->addValue("$idg");
    $query2->addValue("'$subject'");
    $query2->addValue("'$description'");

    $bd->run($query2->buildQuery());
    echo "TICKET DE GUEST INTRODUCIDO CORRECTAMENTE";
}else{
    echo "ERROR AL INTRODUCIR EL TICKET";
}
?>