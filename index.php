<?php 
	include './config.php'
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Pagseguro</title>
</head>
<body>
	<h1>Checkout do Pagseguro</h1>

	<button onclick="payment()" >Pagar</button>

	<span class="address" data-addr="<?php echo URL; ?>"></span>

	<script src="js/personalized.js"></script>
</body>
</html>