<?php
namespace PagseguroService\presentation\routes;

class CreateOrderRouter {
	private $num1;
	private $num2;

	public function somar () {
		return $this->num1 + $this->num2;
	}

	public function setNum1 ($num) {
		$this->num1 = $num;
	}

	public function setNum2 ($num) {
		$this->num2 = $num;
	}
}