<?php
namespace jkn_bay\filters;

#[\Attribute]
class Login extends \jkn_bay\core\AccessFilter{

	public function execute(){
		if(!isset($_SESSION['profile_id'])){
			header('location:/Buyer/index?error=You must login to use these features!');
			return true;
		}
		return false;
	}
}