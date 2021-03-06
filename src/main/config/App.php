<?php 
namespace PagseguroService\main\config;

class App {
	
	private $uri;
	private $route;
	private $method;
	
	public function start ($requestURI) {

		$this->uri = parse_url($requestURI, PHP_URL_PATH);
		$this->uri = explode('/', $this->uri);

		if ($this->uri[1] !== 'pagseguro-checkout') {
			header("HTTP/1.1 404 Not Found");
			exit();
		}

		if ($this->uri[1]) {
			// src/main/createOrder/create
			if ($this->uri[4] !== '') {
				
				$this->route = ucfirst($this->uri[4]. 'Routes');
				if ($this->uri[5] !== '') {
					
					$this->method = $this->uri[5];
				}
			} else {
				$this->route = 'CreateOrderRoutes';
				$this->method = 'create';
			}
		}

		return call_user_func(array(new $this->route, $this->method));
	}
}