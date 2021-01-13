<?php

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
			$json,
			$createOrderUseCaseDouble
		);
	}
}

class CreateOrderRouterTest extends TestCase {
	
	public function testShouldReturn400IfNoParamIsProvided () {
		
		list($sut, $json) = MakeSut::make();
		//set any of the params to an empty string to force a bad request
		$json['senderPhone'] = '';

		$response = $sut->route(json_encode($json));

		$this->assertEquals(400, $response);
	}

	public function testShouldReturn200IfValidParamAreProvided () {
		list($sut, $json) = MakeSut::make();

		$response = $sut->route(json_encode($json));

		$this->assertEquals(200, $response);
	}

	/*public function testShouldCallCreateOrderRouterUseCaseWithCorrectValues () {
		
		list($sut, $json, $createOrderUseCaseDouble) = MakeSut::make();

		//$sut->route(json_encode($json));

		$this->assertJsonStringEqualsJsonString(
			json_encode($json),
			json_encode($createOrderUseCaseDouble->data)
		);
	}*/
}