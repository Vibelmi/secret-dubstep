<?php

$bd = Db::getInstance();

if ((isset($GLOBALS['CLEANED_GET']["idtg"], $GLOBALS['CLEANED_POST']["passwordt"])) || (isset($GLOBALS['CLEANED_GET']["idtg"], $_SESSION["response_password"]))) {

    if (isset($GLOBALS['CLEANED_POST']["passwordt"])) {
        $password = $GLOBALS['CLEANED_POST']["passwordt"];
    }else{
        $password = $_SESSION["response_password"];
    }
    $idtg = $GLOBALS['CLEANED_GET']["idtg"];

    $query = new SqlQueryBuilder("select");
    $query->setTable("guest_tickets");
    //idrg, idtg, response
    $query->addColumn("*");
    $query->setWhere("idtg = $idtg OR reference = '$idtg'");
    $query->setOrderBy("date ASC");

    $result2 = $bd->run($query->buildQuery());

    $responses = array();

    while ($i = $result2->fetch_assoc()) {
        array_push($responses, $i);
    }
    //VALORES PARA USAR CUANDO VAYAMOS A GUARDAR LA RESPUESTA
    $_SESSION['response_email'] = $responses[0]["email"];
    $_SESSION['response_subject'] = $responses[0]["subject"];
    $_SESSION['response_idtg'] = $responses[0]["idtg"];
    $_SESSION['response_password'] = $responses[0]["password"];

    if ($responses[0]["password"] === $password) {

        $query = new SqlQueryBuilder("select");
        $query->setTable("guest_response");
        //idrg, idtg, response
        $query->addColumn("*");
        $query->setWhere("idtg = $idtg");

        $result2 = $bd->run($query->buildQuery());

        while ($i = $result2->fetch_assoc()) {
            array_push($responses, $i);
        }

        $responses = orderMultiDimensionalArray($responses, "date");

        include("modules/list_tickets/view/listmainguest.php");
    } else {
        echo "Incorrecto";
    }
}