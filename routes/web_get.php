<?php

$router->add_route('GET', '/api/v1/maxuploadsize/', function()
{
	$size = intval(ini_get('upload_max_filesize'));

	$size *= 1024 * 1024;

	echo json_encode([ 'size' => $size ]);
});

$router->add_route('GET', '/api/v1/getmodal/', function()
{
	GetModalController::return_modal_content();
});

?>