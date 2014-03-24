<?php

$bd = Db::getInstance();

if ((isset($GLOBALS['CLEANED_POST']["subject"], $GLOBALS['CLEANED_POST']["description"], $GLOBALS['CLEANED_POST']["temail"])) || isset($_SESSION['response_email'], $_SESSION['response_subject'], $_SESSION['response_idtg'])) {
    if (isset($GLOBALS['CLEANED_POST']["temail"])) {
        $email = filter_var($GLOBALS['CLEANED_POST']["temail"], FILTER_SANITIZE_STRING);
        $subject = filter_var($GLOBALS['CLEANED_POST']["subject"], FILTER_SANITIZE_STRING);
        $idtg = null;
        $password = substr(md5(microtime()), 1, 12);
    } else {
        $email = $_SESSION['response_email'];
        $subject = $_SESSION['response_subject'];
        $idtg = $_SESSION['response_idtg'];
        $password = $_SESSION['response_password'];
    }
    $date = date("Y-m-d H:i:s");
    $description = filter_var($GLOBALS['CLEANED_POST']["description"], FILTER_SANITIZE_STRING);

    $query2 = new SqlQueryBuilder("insert");
    $query2->setTable("guest_tickets");

    $query2->addColumn("email");
    $query2->addColumn("subject");
    $query2->addColumn("description");
    $query2->addColumn("password");
    $query2->addColumn("reference");
    $query2->addColumn("date");

    $query2->addValue($email);
    $query2->addValue($subject);
    $query2->addValue($description);
    $query2->addValue($password);
    $query2->addValue($idtg);
    $query2->addValue($date);

    $bd->run($query2->buildQuery());

    //SELECT THE ID FROM THE TICKET TO SEND THE EMAIL
    if (!isset($_SESSION['response_idtg'])) {
        $query = new SqlQueryBuilder("select");
        $query->setTable("guest_tickets");

        $query->addColumn("idtg");
        $query->setWhere("email = '$email'" . " AND " . "password = '$password'");

        $query->setLimit(1);
        $id = $bd->run($query->buildQuery())->fetch_assoc();
        $idtg = $id["idtg"];
        include("modules/create_tickets/view/success.php");
    } else {
        include("modules/list_tickets/model/guesttickets.php");
        unset($_SESSION['response_email']);
        unset($_SESSION['response_subject']);
        unset($_SESSION['response_idtg']);
        unset($_SESSION['response_password']);
        
    }
    //SEND AN EMAIL
    //$GLOBALS['mailer']->mailNewTicket("GUEST", $idtg);

    
} else {
    include("modules/create_tickets/view/fail.php");
}
?>