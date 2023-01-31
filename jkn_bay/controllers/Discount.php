<?php
namespace jkn_bay\controllers;

class Discount extends \jkn_bay\core\Controller{

	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Buyer]
	public function applyDiscount($profile_id){
		$discount = new \jkn_bay\models\Discount();
		$discount = $discount->get($profile_id);
		
		//Gets the cart for the buyer
 	 	$cart = new \jkn_bay\models\Order();
 	 	$cart = $cart->findProfileCart($_SESSION['profile_id']);

 	 	$order_detail = new \jkn_bay\models\Order_detail();
 	 	$order_detail = $order_detail->getForOrder($cart->order_id);


		if(isset($_POST['action'])){
			if($order_detail == null){
 	 			header('location:/Buyer/viewCart?error=Please add items to your cart');
 	 		}else{
 	 			if(password_verify($_POST['code'], $discount->code)  && $discount->status == 'created'){		
					//Applies the 20 percent discount to the cart
					$cart->total = ($cart->total) - ($cart->total * 0.2);
					$cart->update();
					$discount->status = 'applied';
					$discount->update();
					header('location:/Buyer/viewCart?message=Your discount code was applied');
				} else{
					header('location:/Buyer/viewCart?error=Your discount code has already been used');
				}
 	 		}
			
		}
	}
}