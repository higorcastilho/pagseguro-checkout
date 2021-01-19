<?php 

class Adapter {
	static public function adapt ($router) {
		
		$input = file_get_contents("php://input");
		$response = $router->route($input);
		http_response_code($response['statusCode']);
		return $response['body'];
	}
}