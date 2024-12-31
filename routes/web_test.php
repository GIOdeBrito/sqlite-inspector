<?php

$router->add_route('GET', '/api/v1/message/', function ()
{
	echo "KNOW, oh prince, that between the years when the oceans drank Atlantis
	and the gleaming cities, and the years of the rise of the Sons of Aryas, there
	was an Age undreamed of, when shining kingdoms lay spread across the
	world like blue mantles beneath the stars.";
});

$router->add_route('GET', '/api/v1/time/', function ()
{
	echo date('d/m/Y H:i');
});

$router->add_route('POST', '/api/v1/dump/', function ()
{
	var_dump($_POST);
});

$router->add_route('POST', '/api/v1/sendfile/test/', function ()
{
	UploadController::handle_db_upload();
});

?>