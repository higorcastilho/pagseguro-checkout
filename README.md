# pagseguro-checkout-service

<p align="center">
  <a href="#running-locally">Running</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#🧪-testing">Testing</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
   <a href="#running-running">Running</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#pray-acknowledgments">Acknowledgments</a>&nbsp;&nbsp;&nbsp;
</p>

### Running locally:

- Clone this repository and move it to your xampp server.

- Get into the project folder and run 'php -S 127.0.0.1:8000 -t src/main' on terminal

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
- The response sould be something like this:
```
{
  "statusCode": 200,
  "body": {
    "code": "BBB7F7ACF9F9051994295FB75873F2A7"
  }
}
```

### 🧪 Testing
