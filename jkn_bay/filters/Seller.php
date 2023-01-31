<?php
namespace jkn_bay\filters;

#[\Attribute]
class Seller extends \jkn_bay\core\AccessFilter{
	
	public function execute(){
		if($_SESSION['role'] != 'seller'){
			header('location:/Buyer/index?error=Your account does not have the privelage to this page');
			return true;
		}
		return false;
	}
}