<?php
//namespace PagseguroService\presentation\routes;
use PHPUnit\Framework\TestCase;
use PagseguroService\presentation\routes\CreateOrderRouter;

class CreateOrderUseCaseSpy {

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
		$httpResponse = $sut->route(10);
		
		$this->assertSame(10, $httpResponse);
	}	
}