<?php

use App\Controllers\Pages\Home;
use App\Controllers\Pages\NotFound;

$router->add_route('GET', '/', [Home::class, 'index']);
$router->add_route('GET', '/404', [NotFound::class, 'index']);

?>