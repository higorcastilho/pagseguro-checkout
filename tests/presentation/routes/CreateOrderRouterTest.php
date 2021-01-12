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

	public function testShouldReturn400IfNoParamIsProvided () {
		
		$url = "http://localhost:8000/";
		$client = new GuzzleHttp\Client(['base_uri' => $url]);
		$json = [
			'itemId1' => '',
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

		$response = $client->request(
			'POST', 
			'/pagseguro-checkout/src/main/createOrder/create', 
			['json' => $json, 'http_errors' => false ]
		);	

		$this->assertEquals(400, $response->getStatusCode());
	}
}