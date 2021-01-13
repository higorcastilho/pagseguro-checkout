<?php
namespace PagseguroService\presentation\routes;

class CreateOrderRouter {

	private $createOrderUseCase;
	
	public function __construct ($createOrderUseCase) {
		$this->createOrderUseCase = $createOrderUseCase;
	}

	public function route ($input) {

			$data = json_decode($input, true);
			
			if (
				!$data['itemId1'] ||
				!$data['itemAmount1'] ||
				!$data['itemQuantity1'] ||
				!$data['senderName'] ||
				!$data['senderAreaCode'] ||
				!$data['senderPhone'] ||
				!$data['shippingAddressStreet'] ||
				!$data['shippingAddressNumber'] ||
				!$data['shippingAddressComplement'] ||
				!$data['shippingAddressDistrict'] ||
				!$data['shippingAddressPostalCode'] ||
				!$data['shippingAddressCity'] ||
				!$data['shippingAddressState']
			) {
				http_response_code(400);
				
				$httpResponse = [
					'statusCode' => http_response_code(),
				];

				return $httpResponse;
			}

			$this->createOrderUseCase->create($input);
			http_response_code(200);
			
			$httpResponse = [
				'statusCode' => http_response_code() 
			];

			return $httpResponse;
	}
}