<?php
/*
* This object can be used to send mails to the users in our database
*/
class mailer{

	function __construct(){
	
	}
	function sendSingleMail(){
	
	}
	function sendMultiMail(){
	
	}
	function loadMailView($mailType, $content){
		ob_start();
		/*
		$smarty = new Smarty;

		$smarty->assign('Content',$content);
		$smarty->display("utils/mailer/views/".$mailType.".php");
		*/
		$view = ob_get_contents();
		ob_end_clean();
		return $view;
	}
	/*
	* This function is for: Sending spam when a new product is added.
	* $receiverType -> The type of the receiver. Can be "USER" or "PROVIDER". By default is "USER"
	* $receiverId -> The Id of the receiver
	* $productId -> The Id of the new product.
	* 
	* IMPORTANT: You must send the mail AFTER the new product has been added.
	*/
	function mailNewProduct($receiverType = "USER",$receiverId,$productId){
		if(isset($receiverId) && isset($productId)){
			$productData = 
		
		
			if($receiverType == "USER"){
				$view = loadMailView("newProductUser",$productData);
				sendSingleMail($view,$mail);
			}else if ($receiverType == "PROVIDER"){
				$view = loadMailView("newProductProvider",$productData);
				sendSingleMail($view,$mail);
			}
		}else{
			return false;
		}
	}

}