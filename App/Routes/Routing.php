<?php

$router = new App\Core\Router();

require_once 'App/Routes/Web.php';
require_once 'App/Routes/Api.php';

$request = new App\Http\Request();
$response = new App\Http\Response();

//use App\Routes\Api;

$router->call($request, $response);

?>