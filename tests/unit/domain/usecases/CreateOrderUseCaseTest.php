<?php

use PHPUnit\Framework\TestCase;
use PagseguroService\domain\usecases\CreateOrderUseCase;

class CreateOrderUseCaseTest extends TestCase {
	public function testShouldThrowIfNoParamsAreProvided () {
			$sut = new CreateOrderUseCase();
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
			$this->expectException(Exception::class);
			$this->expectExceptionMessage("Missing param error");
			$sut->create(json_encode($json));
	}
}