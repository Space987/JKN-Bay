<?php
namespace jkn_bay\models;

class Category extends \jkn_bay\core\Models{

	//Gets all of the categorys
	public function getAll(){
		//get all records from the owner table
		$SQL = "SELECT * FROM category";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute();//pass any data for the query
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "jkn_bay\\models\\Category");
		return $STMT->fetchAll();
	}
}