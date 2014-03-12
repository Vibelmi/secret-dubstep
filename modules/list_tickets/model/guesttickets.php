<?php

$bd = Db::getInstance();

if (isset($GLOBALS['CLEANED_POST']["passwordt"], $GLOBALS['CLEANED_GET']["idtg"])) {

    $password = $GLOBALS['CLEANED_POST']["passwordt"];
    $idtg = $GLOBALS['CLEANED_GET']["idtg"];


    $query = new SqlQueryBuilder("select");
    $query->setTable("guest_tickets");
    //idtg, email, subject, description, password
    $query->addColumn("*");
    $query->setWhere("idtg = $idtg");

    $query->setLimit(1);

    $result = $bd->run($query->buildQuery())->fetch_assoc();

    if ($result["password"] === $password) {

        $query = new SqlQueryBuilder("select");
        $query->setTable("guest_response");
        //idrg, idtg, response
        $query->addColumn("*");
        $query->setWhere("idtg = $idtg");

        $result2 = $bd->run($query->buildQuery());
        
        $responses = array();
        
        while($i = $result2->fetch_assoc()){
            array_push($responses, $i);
        }

        include("modules/list_tickets/view/listmainguest.php");
    } else {
        echo "Incorrecto";
    }
}