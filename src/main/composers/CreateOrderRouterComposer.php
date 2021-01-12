<?php
require_once "../../vendor/autoload.php";
use PagseguroService\presentation\routes\CreateOrderRouter;

class CreateOrderRouterComposer {
	static public function compose() {
		return new CreateOrderRouter();
	}
}