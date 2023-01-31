<?php
namespace jkn_bay\controllers;

class Message extends \jkn_bay\core\Controller{

	//Allows buyer to see all of his messages
	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Buyer]
	public function indexBuyerMes(){
		$message = new \jkn_bay\models\Message();

		$messages = $message->getMessagesBuyer($_SESSION['profile_id']);
		$discountM = $message->getForDiscount($_SESSION['profile_id']);
		
		$this->view('Message/indexBuyerMes', ['messages'=>$messages, 'discountM'=>$discountM]);
	}

	//Allows seller to see all of his messages
	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Seller]
	public function indexSellerMes(){
		$message = new \jkn_bay\models\Message();
		$messages = $message->getMessagesSeller($_SESSION['profile_id']);

		$this->view('Message/indexSellerMes', $messages);
	}

	//Allows buyers to contact sellers
	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Buyer]
 	public function contactSeller($profile_id, $product_id){
 		
 		if(isset($_POST['action'])){
 			$message = new \jkn_bay\models\Message();
			$message = $message->getProductMessage($_SESSION['profile_id'], $product_id);
			
 			if($message){
 				header('location:/Buyer/viewSeller/ '. $profile_id . '?error=You have already sent the seller a message about this product');
 			} else{
 			$message = new \jkn_bay\models\Message();
			$message->message = $_POST['enter_message'];
			$message->sender_id = $_SESSION['profile_id'];
			$message->receiver_id = $profile_id;
			$message->product_id = $product_id;
			$message->flag = 'none';
			$message->insert();

			header('location:/Buyer/viewSeller/ '. $profile_id . '?message=Your message was sent');
			}
 		}

		else{
				$profile = new \jkn_bay\models\Profile();
				$profile = $profile->getProfileId($profile_id);

			 	$product = new \jkn_bay\models\Product();
			 	$product = $product->get($product_id);

			 	$this->view('Buyer/contactSeller', ['product'=>$product, 'profile'=>$profile]);
		}
 	}

 	//Allows users to reply to one another
	#[\jkn_bay\filters\Login]
	public function reply($message_id){
		$old_message = new \jkn_bay\models\Message();
		$old_message = $old_message->get($message_id);
		
		if($_POST['message'] == ''){
	 		if($_SESSION['role'] == 'seller'){
				header('location:/Message/indexSellerMes/?error=Please enter a message');
			} else{
				header('location:/Message/indexBuyerMes/?error=Please enter a message');
			}
		} else{

			$message = new \jkn_bay\models\Message();
			$message->message = $_POST['message'];
			$message->reply_to = $message_id;
			$message->flag = 'none';
			$message->sender_id = $_SESSION['profile_id'];
			$message->product_id = $old_message->product_id;

			if($_SESSION['profile_id'] == $old_message->sender_id){
				$message->receiver_id = $old_message->receiver_id;
			} else{
				$message->receiver_id = $old_message->sender_id;
			}
			$message->insert();

			if($_SESSION['role'] == 'seller'){
				header('location:/Message/indexSellerMes/?message=Your message was sent');
			} else{
				header('location:/Message/indexBuyerMes/?message=Your message was sent');
			}
		}
	}
}