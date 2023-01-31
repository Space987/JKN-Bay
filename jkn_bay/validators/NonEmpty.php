<?php
namespace jkn_bay\validators;

#[\Attribute]
class NonEmpty extends \jkn_bay\core\Validator{
	
	public function isValidData($data){
		return !empty($data);
	}
}