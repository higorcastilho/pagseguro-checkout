<?php
//namespace PagseguroService\presentation\routes;

use PHPUnit\Framework\TestCase;

class CreateOrderRouter {

	/*private $createOrderUseCase;

	public function __construct(CreateOrderUseCase $createOrderUseCase) {
		$this->createOrderUseCase = $createOrderUseCase;
	}*/

	public function route ($httpRequest) {
		return 2;
	}
}

class createOrderUseCaseSpy {

}

trait MakeSut {
	
	public function makeSut() {
		
		$sut = new CreateOrderRouter(); 

		return Array(
			$sut
		);
	}
}

class CreateOrderRouterTest extends TestCase {
	
	use MakeSut;

	public function testCreateOrderRouter (): void {
		list($sut) = $this->makeSut();
		$httpResponse = $sut->route(2);
		
		$this->assertSame(2, $httpResponse);
	}	
}