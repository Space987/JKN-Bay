<?php
namespace jkn_bay\controllers;

class Buyer extends \jkn_bay\core\Controller{

	//Creates the buyer page with the catalog
	#[\jkn_bay\filters\Buyer]
 	public function index(){

 		//Gets all of the products for the catlog
	 	$product = new \jkn_bay\models\Product();
	 	$products = $product->getAll();
	 	
	 	//Gets all of the categorys for the catalog
	 	$category = new \jkn_bay\models\Category();
	 	$categorys = $category->getAll();

	 	$this->view('Buyer/index', ['product'=>$products, 'categorys'=>$categorys]);
 	}

 	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Buyer]
	//Allows buyers to add products to their cart
	public function addToCart($product_id){
 	 	
 	 	//Gets the cart for the buyer
 	 	$cart = new \jkn_bay\models\Order();
 	 	$cart = $cart->findProfileCart($_SESSION['profile_id']);

 	 	//Gets the product that the buyer wants to add
 	 	$product = new \jkn_bay\models\Product();
 	 	$product = $product->get($product_id);

 	 	//Checks if their is a cart created for the buyer and if not then creates it
 	 	if ($cart == null) {
 	 		$cart = new \jkn_bay\models\Order();
	 	 	$cart->profile_id = $_SESSION['profile_id'];
	 	 	$cart->status = 'cart';
 			$cart->total = 0;
	 	 	$cart->order_id = $cart->insert();
 	 	}

 	 	$product_order_detail = new \jkn_bay\models\Order_detail();
 	 	$product_order_detail = $product_order_detail->getProductForOrder($product->product_id);

 	 	//Checks if the product is already in the cart, and if the quantity is to much to add
 	 	if($product_order_detail != null){
 	 		if($product_order_detail->qty >= $product->quantity){
 	 			header('location:/Buyer/index?error=Maximum quantity reached');	
 	 		} else{
 	 			$new_product = $this->newOrderDetail($cart->order_id, $product->price, $product->product_id);

		 		header('location:/Buyer/index?message=The product was added to your cart');
 	 		}
 	 	}else{
	 		//Creates the order detail for the buyer
	 		$new_product = $this->newOrderDetail($cart->order_id, $product->price, $product->product_id);
	 		header('location:/Buyer/index?message=The product was added to your cart');
	 	}

	 	$discount = new \jkn_bay\models\Discount();
 	 	$discount = $discount->get($_SESSION['profile_id']);

	 	if($discount->status == 'applied' || $discount == null){
	 		$original_total = ($cart->total) + ($cart->total * 0.25);
 	 		$cart->total = $total + $newProduct->price;
 	 		$cart->update();
 	 		$discount->status = 'created';
 	 		$discount->update();
	 		header('location:/Buyer/index?message=The product was added to your cart, re-apply discount when ready');
	 	}
 	}

 	//Creates a orderDetail for the cart
 	private function newOrderDetail($order_id, $product_price, $product_id){
 		$newProduct = new \jkn_bay\models\Order_detail();
		 		
		//Sets all of the values for the order detail
		$newProduct->order_id = $order_id;
		$newProduct->product_id = $product_id;
		$newProduct->price = $product_price;
		$newProduct->qty = 1;

		//Creates the order detail
		$newProduct->insert();
		return $newProduct;
 	}

 	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Buyer]
 	//Allows buyers to view their cart
 	public function viewCart(){

 		//Gets the cart for the buyer
 	 	$cart = new \jkn_bay\models\Order();
 	 	$cart = $cart->findProfileCart($_SESSION['profile_id']);
 	 	
 	 	//Checks if their is a cart created for that buyer and if not then creates it
 	 	if ($cart == null) {
 	 		$cart = new \jkn_bay\models\Order();
	 	 	$cart->profile_id = $_SESSION['profile_id'];
	 	 	$cart->status = 'cart';
 			$cart->total = 0;
	 	 	$cart->order_id = $cart->insert();
 	 	}

 	 	$order_detail = new \jkn_bay\models\Order_detail();
 	 	$order_detail = $order_detail->getForOrder($cart->order_id);
 	 	
 	 	$discount = new \jkn_bay\models\Discount();
 	 	$discount = $discount->get($_SESSION['profile_id']);
	
 	 	if($discount == null ||$discount->status == 'created'){
			$total = 0;
	 	 	if($order_detail != null){
	 	 		foreach($order_detail as $item){
	 	 			$total += $item->price * $item->qty;
	 	 		}
				$cart->total = $total;	
	 	 		$cart->update();
	 	 	}
 	 	}
 	 		
 	 	//Gets all of the products for that cart
 	 	$product = new \jkn_bay\models\Order_detail();
 	 	$products = $product->getForOrder($cart->order_id);


		$this->view('Buyer/cart', ['product'=>$products, 'cart'=>$cart]);
	 	}

 	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Buyer]
 	//Allows buyers to delete products from their cart
  	public function removeFromCart($order_detail_id){
 	 	
 	 	//gets the order detail for the current buyer 
 	 	$product = new \jkn_bay\models\Order_detail();
 	 	$product = $product->get($order_detail_id);

 	 	//Gets the order for that order_detail
 	 	$cart = new \jkn_bay\models\Order();
 	 	$cart = $cart->get($product->order_id);

 	 	$discount = new \jkn_bay\models\Discount();
 	 	$discount = $discount->get($_SESSION['profile_id']);	

 	 	//Checks if the order profile matches the current profile logged in
 	 	if($cart->profile_id == $_SESSION['profile_id']){
 	 		$product->delete();
 	 		if($discount == null || $discount->status == 'created'){
 	 			$cart->total = $cart->total - $product->price;
 	 			$cart->update();
				header('location:/Buyer/viewCart?message=The product was deleted from your cart');
 	 		} else{
 	 			$original_total = ($cart->total) + ($cart->total * 0.25);
 	 			$total = $original_total - $product->price;
 	 			$cart->total = $total;
 	 			$cart->update();
 	 			$discount->status = 'created';
 	 			$discount->update();
 	 			header('location:/Buyer/viewCart?message=The product was deleted from your cart, re-apply discount when ready');
 	 		}
 	 	}
 	}


 	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Buyer]
 	//Allows buyers to checkout their cart
 	public function checkout(){

 		//Gets the cart for the buyer
 	 	$cart = new \jkn_bay\models\Order();
 	 	$cart = $cart->findProfileCart($_SESSION['profile_id']);
 	 	
 	 	$product = new \jkn_bay\models\Product();
 	 	$product = $product->productsToChangeQuantity($cart->order_id);

 	 	if($product == null){
 	 		header('location:/Buyer/viewCart?error=Cart empty');
 	 	} else{
			foreach($product as $item){
				$item->subtract($item->product_id, $item->qty);
		 			if($item->quantity == 0){
 		 						$item->status = 'sold';
 	 	  						$item->updateStatus();	
 	 	  			}
			}
	 	 
	 	$discount = new \jkn_bay\models\Discount();
		$discount = $discount->get($_SESSION['profile_id']);
 	 	
 	 	if($discount->status == 'applied' || $discount != null){
			$message = new \jkn_bay\models\Message();
			$discount->delete();
			$message = $message->get($discount->message_id);
			$message->delete();
 	 	}

 	 	 $cart->status = 'paid';

 	 	 $cart->update();
 	 	 header('location:/Buyer/viewCart?message=Your cart has been checked out');
 	 	}
 	 	
 	}

 	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Buyer]
 	//Allows buyers to check their orders
 	public function orderHistory(){

 		//Gets the every order and order_detail for the buyer
 	 	$order = new \jkn_bay\models\Order();
 	 	$orders = $order->findProfileCartPaid($_SESSION['profile_id']);
 	 	
 	 	$this->view('Buyer/orderHistory', ['order'=>$orders]);
 	 }

	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Buyer]
 	public function viewSeller($profile_id){

		$profile = new \jkn_bay\models\Profile();
		$profile = $profile->getProfileId($profile_id);

 		$product = new \jkn_bay\models\Product();
	 	$products = $product->getAllProfile($profile_id);

	 	$this->view('Buyer/viewSeller', ['products'=>$products, 'profile'=>$profile]);

 	}
}