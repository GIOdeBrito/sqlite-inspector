<?php

require 'src/helpers/router.php';
require 'src/helpers/http_request.php';
require 'src/helpers/http_response.php';

$router = new Router();

$request = new Request();
$response = new Response();

require 'src/routes/web_pages.php';

require 'src/routes/routes_test.php';
require 'src/routes/web_get.php';
require 'src/routes/web_database.php';

$router->handle_request($request, $response);

?>