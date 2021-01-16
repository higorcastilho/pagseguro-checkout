<?php

use PHPUnit\Framework\TestCase;
use PagseguroService\utils\helpers\PagseguroPerformRequest;

class MakePagseguroPerformRequestSutIntegrationTest {
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

class PagseguroPerformRequestIntegrationTest extends TestCase {
	public function testShouldReturnAResponseContainingTheRequestedCode () {
		list($client, $json) = MakePagseguroPerformRequestSutIntegrationTest::make();
		$response = $client->request(
			'POST', 
			'/pagseguro-checkout/src/main/createOrder/create', 
			['json' => $json, 'http_errors' => false ]
		);

		echo $response->getBody();	
	}
}