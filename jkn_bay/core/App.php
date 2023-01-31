<?php
namespace jkn_bay\core;
    		   
class App{

	private $controller = 'Buyer';
	private $method = 'index';


	public function __construct(){
		//Routing algorithm is used to seperate the url in parts
		$url = self::parseUrl(); //get the url parsed and returned as an array of url parts

		//use the first part to determine the class to load
		if(isset($url[0]))
		{
				if(file_exists('jkn_bay/controllers/' .$url[0] . '.php')){
					$this->controller = $url[0]; //$this refers to the current object
				}
				unset($url[0]);
		}
		$this->controller = 'jkn_bay\\controllers\\' . $this->controller; //provide a fully qualified classname
		$this->controller = new $this->controller; 

		//use the second part to determine the method to run 

		if(isset($url[1]))
		{
			if(method_exists($this->controller, $url[1]))
			{
				$this->method = $url[1];
			}
			unset($url[1]);
		}

		$reflection = new \ReflectionObject($this->controller);
		$classAttributes = $reflection->getAttributes();
		$methodAttributes = $reflection->getMethod($this->method)->getAttributes();

		$attributes = array_values(array_merge($classAttributes, $methodAttributes));

		foreach($attributes as $attribute){
				$filter = $attribute->newInstance();
				if($filter-> execute()){
					return;
				}
		}

		//while passing all other parts as arguments
		//replace the paramaters
		$params = $url ? array_values($url) : [];

		call_user_func_array([ $this->controller, $this->method ], $params);
	}

	public static function parseUrl(){
		if(isset($_GET['url']))//url exists
		{
			//explode seperates string from the character provided and returns it in an array
			//firlter_var removes non_URl characters and sequences
			//rtrim removes any extra character '/' 
			return explode('/', 
					filter_var(
							rtrim($_GET['url'], '/')), FILTER_SANITIZE_URL);
		}
	}
}