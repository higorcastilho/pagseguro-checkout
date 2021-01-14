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

		$data["currency"] = "BRL";
		
		$data["itemDescription1"] = "Whey Coffee";
		
		
		$data["itemWeight1"] = 1000;
		$data["reference"] = "REF1234";
		
		
		
		$data["senderCPF"] = "38440987803"; //
		$data["senderBornDate"] = "12/03/1990";
		$data["senderEmail"] = "email@sandbox.pagseguro.com.br";
		$data["shippingType"] = 1;
		$data["shippingAddressStreet"] = "Av. Brig. Faria Lima"; //
		$data["shippingAddressNumber"] = "1384"; //
		$data["shippingAddressComplement"] = "2o andar"; //
		$data["shippingAddressDistrict"] = "Jardim Paulistano"; //
		$data["shippingAddressPostalCode"] = "01452002"; //
		$data["shippingAddressCity"] = "Sao Paulo"; //
		$data["shippingAddressState"] = "SP"; //
		$data["shippingAddressCountry"] = "BRA"; //
		$data["extraAmount"] = -0.01;
		$data["redirectURL"] = "http://sitedocliente.com";
		$data["notificationURL"] = "https://url_de_notificacao.com";
		$data["maxUses"] = 1;
		$data["maxAge"] = 3000;
		$data["shippingCost"] = "0.00";

	}	
}