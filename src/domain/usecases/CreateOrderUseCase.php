<?php

namespace PagseguroService\domain\usecases;

class CreateOrderUseCase {
	public function create ($input) {

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

			throw new \Exception("Missing param error", 500);
		}
	}	
}