<?php
//namespace PagseguroService\presentation\routes;
use PHPUnit\Framework\TestCase;
use PagseguroService\presentation\routes\CreateOrderRouter;
use PagseguroService\domain\usecases\CreateOrderUseCase;

class CreateOrderUseCaseDouble {
	
	public $data;

	function create ($input) {
		$this->data = $input;
	}
} 

class MakeSut {
	
	static public function make() {

		$createOrderUseCaseDouble = new CreateOrderUseCaseDouble();
		$sut = new CreateOrderRouter($createOrderUseCaseDouble); 

		$url = "http://localhost:8000/";
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$json = [
			'itemId1' => 'any_item_id',
			'itemAmount1' => 'any_amount',
			'itemQuantity1' => 'any_quantity',
			'senderName' => 'any_name',
			'senderAreaCode' => 'any_area_code',
			'senderPhone' => 'any_phone',
			'shippingAddressStreet' => 'any_shipping_address',
			'shippingAddressNumber' => 'any_address_number',
			'shippingAddressComplement' => 'any_address_complement',
			'shippingAddressDistrict' => 'any_address_district',
			'shippingAddressPostalCode' => 'any_address_postal_code',
			'shippingAddressCity' => 'any_address_city',
			'shippingAddressState' => 'any_address_state'
		];

		return Array(
			$sut,
			$client,
			$json,
			$createOrderUseCaseDouble
		);
	}
}

class CreateOrderRouterTest extends TestCase {
	
	public function testShouldReturn400IfNoParamIsProvided () {
		
		list($sut, $client, $json) = MakeSut::make();
		//set any of the params to an empty string to force a bad request
		$json['senderPhone'] = '';

		$response = $client->request(
			'POST', 
			'/pagseguro-checkout/src/main/createOrder/create', 
			['json' => $json, 'http_errors' => false ]
		);	

		$this->assertEquals(400, $response->getStatusCode());
	}

	public function testShouldReturn200IfValidParamAreProvided () {
		list($sut, $client, $json) = MakeSut::make();

		$response = $client->request(
			'POST', 
			'/pagseguro-checkout/src/main/createOrder/create', 
			['json' => $json, 'http_errors' => false ]
		);	

		$this->assertEquals(200, $response->getStatusCode());
	}

	public function testShouldCallCreateOrderRouterUseCaseWithCorrectValues () {
		
		list($sut, $client, $json, $createOrderUseCaseDouble) = MakeSut::make();

		//$sut->route(json_encode($json));

		$this->assertJsonStringEqualsJsonString(
			json_encode($json),
			json_encode($createOrderUseCaseDouble->data)
		);
	}
}