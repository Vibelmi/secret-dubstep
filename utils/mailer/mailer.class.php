<?php
/*
* This object can be used to send mails to the users in our database
*/
class mailer{
	private $senderName;
	private $senderMail;
	private $senderPassword;
	function __construct(){
			$this->senderName = 'Greedy Monkey';
			$this->senderMail = "greedymonkeyweb@gmail.com";
			$this->senderPassword = "-32AX25am-";
	}
	function sendSingleMail($subjectMail, $contentMail, $receiverMail){
		$mail = new PHPMailer;
                $mail->IsSMTP(); 									// telling the class to use SMTP
                $mail->SMTPAuth   = true;                  			// enable SMTP authentication
                $mail->SMTPSecure = "tls";                 			// sets the prefix to the servier
                $mail->Host       = "smtp.gmail.com";      			// sets GMAIL as the SMTP server
                $mail->Port       = 587;                   			// set the SMTP port for the GMAIL server
                $mail->Username   = $this->senderMail;  			// GMAIL username
                $mail->Password   = $this->senderPassword;          // GMAIL password

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
	function sendMultiMail($subjectMail, $contentMail, $mails){
		while ($mail = mysqli_fetch_assoc($mails)){
			$this->sendSingleMail($subjectMail, $contentMail, $mail['email']);
		}
	}
	function loadMailView($mailType, $content){

		
		$view = $GLOBALS["smarty"]->fetch("views/templates/mailer/mailHeader.tpl");
		$GLOBALS["smarty"]->assign('Content',$content);
		$view .= $GLOBALS["smarty"]->fetch("views/templates/mailer/".$mailType.".tpl");
		$view .= $GLOBALS["smarty"]->fetch("views/templates/mailer/mailFooter.tpl");
		return $view;
	}
        function getMailDirection($receiverType,$receiverId){
            $bd = Db::getInstance();
            
            $query = new SqlQueryBuilder("select");
            
            if($receiverType == "USER"){
                $query->setTable("users");
                $query->addColumn("email");
                $query->setWhere("idu = " . "'" . $receiverId . "'");
                $query->setLimit(1);
            }else{
                $query->setTable("providers");
                $query->addColumn("email");
                $query->setWhere("idprov = " . "'" . $receiverId . "'");
                $query->setLimit(1);
            }
            
            $resp = $bd->run($query->buildQuery())->fetch_assoc();
            
            return $resp['email'];
        }
		function getAllMailDirections($receiverType){
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
	* This function is for: Sending spam when a new product is added.
	* $receiverType -> The type of the receiver. Can be "USER" or "PROVIDER".
	* $receiverId -> The Id of the receiver
	* $productId -> The Id of the new product.
	* 
	* IMPORTANT: You must send the mail AFTER the new product has been added.
	*/
	function mailNewProduct($productId){
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
}
