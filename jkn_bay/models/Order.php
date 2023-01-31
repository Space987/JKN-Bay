<?php
namespace jkn_bay\models;

class Order extends \jkn_bay\core\Models{

	//Creates an order
	public function insert(){
		$SQL = "INSERT INTO `order` (profile_id, status) VALUES (:profile_id, :status)";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['profile_id'=>$this->profile_id, 
			 'status'=>$this->status]);
		$this->order_id = self::$_connection->lastInsertId();
		return $this->order_id;
	}

	//Updates the order
	public function update(){
		$SQL = "UPDATE `order` SET status=:status, total=:total WHERE order_id=:order_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['status'=>$this->status,
			 'total'=>$this->total,
			 'order_id'=>$this->order_id]);
	}

	//Deletes an order
	public function delete(){
		$SQL = "DELETE FROM `order` WHERE order_id=:order_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['order_id'=>$this->order_id]);
	}

	//Gets the specific order
	public function get($order_id){
		//get all records from the owner table
		$SQL = "SELECT * FROM `order` WHERE order_id=:order_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['order_id'=>$order_id]);//pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Order");
		return $STMT->fetch();
	}

	//Gets all of the orders
	public function getAll(){
		$SQL = "SELECT * FROM `order`";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute();//pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Order");
		return $STMT->fetchAll();
	}
	
	//Gets the order for the specific profile
	public function findProfileCart($profile_id){
		$SQL = "SELECT * FROM `order` WHERE profile_id=:profile_id && status=:status";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['profile_id'=>$profile_id, 'status'=>'cart']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Order");
		return $STMT->fetch();
	}

	public function findProfileCartPaid($profile_id){
		$SQL = "SELECT `order`.*, product.name, product.image,product.rating, rating.*, profile.username, profile.ratingSeller,ratingseller.*,order_detail.* FROM `order` LEFT JOIN order_detail ON `order`.order_id = order_detail.order_id JOIN product ON product.product_id = order_detail.product_id LEFT JOIN rating ON rating.r_profile_id = `order`.profile_id && rating.r_product_id = product.product_id LEFT JOIN ratingseller ON ratingseller.rate_profile_id = `order`.profile_id && ratingseller.rate_seller_id = product.profile_id LEFT JOIN profile ON profile.profile_id = product.profile_id WHERE `order`.profile_id = :profile_id && `order`.status=:status ORDER BY order.order_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['profile_id'=>$profile_id, 'status'=>'paid']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Order");
		return $STMT->fetchAll();
	}

	//Gets the order for the specific profile
	public function findProductsPaid($profile_id){
		$SQL = "SELECT `order`.*, product.name, product.image, product.rating, order_detail.*, profile.username FROM `order` LEFT JOIN order_detail ON order.order_id = order_detail.order_id JOIN product ON product.product_id = order_detail.product_id JOIN profile ON profile.profile_id = `order`.profile_id WHERE product.profile_id =:profile_id && `order`.status=:status ORDER BY order.order_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['profile_id'=>$profile_id, 'status'=>'paid']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Order");
		return $STMT->fetchAll();
	}

	//Gets the order for the specific profile
	public function findProductsOrdered($product_id){
		$SQL = "SELECT * FROM `order` JOIN order_detail ON order.order_id = order_detail.order_id JOIN product ON product.product_id = order_detail.product_id WHERE `order`.status=:status && order_detail.product_id=:product_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['product_id'=>$product_id, 'status'=>'paid']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Order");
		return $STMT->fetchAll();
	}
}
