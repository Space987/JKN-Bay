<?php
namespace jkn_bay\models;

class Discount extends \jkn_bay\core\Models{
	
	//Create discounts
	public function insert(){
		$SQL = "INSERT INTO discount(profile_id, message_id, code) VALUES (:profile_id, :message_id, :code)";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['profile_id'=>$this->profile_id,
			 'message_id'=>$this->message_id,
			 'code'=>$this->code]);
	}

	//Updates the discount status
	public function update(){
		$SQL = "UPDATE discount SET status=:status WHERE discount_id=:discount_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['status'=>$this->status,
			 'discount_id'=>$this->discount_id]);
	}

	//Deletes a specified product
	public function delete(){
		$SQL = "DELETE FROM discount WHERE discount_id=:discount_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['discount_id'=>$this->discount_id]);
	}

	public function get($profile_id){
		$SQL = "SELECT * FROM discount WHERE profile_id=:profile_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['profile_id'=>$profile_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Discount");
		return $STMT->fetch();
	}
} 	