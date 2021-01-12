<?php

use PagseguroService\main\config\App;

require_once './routes/CreateOrderRoutes.php';
require_once './composers/CreateOrderRouterComposer.php';
require_once './adapters/adapter.php';

require_once "../../vendor/autoload.php";

$app = new App;
echo $app->start($_SERVER["REQUEST_URI"]);