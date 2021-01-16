<?php
ini_set("display_errors", "on");
use PagseguroService\main\config\App;

require_once "./middlewares/headers.php";
require_once './routes/CreateOrderRoutes.php';
require_once './composers/CreateOrderRouterComposer.php';
require_once './adapters/Adapter.php';

require_once "../../vendor/autoload.php";

$app = new App;
echo $app->start($_SERVER["REQUEST_URI"]);