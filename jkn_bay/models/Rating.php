<?php
namespace jkn_bay\models;

class Rating extends \jkn_bay\core\Models{

	//Gets all of the ratings
	public function getRatingStatus($profile_id){
		//get all records from the rating table
		$SQL = "SELECT * FROM rating WHERE r_profile_id=:profile_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['profile_id'=>$profile_id]);//pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Rating");
		return $STMT->fetchAll();
	}

	public function getRatingStatusSeller($profile_id){
		//get all records from the rating table
		$SQL = "SELECT * FROM ratingSeller WHERE rate_profile_id=:profile_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['profile_id'=>$profile_id]);//pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Rating");
		return $STMT->fetchAll();
	}

	public function addRatingStatus(){
		$SQL = "INSERT INTO rating (r_product_id, r_profile_id) VALUES (:product_id, :profile_id)";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['product_id'=>$this->product_id, 
			 'profile_id'=>$this->profile_id]);
	}

	public function addRatingStatusSeller(){
		$SQL = "INSERT INTO ratingseller (rate_seller_id, rate_profile_id) VALUES (:seller_id, :profile_id)";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['seller_id'=>$this->seller_id, 
			 'profile_id'=>$this->profile_id]);
	}

	public function subRatingStatus(){
		$SQL = "DELETE FROM rating WHERE r_product_id=:product_id AND r_profile_id=:profile_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['product_id'=>$this->product_id, 
			 'profile_id'=>$this->profile_id]);
	}

	public function subRatingStatusSeller(){
		$SQL = "DELETE FROM ratingseller WHERE rate_seller_id=:seller_id AND rate_profile_id=:profile_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['seller_id'=>$this->seller_id, 
			 'profile_id'=>$this->profile_id]);
	}


	public function changeRatingData(){
		$SQL ="UPDATE product SET rating=:rating WHERE product_id =:product_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['rating'=>$this->rating,
						'product_id'=>$this->product_id]);
		
	}

	public function changeRatingDataSeller(){

		$SQL ="UPDATE profile SET ratingSeller=:ratingSeller WHERE profile_id =:profile_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['ratingSeller'=>$this->ratingSeller,
						'profile_id'=>$this->profile_id]);
		
	}



	//Gets a specific product
	public function get($product_id){
		//get all records from the owner table
		$SQL = "SELECT * FROM product WHERE product_id=:product_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['product_id'=>$product_id]);//pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Rating");
		return $STMT->fetch();
	}

	public function getSeller($product_id){
		//get all records from the owner table
		$SQL = "SELECT * FROM profile JOIN product ON profile.profile_id = product.profile_id WHERE product_id=:product_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['product_id'=>$product_id]);//pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Rating");
		return $STMT->fetch();
	}

	
}