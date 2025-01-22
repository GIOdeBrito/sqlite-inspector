<?php

$router->add_route('GET', '/', 'HomeController::index');

$router->add_route('GET', '/404', 'NotFoundController::index');

?>