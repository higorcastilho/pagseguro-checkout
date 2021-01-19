# pagseguro-checkout

<p align="center">
  <a href="#gear-running-locally">Running</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#test_tube-testing">Testing</a>
</p>

### :gear: Running locally

- Clone this repository and move it to your xampp server.
- Issue the following:
```
composer install
```
- Copy env.example.php (it's inside src/main/config) and rename it to env.php. Fill the EMAIL_PAGSEGURO and TOKEN_PAGSEGURO variables with your correct credentials
- Get into the project folder and run this command on terminal:
```
php -S 127.0.0.1:8000 -t src/main
```
- Open a REST API client like insomnia and make a POST request to the endpoint http://127.0.0.1:8000/pagseguro-checkout/src/main/createOrder/create 

- Use this JSON body: 
```
{
	"itemId1": "0001",
	"itemAmount1": "100.00",
	"itemQuantity1": 1,
	"senderName": "Jose Comprador",
	"senderEmail": "email@sandbox.pagseguro.com.br",
	"senderAreaCode": "11",
	"senderPhone": "56713293",
	"shippingAddressStreet": "Av. Brig. Faria Lima",
	"shippingAddressNumber": "1384",
	"shippingAddressComplement": "2o andar",
	"shippingAddressDistrict": "Jardim Paulistano",
	"shippingAddressPostalCode": "01452002",
	"shippingAddressCity": "Sao Paulo",
	"shippingAddressState": "SP"
}
```
- The response should be something like this:
```
{
  "statusCode": 200,
  "body": {
    "code": "BBB7F7ACF9F9051994295FB75873F2A7"
  }
}
```

### :test_tube: Testing

- Keep the server running at 127.0.0.1:8000
- On terminal and inside project folder, issue:
```
vendor/bin/phpunit
```
