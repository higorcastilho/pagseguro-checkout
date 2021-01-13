<?php

define("URL", "your project uri");
define("EMAIL_PAGSEGURO", "your pagseguro email");
define("TOKEN_PAGSEGURO", "your sandbox token");

$sandbox = true;

if ($sandbox) {
	define("URL_PAGSEGURO", "https://ws.sandbox.pagseguro.uol.com.br");
	define("URL_CHECKOUT", "https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=");
} 
