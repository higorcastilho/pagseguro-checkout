<?php
namespace PagseguroService\presentation\routes;

class CreateOrderRouter {

	/*private $createOrderUseCase;

	public function __construct(CreateOrderUseCase $createOrderUseCase) {
		$this->createOrderUseCase = $createOrderUseCase;
	}*/

	public function route () {
		$input = file_get_contents("php://input");
		return 10;		
	}
}