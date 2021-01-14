<?php

use PHPUnit\Framework\TestCase;
use PagseguroService\domain\usecases\CreateOrderUseCase;
use PagseguroService\utils\helpers\PagseguroPerformRequest;

class MakeUseCaseSut {
	static public function make () {
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
			'shippingAddressState' => 'any_address_state',
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
			$json
		);
	}
}

class PagseguroPerformRequestDouble {
	
	public $data;

	public function perform ($data) {
		$this->data = $data;
	}
}

class CreateOrderUseCaseTest extends TestCase {
	public function testShouldThrowIfNoParamsAreProvided () {

		list($json) = MakeUseCaseSut::make();
		//set any of the params to an empty string to force a missing param error
		$json['senderName'] = '';
		$pagseguroPerformRequestDouble = $this->createMock(PagseguroPerformRequest::class);
		$sut = new CreateOrderUseCase($pagseguroPerformRequestDouble);

		$this->expectException(Exception::class);
		$this->expectExceptionMessage("Missing param error");
		$this->expectExceptionCode(500);
		$sut->create(json_encode($json));
	}

	public function testShouldCallPagseguroPerformRequestWithCorrectValues () {
		
		list($json) = MakeUseCaseSut::make();
		
		$pagseguroPerformRequestDouble = new PagseguroPerformRequestDouble();
		
		$sut = new CreateOrderUseCase($pagseguroPerformRequestDouble);		
		$sut->create(json_encode($json));

		$this->assertSame(json_encode($json), $pagseguroPerformRequestDouble->data);
	}

	/*public function testShouldCallPagseguroPerformRequestWithCorrectValues () {
		
		list($json) = MakeUseCaseSut::make();
		
		$pagseguroPerformRequestDouble = $this->createMock(PagseguroPerformRequest::class);
		$pagseguroPerformRequestDouble->method('perform')->will($this->returnArgument(0));
		
		$sut = new CreateOrderUseCase($pagseguroPerformRequestDouble);		
		$sut->create(json_encode($json));

		$this->assertSame(json_encode($json), $pagseguroPerformRequestDouble->perform(json_encode($json)));
	}*/
}