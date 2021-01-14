<?php

namespace PagseguroService\presentation\routes;
use PagseguroService\presentation\helpers\HttpResponse;

class CreateOrderRouter {

	private $createOrderUseCase;
	
	public function __construct ($createOrderUseCase) {
		$this->createOrderUseCase = $createOrderUseCase;
	}

	public function route ($input) {

			try {
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

					return HttpResponse::badRequest(new \Exception("Missing param error", 400));
				}

				$code = $this->createOrderUseCase->create($input);
				
				return HttpResponse::ok($code);

			} catch (\Exception $exception) {
				
				return HttpResponse::serverError(new \Exception("Internal server error", 500));
			}

	}
}