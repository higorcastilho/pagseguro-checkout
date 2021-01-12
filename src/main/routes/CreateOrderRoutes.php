<?php

require_once(__DIR__ . '/../composers/CreateOrderRouterComposer.php');
require_once(__DIR__ . '/../adapters/adapter.php');

class CreateOrderRoutes {
	public function create () {
		return Adapter::adapt(CreateOrderRouterComposer::compose());
	}
}