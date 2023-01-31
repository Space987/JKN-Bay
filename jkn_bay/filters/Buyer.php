<?php
namespace jkn_bay\filters;

#[\Attribute]
class Buyer extends \jkn_bay\core\AccessFilter{
	
	public function execute(){
		if(isset($_SESSION['profile_id']))
		{
			if($_SESSION['role'] != 'buyer'){
				header('location:/Product/index?error=Your account does not have the privelage to this page');
				return true;
			}
		}
		return false;
	}
}