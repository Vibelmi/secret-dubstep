<?php

$bd = Db::getInstance();

if (isset($GLOBALS['CLEANED_POST']["subject"], $GLOBALS['CLEANED_POST']["description"])) {
    $subject = filter_var($GLOBALS['CLEANED_POST']["subject"], FILTER_SANITIZE_STRING);
    $description = filter_var($GLOBALS['CLEANED_POST']["description"], FILTER_SANITIZE_STRING);

    //The idprov saved in the session
    $idprov = $_SESSION['id'];

    $query2 = new SqlQueryBuilder("insert");
    $query2->setTable("prov_tickets");

    $query2->addColumn("idprov");
    $query2->addColumn("subject");
    $query2->addColumn("description");

    $query2->addValue($idprov);
    $query2->addValue($subject);
    $query2->addValue($description);

    $bd->run($query2->buildQuery());

    //SELECT THE ID FROM THE TICKET TO SEND THE EMAIL
    $query = new SqlQueryBuilder("select");
    $query->setTable("prov_tickets");

    $query->addColumn("idtp");
    $query->setWhere("idprov = '$idprov'");
    
    $query->setOrderBy("idtp DESC");
    
    $query->setLimit(1);

    $id = $bd->run($query->buildQuery())->fetch_assoc();
    $idtp = $id["idtp"];

    //SEND AN EMAIL
    $GLOBALS['mailer']->mailNewTicket("PROVIDER", $idtp);

    include("modules/create_tickets/view/success.php");
} else {
    include("modules/create_tickets/view/fail.php");
}
?>