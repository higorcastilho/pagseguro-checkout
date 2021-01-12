<?php
namespace PagseguroService\presentation\routes;
ini_set("display_errors", "on");
class CreateOrderRouter {

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
				return ;
			}

			http_response_code(200);
	}

}