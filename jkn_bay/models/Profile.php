<?php
namespace jkn_bay\models;

class Profile extends \jkn_bay\core\Models{

	//Creates a profile
	public function insert(){
		$SQL = "INSERT INTO profile(username, first_name, last_name, postal_code, city, password_hash, role, image) VALUES (:username, :first_name, :last_name, :postal_code, :city, :password_hash, :role, :image)";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['username'=>$this->username,
			 'first_name'=>$this->first_name, 
			 'last_name'=>$this->last_name, 
			 'postal_code'=>$this->postal_code, 
			 'city'=>$this->city, 
			 'password_hash'=>$this->password_hash,
			 'role'=>$this->role,
			 'image'=>$this->image]);
		$profile_id = self::$_connection->lastInsertId();
		return $profile_id;
	}

	//Updates the profile
	public function update(){
		$SQL = "UPDATE profile SET username=:username, first_name=:first_name, last_name=:last_name, postal_code=:postal_code, city=:city, image=:image WHERE profile_id=:profile_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['username'=>$this->username,
			 'first_name'=>$this->first_name, 
			 'last_name'=>$this->last_name, 
			 'postal_code'=>$this->postal_code, 
			 'city'=>$this->city,
			 'image'=>$this->image,
			 'profile_id'=>$this->profile_id]);
	}

	//Gets a specified profile
	public function get($username){
		$SQL = "SELECT * FROM profile WHERE username LIKE :username";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username'=>$username]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Profile");
		return $STMT->fetch();
	}

	//Gets a profile based off the profile_id
	public function getProfileId($profile_id){
		$SQL = "SELECT * FROM profile WHERE profile_id=:profile_id";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['profile_id'=>$profile_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Profile");
		return $STMT->fetch();
	}

	//Gets all profiles that match the search box value	
	public function getAllSimilar($search_val){
		$SQL = "SELECT * FROM profile WHERE first_name LIKE '%$search_val%'";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Profile");
		return $STMT->fetchAll();
	}
}