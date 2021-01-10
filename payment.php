<?php

include './config.php';

$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$dataArray["currency"] = "BRL";
$dataArray["itemId1"] = "0001";
$dataArray["itemDescription1"] = "Whey Coffee";
$dataArray["itemAmount1"] = "100.00"; //
$dataArray["itemQuantity1"] = 1; //
$dataArray["itemWeight1"] = 1000;
$dataArray["reference"] = "REF1234";
$dataArray["senderName"] = "Jose Comprador"; //
$dataArray["senderAreaCode"] = 11; //
$dataArray["senderPhone"] = "56713293"; //
$dataArray["senderCPF"] = "38440987803"; //
$dataArray["senderBornDate"] = "12/03/1990";
$dataArray["senderEmail"] = "email@sandbox.pagseguro.com.br";
$dataArray["shippingType"] = 1;
$dataArray["shippingAddressStreet"] = "Av. Brig. Faria Lima"; //
$dataArray["shippingAddressNumber"] = "1384"; //
$dataArray["shippingAddressComplement"] = "2o andar"; //
$dataArray["shippingAddressDistrict"] = "Jardim Paulistano"; //
$dataArray["shippingAddressPostalCode"] = "01452002"; //
$dataArray["shippingAddressCity"] = "Sao Paulo"; //
$dataArray["shippingAddressState"] = "SP"; //
$dataArray["shippingAddressCountry"] = "BRA"; //
$dataArray["extraAmount"] = -0.01;
$dataArray["redirectURL"] = "http://sitedocliente.com";
$dataArray["notificationURL"] = "https://url_de_notificacao.com";
$dataArray["maxUses"] = 1;
$dataArray["maxAge"] = 3000;
$dataArray["shippingCost"] = "0.00";

$buildQuery = http_build_query($dataArray);
$url = URL_PAGSEGURO . "/v2/checkout?email=" . EMAIL_PAGSEGURO ."&token=" . TOKEN_PAGSEGURO;

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, Array("application/x-www-form-urlencoded;charset=UTF-8"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $buildQuery);

$response = curl_exec($curl);

curl_close($curl);

$return = [ "error" => true, 'data' => $response ];
header('Content-Type: application/json');
echo json_encode($return);