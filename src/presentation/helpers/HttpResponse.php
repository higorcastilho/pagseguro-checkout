<?php

namespace PagseguroService\presentation\helpers;

class HttpResponse {
	
	static public function badRequest ($error) {
		return [
			'statusCode' => $error->getCode(),
			'body' => $error->getMessage()
		];
	}

	static public function ok ($data) {
		return [
			'statusCode' => 200,
			'body' => $data
		];
	}

	static public function serverError ($error) {
		return [
			'statusCode' => $error->getCode(),
			'body' => $error->getMessage()
		];
	}
}