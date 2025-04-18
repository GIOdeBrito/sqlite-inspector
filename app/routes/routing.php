<?php

$router = new App\Core\Router();

require_once 'app/routes/web.php';
require_once 'app/routes/api.php';

$request = new App\Http\Request();
$response = new App\Http\Response();

//use App\Routes\Api;

$router->handle_request($request, $response);

?>