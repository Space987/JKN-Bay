<?php
namespace jkn_bay\core;

class Controller{
	protected function view($name, $data = []){
		//call in a view to display
		include('jkn_bay\\views\\' . $name .'.php');
	}

	public function saveFile($file){
		if(empty($file['tmp_name'])){
			return false;
		}
		$check = getimagesize($file['tmp_name']);
		$allowed_types = ['image/png'=>'png', 'image/jpeg'=>'jpg'];
		
		if(in_array($check['mime'], array_keys($allowed_types))){
			
			$ext = $allowed_types[$check['mime']];
			$filename = uniqid() . "." . $ext;

			move_uploaded_file($file['tmp_name'], 'images/' . $filename);
		}
		return $filename;
	}
}