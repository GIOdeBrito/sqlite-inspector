<?php

use App\Controllers\Pages\Home;
use App\Controllers\Pages\NotFound;

$router->addRoute('GET', '/', [Home::class, 'index']);
$router->addRoute('GET', '/404', [NotFound::class, 'index']);

?>