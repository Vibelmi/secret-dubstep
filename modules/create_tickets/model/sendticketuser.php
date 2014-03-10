<?php

$bd = Db::getInstance();

if (isset($GLOBALS['CLEANED_POST']["subject"], $GLOBALS['CLEANED_POST']["description"])) {
    $subject = filter_var($GLOBALS['CLEANED_POST']["subject"], FILTER_SANITIZE_STRING);
    $description = filter_var($GLOBALS['CLEANED_POST']["description"], FILTER_SANITIZE_STRING);
    
    $idu = $_SESSION['id'];
    $query2 = new SqlQueryBuilder("insert");
    $query2->setTable("user_tickets");

    $query2->addColumn("idu");
    $query2->addColumn("subject");
    $query2->addColumn("description");

    $query2->addValue("$idu");
    $query2->addValue("'$subject'");
    $query2->addValue("'$description'");

    $bd->run($query2->buildQuery());
    include("modules/create_tickets/view/success.php");
}else{
    include("modules/create_tickets/view/fail.php"); 
}
?>