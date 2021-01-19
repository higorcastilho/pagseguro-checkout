<?php
require_once "../../vendor/autoload.php";
use PagseguroService\presentation\routes\CreateOrderRouter;
use PagseguroService\domain\usecases\CreateOrderUseCase;
use PagseguroService\infra\repositories\PagseguroPerformRequestRepository;
require_once(__DIR__ . '/../config/env.php');

class CreateOrderRouterComposer {
	static public function compose() {

		$pagseguroPerformRequestRepository = new PagseguroPerformRequestRepository(URL_PAGSEGURO, EMAIL_PAGSEGURO, TOKEN_PAGSEGURO);
		$createOrderUseCase = new CreateOrderUseCase($pagseguroPerformRequestRepository);
		return new CreateOrderRouter($createOrderUseCase);
	}
}