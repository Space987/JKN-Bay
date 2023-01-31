<?php
namespace jkn_bay\models;

class Message extends \jkn_bay\core\Models{

	#[\jkn_bay\validators\NonEmpty]
	public $message;

	protected function insert(){
        $SQL = "INSERT INTO message(sender_id, message, receiver_id, product_id, reply_to, flag) VALUES (:sender_id, :message, :receiver_id, :product_id, :reply_to, :flag)";
        $STMT = self::$_connection->prepare($SQL);
        $STMT->execute(
            ['receiver_id'=>$this->receiver_id,
             'message'=>$this->message,
             'sender_id'=>$this->sender_id,
             'product_id'=>$this->product_id,	
			 'flag'=>$this->flag,
         	 'reply_to'=>$this->reply_to]);
    }

	//Gets all the messages based for a profile
	public function getMessagesBuyer($profile_id){
		$SQL = "SELECT message.*,product.name, profile.username FROM message JOIN product ON product.product_id = message.product_id
				JOIN profile ON profile.profile_id = sender_id WHERE message.sender_id =:profile_id OR message.receiver_id =:profile_id ORDER BY product.product_id, date_time";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['profile_id'=>$profile_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Message");
		return $STMT->fetchAll();
	}

	//Gets all the messages based for a profile
	public function getMessagesSeller($profile_id){
		$SQL = "SELECT message.*,product.name, profile.username FROM message JOIN product ON product.product_id = message.product_id
				JOIN profile ON profile.profile_id = sender_id WHERE message.sender_id =:profile_id OR message.receiver_id =:profile_id ORDER BY reply_to ASC";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['profile_id'=>$profile_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Message");
		return $STMT->fetchAll();
	}

	public function getForDiscount($profile_id){
		$SQL = "SELECT * FROM message WHERE receiver_id=:profile_id && flag=:flag";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['profile_id'=>$profile_id, 'flag'=> 'discount']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Message");
		return $STMT->fetchAll();
	}	

	//Deletes all messages based on the product
	public function delete(){
		$SQL = "DELETE FROM message WHERE message_id=:message_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['message_id'=>$this->message_id]);
	}
	
	//Gets a specific product
	public function get($message_id){
		//get all records from the owner table
		$SQL = "SELECT * FROM message WHERE message_id=:message_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['message_id'=>$message_id]);//pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Message");
		return $STMT->fetch();
	}

	//Gets the specific order
	public function getDiscountMessage($profile_id){
		$SQL = "SELECT * FROM message WHERE receiver_id=:profile_id && flag=:flag";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['profile_id'=>$profile_id, 'flag'=>'discount']);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Message");
		return $STMT->fetch();
	}

	public function getProductMessage($profile_id, $product_id){
		$SQL = "SELECT message.* FROM message JOIN product ON product.product_id = message.product_id
				JOIN profile ON profile.profile_id = sender_id WHERE message.sender_id =:profile_id && product.product_id=:product_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['profile_id'=>$profile_id, 'product_id'=>$product_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Message");
		return $STMT->fetchAll();
	}
}