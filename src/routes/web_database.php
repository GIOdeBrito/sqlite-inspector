<?php

$router->add_route('GET', '/api/v1/database/alltables/', function ()
{
	DatabaseController::get_table_names();
});

?>