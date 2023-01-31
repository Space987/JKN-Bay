<?php
namespace jkn_bay\models;

class Order_detail extends \jkn_bay\core\Models{

	//Creates a order detail
	public function insert(){
		$SQL = "INSERT INTO order_detail(order_id, product_id, qty, price) VALUES (:order_id, :product_id, :qty, :price) 
		ON DUPLICATE KEY UPDATE qty=qty+:qty";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['order_id'=>$this->order_id, 
			 'product_id'=>$this->product_id,
			 'qty'=>$this->qty, 
			 'price'=>$this->price]);
	}

	//Updates a order detail
	public function update(){
		$SQL = "UPDATE order_detail SET qty=:qty, price=:price WHERE order_detail_id=:order_detail_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['qty'=>$this->qty, 
			 'price'=>$this->price,
			 'order_detail_id'=>$this->order_detail_id
			]);
	}

	//Deletes the order detail base off of the order_detail_id
	public function delete(){
		$SQL = "DELETE FROM order_detail WHERE order_detail_id=:order_detail_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['order_detail_id'=>$this->order_detail_id]);
	}

	//Deletes the order detail base off of the product_id
	public function deleteProductDetail(){
		$SQL = "DELETE FROM order_detail WHERE product_id=:product_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['product_id'=>$this->product_id]);
	}

	//Gets the specified order detail
	public function get($order_detail_id){
		//get all records from the owner table
		$SQL = "SELECT * FROM order_detail WHERE order_detail_id=:order_detail_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['order_detail_id'=>$order_detail_id]);//pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Order_detail");
		return $STMT->fetch();
	}

	//Gets the specified order detail based on the order_id
	public function getForOrder($order_id){
		//get all records from the owner table
		$SQL = "SELECT order_detail.order_detail_id, order_detail.order_id, order_detail.qty, product.* FROM order_detail JOIN product ON order_detail.product_id = product.product_id WHERE order_detail.order_id = :order_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['order_id'=>$order_id]);//pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Order");
		return $STMT->fetchAll();
	}

	//Gets the specified order detail based on the product_id
	public function getForProduct($product_id){
		//get all records from the owner table
		$SQL = "SELECT * FROM order_detail WHERE product_id=:product_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['product_id'=>$product_id]);//pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Order_detail");
		return $STMT->fetch();
	}

	//Gets the specified order detail based on the product_id and order_id
	public function getProductForOrder($product_id){
		$SQL = "SELECT * FROM order_detail JOIN `order` ON order_detail.order_id=`order`.order_id JOIN 	profile ON `order`.profile_id=profile.profile_id  
		WHERE order_detail.product_id=:product_id && `order`.profile_id=:profile_id && `order`.status=:status";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['product_id'=>$product_id, 'profile_id'=>$_SESSION['profile_id'], 'status'=>'cart']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Order_detail");
		return $STMT->fetch();
	}

	//Gets the specified order detail based on the order_id
	public function getForRating($order_id){
		//get all records from the owner table
		$SQL = "SELECT product.name, profile.username FROM order_detail JOIN product ON order_detail.product_id = product.product_id JOIN profile ON product.profile_id = profile.profile_id WHERE order_detail.order_id = :order_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['order_id'=>$order_id]);//pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Order");
		return $STMT->fetch();
	}
}
