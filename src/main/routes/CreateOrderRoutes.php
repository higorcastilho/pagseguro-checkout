<?php

require_once(__DIR__ . '/../composers/CreateOrderRouterComposer.php');
require_once(__DIR__ . '/../adapters/Adapter.php');

class CreateOrderRoutes {
	public function create () {
		$response = Adapter::adapt(CreateOrderRouterComposer::compose());
		echo json_encode($response);
	}
}