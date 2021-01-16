<?php
require_once "../../vendor/autoload.php";
use PagseguroService\presentation\routes\CreateOrderRouter;
use PagseguroService\domain\usecases\CreateOrderUseCase;
use PagseguroService\utils\helpers\PagseguroPerformRequest;
require_once(__DIR__ . '/../config/env.php');

class CreateOrderRouterComposer {
	static public function compose() {

		$pagseguroPerformRequest = new PagseguroPerformRequest(URL_PAGSEGURO, EMAIL_PAGSEGURO, TOKEN_PAGSEGURO);
		$createOrderUseCase = new CreateOrderUseCase($pagseguroPerformRequest);
		return new CreateOrderRouter($createOrderUseCase);
	}
}