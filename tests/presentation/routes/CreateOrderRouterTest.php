<?php
//namespace PagseguroService\presentation\routes;
use PHPUnit\Framework\TestCase;
use PagseguroService\presentation\routes\CreateOrderRouter;

class MakeSut {
	
	public function make() {
		
		$sut = new CreateOrderRouter(); 

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
			$json
		);
	}
}

class CreateOrderRouterTest extends TestCase {
	
	public function testShouldReturn400IfNoParamIsProvided () {
		
		$makeSut = new MakeSut; 
		list($sut, $client, $json) = $makeSut->make();
		$json['senderPhone'] = '';

		$response = $client->request(
			'POST', 
			'/pagseguro-checkout/src/main/createOrder/create', 
			['json' => $json, 'http_errors' => false ]
		);	

		$this->assertEquals(400, $response->getStatusCode());
	}

	public function testShouldReturn200IfValidParamAreProvided () {
		$makeSut = new MakeSut; 
		list($sut, $client, $json) = $makeSut->make();

		$response = $client->request(
			'POST', 
			'/pagseguro-checkout/src/main/createOrder/create', 
			['json' => $json, 'http_errors' => false ]
		);	

		$this->assertEquals(200, $response->getStatusCode());
	}
}