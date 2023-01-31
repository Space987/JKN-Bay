<?php
namespace jkn_bay\controllers;

class Product extends \jkn_bay\core\Controller{

	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Seller]
	//Creates the seller page with their products
	public function index(){
		
		//Gets all of the products for the current seller logged in
	 	$product = new \jkn_bay\models\Product();
	 	$products = $product->getAllProfile($_SESSION['profile_id']);

		$this->view('Product/index', ['product'=>$products]);
 	}

 	#[\jkn_bay\filters\Login]
 	#[\jkn_bay\filters\Seller]
 	//Allows sellers to add products to the catalog
 	public function add(){
		
		//Checks if seller pressed the "Add Product" button
		if(isset($_POST['action'])){
			
			//Creates the product and sets all of the values from the form inputs
			$product = new \jkn_bay\models\Product();
			$filename = $this->saveFile($_FILES['image']);
			$product->profile_id = $_SESSION['profile_id'];
			$product->name = $_POST['name'];
			$product->description = $_POST['description'];
			$product->price = $_POST['price'];
			$product->quantity = $_POST['quantity'];
			if($filename){
				$product->image = $filename;
			} else{
				$product->image = "blank.jpg";
			}
			
			//Checks if seller selected the state of their object
			if($_POST['state'] == null){
				header('location:/Product/add?error=Please choose the state');
			} else{
				$product->state = $_POST['state'];
			}
			
			//Checks if the seller put a category or not
			if($_POST['category'] == 'None'){
				$product->category_id = null;
			} else{
				$product->category_id = $_POST['category'];
			}

			//Creates the product
			$product->insert();

			header('location:/Product/index?message=Product Created');
		}else{

			//Gets all of the categorys
	 		$category = new \jkn_bay\models\Category();
	 		$categorys = $category->getAll();

			$this->view('Product/add', ['categorys'=>$categorys]);
		}
	}

	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Seller]
	//Allows sellers to edit their products
	public function edit($product_id){

		//Gets the product to edit
		$product = new \jkn_bay\models\Product();
		$product = $product->get($product_id);
		
		//Checks if seller pressed the "Edit Product" button
		if(isset($_POST['action'])){

			
			//Deletes the old product picture and changes it to the new one
			$filename = $this->saveFile($_FILES['image']);

			if($filename){
				unlink("images/$product->image");
				$product->image = $filename;
			}
			
			//Sets all of the values from the form inputs for the product
			$product->name = $_POST['name'];
			$product->description = $_POST['description'];
			$product->price = $_POST['price'];
			$product->quantity = $_POST['quantity'];
			
			//Checks if seller selected the state of their object
			if($_POST['state'] == null){
				header('location:/Product/edit?error=Please choose the state');
			} else{
				$product->state = $_POST['state'];
			}

			//Checks if the seller put a category or not
			if($_POST['category'] == 'None'){
				$product->category_id = null;
			} else{
				$product->category_id = $_POST['category'];
			}

			//Updates the product
			$product->update();

			header('location:/Product/index?message=Product updated');
		}else{
			
			//Gets all of the categorys
			$category = new \jkn_bay\models\Category();
	 		$categorys = $category->getAll();
			
			$this->view('/Product/edit', ['product'=>$product, 'categorys'=>$categorys]);
		}
	}

	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Seller]
	//Allows seller to delete his product
	public function delete($product_id){
			
			//Gets the product to delete
			$product = new \jkn_bay\models\Product();
			$product = $product->get($product_id);

 	 		$order = new \jkn_bay\models\Order();
 	 		$orders = $order->findProductsOrdered($product_id);

 	 		if(!$orders){
 	 			//Gets the order details for the specified product incase buyers added them to their cart
				$order_detail = new \jkn_bay\models\Order_detail();
				$order_detail= $order_detail->getForProduct($product_id);

				//It deletes the order details for the product in the buyers cart
				if($order_detail != null){
					$order_detail->deleteProductDetail();	
				}
				
				//Deletes all messages between buyer and seller regarding the product
				$product->deleteMessages();

				//Deletes the product
				$product->delete();
					
				header('location:/Product/index?message=Product Deleted');

 	 		} else{
				header('location:/Product/index?error=Product could not be deleted because it has already been ordered');
 	 		}
			
	}

	#[\jkn_bay\filters\Login]
	#[\jkn_bay\filters\Seller]
 	//Allows sellers to check their sold products
 	public function soldHistory(){
 		//Gets the every order and order_detail for the buyer
 	 	$order = new \jkn_bay\models\Order();
 	 	$orders = $order->findProductsPaid($_SESSION['profile_id']);
 	 	$this->view('Product/soldHistory', ['order'=>$orders]);
 	}
}