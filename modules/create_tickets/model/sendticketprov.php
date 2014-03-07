<?php

$bd = Db::getInstance();

if (isset($GLOBALS['CLEANED_POST']["subject"], $GLOBALS['CLEANED_POST']["description"])) {
    $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    
    //The idprov saved in the session
    $idprov = $_SESSION['idprov'];
    
    $query2 = new SqlQueryBuilder("insert");
    $query2->setTable("prov_tickets");

    $query2->addColumn("idprov");
    $query2->addColumn("subject");
    $query2->addColumn("description");

    $query2->addValue("$idprov");
    $query2->addValue("'$subject'");
    $query2->addValue("'$description'");

    $bd->run($query2->buildQuery());
    include("modules/create_tickets/view/success.php"); 
}else{
    include("modules/create_tickets/view/main.php"); 
}
?>