<?php

use PHPUnit\Framework\TestCase;
use PagseguroService\utils\helpers\PagseguroPerformRequest;

class MakePagseguroPerformerRequestSutUnitTest {
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

class PagseguroPerformRequestTest extends TestCase {
	public function testShouldThrowIfNoConstructorStringsParamsAreProvided () {
		$suts = Array(
			new PagseguroPerformRequest('', '', ''),
			new PagseguroPerformRequest('url_pagseguro', '', ''),
			new PagseguroPerformRequest('url_pagseguro', 'email_pagseguro', ''),
			new PagseguroPerformRequest('', 'email_pagseguro', 'token_pagseguro'),
			new PagseguroPerformRequest('', '', 'token_pagseguro'),
			new PagseguroPerformRequest('', 'email_pagseguro', ''),
		);

		foreach($suts as $sut) {
			list($json) = MakePagseguroPerformerRequestSutUnitTest::make();
			$this->expectException(Exception::class);
			$this->expectExceptionMessage('Missing constructor param inside PagseguroPerformRequest helper class');
			$this->expectExceptionCode(500);
			$sut->perform(json_encode($json));
		};
	}
}