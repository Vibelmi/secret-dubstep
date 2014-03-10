<?php
/*
* This object can be used to send mails to the users in our database
*/
class mailer{
	private $senderName; //Name that will appear in the sended messages
	private $senderMail; //Email address from which we gonna send the messages
	private $senderPassword;    //Password of the above email account
	function __construct(){
			$this->senderName = 'Greedy Monkey';
			$this->senderMail = "greedymonkeysend@gmail.com";
			$this->senderPassword = "-32AX25am-";
	}
        /*
	* This function is for: Sending sending a mail message to a single email direction
	* $subjectMail -> The subject of the sended email
	* $contentMail -> The content of the sended email. Can be html.
	* $receiverMail -> The destination address of the message.
	*/
	public function sendSingleMail($subjectMail, $contentMail, $receiverMail){
		$mail = new PHPMailer;
                $mail->IsSMTP(); 						// telling the class to use SMTP
                $mail->SMTPAuth   = true;                  			// enable SMTP authentication
                $mail->SMTPSecure = "tls";                 			// sets the prefix to the servier
                $mail->Host       = "smtp.gmail.com";      			// sets GMAIL as the SMTP server
                $mail->Port       = 587;                   			// set the SMTP port for the GMAIL server
                $mail->Username   = $this->senderMail;  			// GMAIL username
                $mail->Password   = $this->senderPassword;                      // GMAIL password

		$mail->From = $this->senderMail;
		$mail->FromName = $this->senderName;
		$mail->addAddress($receiverMail);

		$mail->isHTML(true);

		$mail->Subject = $subjectMail;
		$mail->Body = $contentMail;

		if(!$mail->send()) {
			return false;
		}else{
			return true;
		}
	}
        /*
	* This function is for: Sending the same message to multiple address
	* $subjectMail -> The subject of the sended email
	* $contentMail -> The content of the sended email. Can be html.
	* $mails -> An array with all the destinations address of the message.
	*/
	public function sendMultiMail($subjectMail, $contentMail, $mails){
		while ($mail = mysqli_fetch_assoc($mails)){
			$this->sendSingleMail($subjectMail, $contentMail, $mail['email']);
		}
	}
        /*
	* This function is for: Load predefined content for the mail. Use Smarty to load this predefined contents.
	* $mailType -> The name of the template we want to load
	* $content -> An array with all the dynamic parameters we want to load in the template.
	*/
	private function loadMailView($mailType, $content){
		$view = $GLOBALS["smarty"]->fetch("views/templates/mailer/mailHeader.tpl");
		$GLOBALS["smarty"]->assign('Content',$content);
		$view .= $GLOBALS["smarty"]->fetch("views/templates/mailer/".$mailType.".tpl");
		$view .= $GLOBALS["smarty"]->fetch("views/templates/mailer/mailFooter.tpl");
		return $view;
	}
        /*
	* This function is for: Load the email address from  database with the gived id of the receiver.
	* $receiverType -> The type of the receiver. Can be "USER", "PROVIDER" or "GUEST".
	* $receiverId -> The id of the receiver
	*/
        private function getMailDirection($receiverType,$receiverId){
            $bd = Db::getInstance();
            
            $query = new SqlQueryBuilder("select");
            
            if($receiverType == "USER"){
                $query->setTable("users");
                $query->addColumn("email");
                $query->setWhere("idu = " . "'" . $receiverId . "'");
                $query->setLimit(1);
            }else if($receiverType == "PROVIDER"){
                $query->setTable("providers");
                $query->addColumn("email");
                $query->setWhere("idprov = " . "'" . $receiverId . "'");
                $query->setLimit(1);
            }else{
                $query->setTable("guests");
                $query->addColumn("email");
                $query->setWhere("idg = " . "'" . $receiverId . "'");
                $query->setLimit(1);
            }
            
            $resp = $bd->run($query->buildQuery())->fetch_assoc();
            
            return $resp['email'];
        }
        /*
	* This function is for: Load all the email address of a particular user type from the database
	* $receiverType -> The type of the receiver. Can be "USER", "PROVIDER" or "GUEST".
	*/
	private function getAllMailDirections($receiverType){
			$bd = Db::getInstance();
            
            $query = new SqlQueryBuilder("select");
            if($receiverType == "USER"){
                $query->setTable("users");
                $query->addColumn("email");
            }else{
                $query->setTable("providers");
                $query->addColumn("email");
            }
            
            $mails = $bd->run($query->buildQuery());
            return $mails;
	}
        /*
	* This function is for: Load all the information of the ticket based on the ticket id and the receiver type
	* $receiverType -> The type of the receiver. Can be "USER", "PROVIDER" or "GUEST".
	*/
        private function getTicketsInfo($receiverType,$ticketId){
	    $bd = Db::getInstance();
            $query = new SqlQueryBuilder("select");
            
            if($receiverType == "USER"){
                $query->setTable("user_tickets");
                $query->addColumn("*");
                $query->setWhere("idtu = ".$ticketId);
                $ticketInfo = $bd->run($query->buildQuery())->fetch_assoc();
                
            }else if($receiverType == "PROVIDER"){
                $query->setTable("prov_tickets");
                $query->addColumn("*");
                $query->setWhere("idtp = ".$ticketId);
                $ticketInfo = $bd->run($query->buildQuery())->fetch_assoc();
            }else{
                $query->setTable("guest_tickets");
                $query->addColumn("*");
                $query->setWhere("idtg = ".$ticketId);
                $ticketInfo = $bd->run($query->buildQuery())->fetch_assoc();
            }
            
            return $ticketInfo;
	}
	/*
	* This function is for: Sending spam when a new product is added.
	* $receiverType -> The type of the receiver. Can be "USER", "PROVIDER" or "GUEST".
	* $receiverId -> The Id of the receiver
	* $productId -> The Id of the new product.
	* 
	* IMPORTANT: You must send the mail AFTER the new product has been added.
	*/
	public function mailNewProduct($productId){
		$product = new Product($productId);
		$product->_get_DB_data($productId);
		$product->_charge_descriptions();

		$content = array("name" => $product->_name,
					"img" => $product->_image_path,
					"description" => $product->_select_description_by_lang("en"),
					"id" => $productId);

		$userMails = $this->getAllMailDirections("USER");
		$providerMails = $this->getAllMailDirections("PROVIDER");
		$this->sendMultiMail("A wild product appears!",$this->loadMailView("userNewProduct", $content),$userMails);
		$this->sendMultiMail("We are selling a new product.",$this->loadMailView("providerNewProduct", $content),$providerMails);
	}
        /*
	* This function is for: Sending a confirmation message when a new tickets is sended.
	* $receiverType -> The type of the receiver. Can be "USER", "PROVIDER" or "GUEST".
	* $receiverId -> The Id of the receiver
	* $productId -> The Id of the new ticket.
	* 
	* IMPORTANT: You must send the mail AFTER the new ticked has been added.
	*/
        public function mailNewTicket($receiverType,$ticketId){
            $ticketInfo = $this->getTicketsInfo($receiverType,$ticketId);
            if($receiverType == "USER"){
                $mail = $this->getMailDirection($receiverType,$ticketInfo["idu"]);
                $contentMail = $this->loadMailView("mailNewTicketUser", $ticketInfo);
            }else if($receiverType == "PROVIDER"){
                $mail = $this->getMailDirection($receiverType,$ticketInfo["idprov"]);
                $contentMail = $this->loadMailView("mailNewTicketProvider", $ticketInfo);
            }else{
                $mail = $ticketInfo["email"];
                $contentMail = $this->loadMailView("mailNewTicketGuest", $ticketInfo);
            }
            
            $this->sendSingleMail("Your ticket has been sended!", $contentMail, $mail);
        }
}
