<?php

use PHPUnit\Framework\TestCase;
use PagseguroService\domain\usecases\CreateOrderUseCase;
use PagseguroService\infra\repositories\PagseguroPerformRequestRepository;

class MakeUseCaseSutUnitTest {
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

class CreateOrderUseCaseUnitTest extends TestCase {
	public function testShouldThrowIfNoParamsAreProvided () {

		list($json) = MakeUseCaseSutUnitTest::make();
		//set any of the params to an empty string to force a missing param error
		$json['senderName'] = '';
		$pagseguroPerformRequestRepositoryDouble = $this->createMock(PagseguroPerformRequestRepository::class);
		$sut = new CreateOrderUseCase($pagseguroPerformRequestRepositoryDouble);

		$this->expectException(Exception::class);
		$this->expectExceptionMessage("Missing param error");
		$this->expectExceptionCode(500);
		$sut->create(json_encode($json));
	}

	public function testShouldReturnAObjectStringContaingingTheRequestedCodeIfCorrectValuesAreProvided () {
		
		list($json) = MakeUseCaseSutUnitTest::make();
		$pagseguroPerformRequestRepositoryDouble = $this->createMock(PagseguroPerformRequestRepository::class);
		$sut = new CreateOrderUseCase($pagseguroPerformRequestRepositoryDouble);		
	
		$data = 'any_code_with_32_characters_0000';
		$pagseguroPerformRequestRepositoryDouble->method('perform')->willReturn($data);
		$pagseguroPerformRequestRepositoryDouble->expects($this->any())->method('perform')->with($this->equalTo(json_encode($json)));	
		$response = $sut->create(json_encode($json));
		
		$this->assertEquals($data, $response['code']);
	}

	public function testShouldThrowIfAnyDependencyThrows () {
		list($json) = MakeUseCaseSutUnitTest::make();
		$pagseguroPerformRequestRepositoryDouble = $this->createMock(PagseguroPerformRequestRepository::class);
		$this->expectException(Exception::class);
		
		$pagseguroPerformRequestRepositoryDouble->method('perform')->will($this->throwException(new Exception));
		$pagseguroPerformRequestRepositoryDouble->perform(json_encode($json));
	}
}