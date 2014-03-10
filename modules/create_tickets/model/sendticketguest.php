<?php

$bd = Db::getInstance();

if (isset($GLOBALS['CLEANED_POST']["subject"], $GLOBALS['CLEANED_POST']["description"], $GLOBALS['CLEANED_POST']["temail"])) {
    $subject = filter_var($GLOBALS['CLEANED_POST']["subject"], FILTER_SANITIZE_STRING);
    $description = filter_var($GLOBALS['CLEANED_POST']["description"], FILTER_SANITIZE_STRING);
    $email = filter_var($GLOBALS['CLEANED_POST']["temail"], FILTER_SANITIZE_STRING);

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
    include("modules/create_tickets/view/success.php"); 
}else{
    include("modules/create_tickets/view/fail.php"); 
}
?>