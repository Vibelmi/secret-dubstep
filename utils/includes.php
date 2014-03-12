<?php
/*
* Put your inputs here to make it visibles in all the application.
*/
include_once("utils/cleanInput.php");
include_once("utils/languages.php");
require_once("connection/Db.class.php");
require_once("connection/Conf.class.php");
include_once("libs/SqlQueryBuilder.class.php");
require('libs/Smarty/Smarty.class.php');
require_once('libs/PHPMailer/class.phpmailer.php');
include_once("utils/mailer/mailer.class.php");
include_once("utils/getRealIp.php");
include_once("classes/xmlReader.class.php");
include_once("classes/pageBuilder.class.php");
//include_once("classes/Product.class.php");
//require('.:/usr/share/php/Smarty/Smarty.class.php');
?>
