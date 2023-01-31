<?php
namespace jkn_bay\controllers;

class Profile extends \jkn_bay\core\Controller{

	//Allows people to login to JKN_Bay
	public function index(){
		
		//Check if the person has clicked on the "Login" button
		if(isset($_POST['action'])){
			
			//Gets the profile which the person has entered
			$profile = new \jkn_bay\models\Profile();
			$profile = $profile->get($_POST['username']);

			//If the password matches the saved password in the database then create a session
			if(password_verify($_POST['password'], $profile->password_hash)){
				$_SESSION['username'] = $profile->username;
				$_SESSION['profile_id'] = $profile->profile_id;
				$_SESSION['role'] = $profile->role;

				//Checks which main page to create depending on the profile role
				if($_SESSION['role'] == 'buyer'){
					header('location:/Buyer/index?message=You have been successfully logged in');
				}else{
					header('location:/Product/index?message=You have been successfully logged in');
				}

			}else{
				//The person has inputted the wrong password
				header('location:/Profile/index?error=Incorrect username or password');
			}
		}else{
			$this->view('Profile/index');
		}
 	}

 	//Allows sellers or buyers to logout
 	public function logout(){
		
		//Destorys the current session
		session_destroy();
		header('location:/Buyer/index?message=You\'ve been successfully logged out');
	}

 	//Allows people to create a profile
 	public function register(){
		
		//Checks if the person has clicked the "Create profile" button
		if(isset($_POST['action'])){

			//Check if the inputted password matches the password confirmation input 
			if($_POST['password'] == $_POST['password_confirmation']){
			 	
			 	//Creates the profile
			 	$profile = new \jkn_bay\models\Profile();

			 	//Checks if the username is already taken
			 	if($profile->get($_POST['username'])){
			 		header('location: Profile/register?error=The Username already exists, Choose another');
			 	}else{

			 		//Sets the inputted values to the new profile
			 		$filename = $this->saveFile($_FILES['image']);
			 		$profile->username = $_POST['username'];
			 		$profile->first_name = $_POST['first_name'];
			 		$profile->last_name = $_POST['last_name'];
			 		$profile->postal_code = $_POST['postal_code'];
			 		$profile->city = $_POST['city'];
			 		$profile->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
			 		$profile->role = $_POST['role'];		
					$profile->image = $filename;

			 		//Creates the profile and sets it to the current session
			 		$profile =  $profile->insert();

			 		$new_profile = new \jkn_bay\models\Profile();
			 		$new_profile = $new_profile->getProfileId($profile);
			 		
			 		if($new_profile->role == 'buyer'){
			 			$message = $this->createDiscountMessage($new_profile->profile_id);
			 		}
					header('location:/Profile/index?message=Your profile is set up, login when ready');
			 	}
			} else{
				header('location:/Profile/register?error=The passwords do not match');
			} 	 	
		}else{
			$this->view('Profile/register');
		}
	 }

	 #[\jkn_bay\filters\Login]
	 //Allows sellers or buyers to edit their profile
	 public function edit(){
		
		//Gets the profile for the current session
		$profile = new \jkn_bay\models\Profile;
		$profile = $profile->getProfileId($_SESSION["profile_id"]); 

		//Checks if the seller or buyer has clicked on the "Edit Profile" button
		if(isset($_POST['action'])){

			//Deletes the old profile picture and changes it with the new one
			$filename = $this->saveFile($_FILES['image']);
			if($filename){
				unlink("images/$profile->image");
				$profile->image = $filename;
			}


			//Sets all of the values from the form inputs for the profile
			$profile->username = $_POST['username'];
			$profile->first_name = $_POST['first_name'];
			$profile->last_name = $_POST['last_name'];
			$profile->postal_code = $_POST['postal_code'];
			$profile->city = $_POST['city'];

			//updates the profile
			$profile->update();

			//Checks which page to go back to depending on the role of the current session
			if ($profile->role == 'buyer' ) {
				header('location:/Buyer/index?message=Profile Updated');
			} else {
				header('location:/Product/index?message=Profile Updated');
			}
		}else{
			$this->view('Profile/edit', $profile);
		}	
	}

	//Allows buyers to search through the catalog
 	public function search(){
	 	
		//Gets the value from the search box
	 	$search_val = $_GET['searchbar'];

	 	//Check if person or buyer input search box values
	 	if($search_val == null){
	 		header('location:/Buyer/index?error=Please enter the value that you are searching for');
	 	}
	 	//Gets all of the products related to the search box value
	 	$product = new \jkn_bay\models\Product();
		$products = $product->getAllSimilar($search_val);


		//Gets all of the profiles related to the search box value
	 	$profile = new \jkn_bay\models\Profile();
		$profiles = $profile->getAllSimilar($search_val);

		//Sends an error that no products matched the search box value
		if($products == null){
			header('location:/Buyer/index?error=No products match');
		}

		//Gets all of the categorys for the catalog
	 	$category = new \jkn_bay\models\Category();
	 	$categorys = $category->getAll();
	
		$this->view('Buyer/index', ['product'=>$products, 'categorys'=>$categorys]);
	}

	//Allows buyers to filter ther catalog
	public function filterCategory($category_id){
		
		//If no filter is selected
		if($category_id == 'None'){
			
			//Gets all of the products for the catalog
			$product = new \jkn_bay\models\Product();
	 		$products = $product->getAll();
	 		
	 		//Gets all of the categorys for the catalog
	 		$category = new \jkn_bay\models\Category();
	 		$categorys = $category->getAll();

			$this->view('Buyer/index', ['product'=>$products, 'categorys'=>$categorys]);
		}else{
			
			//Gets all of the products for the specified category
			$product = new \jkn_bay\models\Product();
			$products = $product->getAllCategory($category_id);
	 		
	 		//Gets all of the categorys for the catalog
	 		$category = new \jkn_bay\models\Category();
	 		$categorys = $category->getAll();

			$this->view('Buyer/index', ['product'=>$products, 'categorys'=>$categorys]);
		}
	}

	private function createDiscountMessage($profile_id){
		$message = new \jkn_bay\models\Message();
		$message->profile_id = $profile_id;
		
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < 5; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }

		$message->message = 'Welcome to JKN Bay, here is your discount code: ' . $randomString; 
		$message->flag = 'discount';
		$message->receiver_id = $profile_id;
		$message->insert();

		$message = new \jkn_bay\models\Message();
		$message = $message->getDiscountMessage($profile_id);
		$discount_code = new \jkn_bay\models\Discount();
	    $discount_code->profile_id = $profile_id;
	    $discount_code->message_id = $message->message_id;
	    $discount_code->status = 'created';
	    $discount_code->code = password_hash($randomString, PASSWORD_DEFAULT);
	    $discount_code->insert();
	} 
}