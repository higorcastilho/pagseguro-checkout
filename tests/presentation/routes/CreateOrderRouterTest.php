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

	public function testEnsureCreateOrderRouterReceivesPostDataCorrectly (): void {
		
		list($sut) = $this->makeSut();
		
		$url = "http://localhost:8000/";

		$client = new GuzzleHttp\Client(['base_uri' => $url]);

		$response = $client->request('POST', '/pagseguro-checkout/src/main', [
			'json' => ['foo' => 'bar']
		]);

		echo $response->getBody(true);
	}	
}