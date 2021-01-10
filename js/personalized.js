async function payment() {
	
	try {
		const addressSpan = document.getElementsByClassName('address')
		const url = addressSpan[0].dataset.addr

		const response = await fetch(`${url}/payment.php`, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8'
			},
			body: {}
		})
		const data = await response.text()
		const dataJson = JSON.parse(data)
		const xmlContent = JSON.stringify(dataJson.data)
		//32
		const codeMatches = xmlContent.match(/\w{32}/)
		const code = codeMatches[0]

		window.location.replace(`https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=${code}`)

	} catch (error) {
		console.log(error)
	}

}