<?php

$router->add_route('GET', '/', function ()
{
	HomeController::index();
});

?>