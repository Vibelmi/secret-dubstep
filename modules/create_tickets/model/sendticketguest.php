<?php

$bd = Db::getInstance();

session_start();


if (isset($GLOBALS['CLEANED_POST']["subject"], $GLOBALS['CLEANED_POST']["description"], $GLOBALS['CLEANED_POST']["email"])) {
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = substr( md5(microtime()), 1, 12);
            
    $query2 = new SqlQueryBuilder("insert");
    $query2->setTable("guest_tickets");

    $query2->addColumn("email");
    $query2->addColumn("subject");
    $query2->addColumn("description");
    $query2->addColumn("password");
    
    $query2->addValue("'$email'");
    $query2->addValue("'$subject'");
    $query2->addValue("'$description'");
    $query2->addValue("'$description'");
    
    $bd->run($query2->buildQuery());
    echo "TICKET DE GUEST INTRODUCIDO CORRECTAMENTE";
}else{
    echo "ERROR AL INTRODUCIR EL TICKET";
}
?>