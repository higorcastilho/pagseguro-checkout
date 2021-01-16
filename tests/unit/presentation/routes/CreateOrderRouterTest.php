<?php

use PHPUnit\Framework\TestCase;
use PagseguroService\presentation\routes\CreateOrderRouter;
use PagseguroService\domain\usecases\CreateOrderUseCase;

class CreateOrderUseCaseDouble {
	
	public $data;
	public $code;

	function create ($input) {
		$this->data = $input;
		return $this->code;
	}
}

function makeCreateOrderUseCaseDoubleWithError () {
	
	class CreateOrderUseCaseDoubleWithError {
		public function create () {
			throw new \Exception('', 500);
		}
	} 
	return new CreateOrderUseCaseDoubleWithError();
} 


class MakeRouterSutUnitTest {
	
	static public function make() {

		$createOrderUseCaseDouble = new CreateOrderUseCaseDouble();
		$createOrderUseCaseDouble->code = 'any_code';
		$sut = new CreateOrderRouter($createOrderUseCaseDouble); 

		$json = [
			'itemId1' => 'any_item_id',
			'itemAmount1' => 'any_amount',
			'itemQuantity1' => 'any_quantity',
			'senderName' => 'any_name',
			'senderAreaCode' => 'any_area_code',
			'senderPhone' => 'any_phone',
			'senderEmail' => 'any_email',
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
			$json,
			$createOrderUseCaseDouble
		);
	}
}

class CreateOrderRouterTest extends TestCase {
	
	public function testShouldReturn400IfNoParamIsProvided () {
		
		list($sut, $json) = MakeRouterSutUnitTest::make();
		//set any of the params to an empty string to force a bad request
		$json['senderPhone'] = '';

		$httpResponse = $sut->route(json_encode($json));

		$this->assertEquals(400, $httpResponse['statusCode']);
		$this->assertEquals('Missing param error', $httpResponse['body']);
	}

	public function testShouldCallCreateOrderRouterUseCaseWithCorrectValues () {
		
		list($sut, $json, $createOrderUseCaseDouble) = MakeRouterSutUnitTest::make();

		$sut->route(json_encode($json));

		$this->assertJsonStringEqualsJsonString(
			json_encode($json),
			$createOrderUseCaseDouble->data
		);
	}

	public function testShouldReturn200IfValidParamsAreProvided () {
		list($sut, $json) = MakeRouterSutUnitTest::make();

		$httpResponse = $sut->route(json_encode($json));

		$this->assertEquals(200, $httpResponse['statusCode']);
		$this->assertEquals('any_code', $httpResponse['body']);
	}
	
	/*public function testShouldThrowIfAnInvalidDependencyIsProvided () {
		list($x, $json) = MakeRouterSutUnitTest::make();
		$suts = array(
			//new CreateOrderRouter(), 
			new CreateOrderRouter({})
		);

		foreach ($suts as $sut) {
			$response = $sut->route(json_encode($json));
			$this->assertEquals(500, $response['statusCode']);
			$this->assertEquals('Internal server error', $httpResponse['body']);
		}
	}*/

	public function testShouldThrowIfAnyDependencyThrows () {
		//x is declared to complete list method requirement. Isn't being used
		list($x, $json) = MakeRouterSutUnitTest::make();

		$createOrderUseCaseDoubleWithError = makeCreateOrderUseCaseDoubleWithError();
		
		$sut = new CreateOrderRouter($createOrderUseCaseDoubleWithError);
		
		$httpResponse = $sut->route(json_encode($json));
		$this->assertEquals(500, $httpResponse['statusCode']);
		$this->assertEquals('Internal server error', $httpResponse['body']);
	}

}