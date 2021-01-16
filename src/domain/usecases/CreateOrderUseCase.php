<?php

namespace PagseguroService\domain\usecases;

class CreateOrderUseCase {

	private $pagseguroPerformRequest;

	public function __construct ($pagseguroPerformRequest) {
		$this->pagseguroPerformRequest = $pagseguroPerformRequest;
	}

	public function create ($input) {

		$data = json_decode($input, true);

		if (
			!$data['itemId1'] ||
			!$data['itemAmount1'] ||
			!$data['itemQuantity1'] ||
			!$data['senderName'] ||
			!$data['senderAreaCode'] ||
			!$data['senderPhone'] ||
			!$data['senderEmail'] ||
			!$data['shippingAddressStreet'] ||
			!$data['shippingAddressNumber'] ||
			!$data['shippingAddressComplement'] ||
			!$data['shippingAddressDistrict'] ||
			!$data['shippingAddressPostalCode'] ||
			!$data['shippingAddressCity'] ||
			!$data['shippingAddressState']
		) {

			throw new \Exception("Missing param error", 500);
		}

		//extra fields not catched on landing page
		$data["currency"] = "BRL";
		$data["itemDescription1"] = "Whey Coffee";
		$data["itemWeight1"] = 1000;
		$data["reference"] = "REF1234";
		$data["senderCPF"] = "38440987803";
		$data["senderBornDate"] = "12/03/1990";
		$data["shippingType"] = 1;
		$data["shippingAddressCountry"] = "BRA";
		$data["extraAmount"] = -0.01;
		$data["redirectURL"] = "http://sitedocliente.com";
		$data["notificationURL"] = "https://url_de_notificacao.com";
		$data["maxUses"] = 1;
		$data["maxAge"] = 3000;
		$data["shippingCost"] = "0.00";

		$response = $this->pagseguroPerformRequest->perform(json_encode($data));

		preg_match('/\w{32}/', $response, $matches);

		if (sizeof($matches) < 1) {
			throw new \Exception("Response has no code provided by Pagseguro API", 500);
		}

		$code = $matches['0'];
		$return = [ 'code' => $code ];

		return $return;
	}	
}