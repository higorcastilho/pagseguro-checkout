<?php
//namespace PagseguroService\presentation\routes;
use PHPUnit\Framework\TestCase;
use PagseguroService\presentation\routes\CreateOrderRouter;
use PagseguroService\domain\usecases\CreateOrderUseCase;

class CreateOrderUseCaseDoubleIntegration {
	
	public $data;

	function create ($input) {
		$this->data = $input;
	}
} 

class MakeRouterSutIntegrationTest {
	
	static public function make () {

		$url = "http://localhost:8000/";
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$json = [
			'itemId1' => '0001',
			'itemAmount1' => '100.00',
			'itemQuantity1' => 1,
			'senderName' => 'Jose Comprador',
			'senderEmail' => 'email@sandbox.pagseguro.com.br',
			'senderAreaCode' => '11',
			'senderPhone' => '56713293',
			'shippingAddressStreet' => 'Av. Brig. Faria Lima',
			'shippingAddressNumber' => '1384',
			'shippingAddressComplement' => '2o andar',
			'shippingAddressDistrict' => 'Jardim Paulistano',
			'shippingAddressPostalCode' => '01452002',
			'shippingAddressCity' => 'Sao Paulo',
			'shippingAddressState' => 'SP',
			'currency' => 'BRL',
			'itemDescription1' => 'Whey Coffee',
			'itemWeight1' => 1000,
			'reference' => 'REF1234',
			'senderCPF' => '38440987803',
			'senderBornDate' => '12/03/1990',
			'shippingType' => 1,
			'shippingAddressCountry' => 'BRA',
			'extraAmount' => -0.01,
			'redirectURL' => 'http://sitedocliente.com',
			'notificationURL' => 'https://url_de_notificacao.com',
			'maxUses' => 1,
			'maxAge' => 3000,
			'shippingCost' => '0.00'
		];

		return Array(
			$client,
			$json
		);
	}
}

class CreateOrderRouterIntegrationTest extends TestCase {
	
	public function testShouldReturn400IfNoParamIsProvided () {
		
		list($client, $json) = MakeRouterSutIntegrationTest::make();
		//set any of the params to an empty string to force a bad request
		$json['senderPhone'] = '';

		$response = $client->request(
			'POST', 
			'/pagseguro-checkout/src/main/createOrder/create', 
			['json' => $json, 'http_errors' => false ]
		);	

		$data = json_decode($response->getBody(), true);
		
		$this->assertEquals(400, $data['statusCode']);
		$this->assertEquals('Missing param error', $data['body']);
	}

	public function testShouldReturn200AndAResponseContainingTheRequestedCode () {
		list($client, $json) = MakeRouterSutIntegrationTest::make();
		$response = $client->request(
			'POST', 
			'/pagseguro-checkout/src/main/createOrder/create', 
			['json' => $json, 'http_errors' => false ]
		);

		$data = json_decode($response->getBody(), true);

		$codeIsValid = preg_match('/\w{32}/', $data['body']['code']);

		$this->assertEquals(200, $data['statusCode']);	
		$this->assertTrue(boolval($codeIsValid));	
	}
}