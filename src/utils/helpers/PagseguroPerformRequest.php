<?php

namespace PagseguroService\utils\helpers;

class PagseguroPerformRequest {
	
	private $url_pagseguro;
	private $email_pagseguro;
	private $token_pagseguro;

	public function __construct ($url_pagseguro, $email_pagseguro, $token_pagseguro) {
		$this->url_pagseguro = $url_pagseguro;
		$this->email_pagseguro = $email_pagseguro;
		$this->token_pagseguro = $token_pagseguro;
	}	

	public function perform ($input) {
		$data = json_decode($input, true);

		if (!$this->url_pagseguro || !$this->email_pagseguro || !$this->token_pagseguro) {

			throw new \Exception("Missing constructor param inside PagseguroPerformRequest helper class", "500");
		}

		$buildQuery = http_build_query($data);
		$url = $this->url_pagseguro . "/v2/checkout?email=" . $this->email_pagseguro . "&token=" . $this->token_pagseguro;

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, Array("application/x-www-form-urlencoded; charset=UTF-8"));
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $buildQuery);

		$response = curl_exec($curl);
		curl_close($curl);

		return json_encode($response);
	}
}